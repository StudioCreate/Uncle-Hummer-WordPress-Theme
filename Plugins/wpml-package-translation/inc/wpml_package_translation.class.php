<?php

class WPML_package_translation {

	private $registered_strings;

	function __construct() {
		add_action( 'init', array( $this, 'init' ), 10 );

		$this->registered_strings = array();
	}

	function __destruct() {
	}

	/**
	 * @param $attributes
	 *
	 * @return string
	 */
	public function attributes_to_string( $attributes ) {
		$result = '';
		foreach ( $attributes as $key => $value ) {
			if ( $result ) {
				$result .= ' ';
			}
			$result .= esc_html($key) . '="' . esc_attr($value) . '"';
		}

		return $result;
	}

	/**
	 * @param int|Array $package
	 *
	 * @return bool
	 */
	public function is_package_registered( $package ) {
		$package_id    = false;
		$is_registered = false;
		if ( is_array( $package ) ) {
			$package_id = $this->_get_package_id( $package );
		} elseif ( is_numeric( $package ) ) {
			$package_id = $package;
		}
		if ( $package_id ) {
			$is_registered = ! isset( $this->registered_strings[ $package_id ] );
		}

		return $is_registered;
	}

	/**
	 * @param $kind
	 *
	 * @return string
	 */
	public function get_package_element_type( $kind ) {
		if ( is_object( $kind ) ) {
			$kind = $kind->kind;
		}
		if ( is_array( $kind ) ) {
			$kind = $kind['kind'];
		}

		return 'package_' . sanitize_title_with_dashes( $kind );
	}

	function init() {

		if ( defined( 'ICL_SITEPRESS_VERSION' )
		     && defined( 'WPML_ST_VERSION' )
		     && defined( 'WPML_TM_VERSION' )
		) {

			$setup_complete = apply_filters( 'WPML_get_setting', false, 'setup_complete' );
			if ( $setup_complete ) {
				add_action( 'admin_menu', array( $this, 'menu' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'wp_ajax_wpml_delete_packages', array( $this, 'delete_packages' ) );

				/* Translation hooks for other plugins to use */
				if ( is_admin() ) {
					add_filter( 'WPML_register_string', array( $this, 'register_string_for_translation' ), 10, 5 );
					add_action( 'WPML_show_package_language_ui', array( $this, 'show_language_selector' ), 10, 2 );
				}

				add_filter( 'WPML_translate_string', array( $this, 'translate_string' ), 10, 3 );
				add_filter( 'WPML_get_translated_strings', array( $this, 'get_translated_strings' ), 10, 2 );
				add_action( 'WPML_set_translated_strings', array( $this, 'set_translated_strings' ), 10, 2 );

				/* WPML hooks */
				add_filter( 'WPML_get_translatable_types', array( $this, 'get_translatable_types' ) );
				add_filter( 'WPML_get_translatable_items', array( $this, 'get_translatable_items' ), 10, 3 );
				add_filter( 'WPML_get_translatable_item', array( $this, 'get_translatable_item' ), 10, 2 );
				add_filter( 'WPML_get_link', array( $this, 'get_link' ), 10, 4 );
				add_filter( 'WPML_estimate_word_count', array( $this, 'estimate_word_count' ), 10, 4 );
				add_filter( 'WPML_get_package_type', array( $this, 'get_package_type' ), 10, 2 );

				/* Translation queue hooks */
				add_filter( 'WPML_translation_job_title', array( $this, 'get_post_title' ), 10, 2 );

				/* Translation editor hooks */
				add_filter( 'WPML_editor_string_name', array( $this, 'get_editor_string_name' ), 10, 2 );
				add_filter( 'WPML_editor_string_style', array( $this, 'get_editor_string_style' ), 10, 3 );
				add_filter( 'WPML_get_string_package', array( $this, 'get_string_package' ), 10, 2 );

				add_action( 'shutdown', array( $this, 'shutdown' ) );
			}
		}
	}

	/**
	 * @param $package
	 *
	 * @return bool
	 */
	public function package_has_kind( $package ) {
		return isset( $package[ 'kind' ] ) && $package[ 'kind' ];
	}

	/**
	 * @param $package
	 *
	 * @return bool
	 */
	public function package_has_name( $package ) {
		return isset( $package[ 'name' ] ) && $package[ 'name' ];
	}

	/**
	 * @param $package
	 *
	 * @return bool
	 */
	public function package_has_title( $package ) {
		return isset( $package[ 'title' ] ) && $package[ 'title' ];
	}

	/**
	 * @param $package
	 *
	 * @return bool
	 */
	public function package_has_kind_and_name( $package ) {
		return $this->package_has_kind( $package ) && $this->package_has_name( $package );
	}

	/**
	 * @param $string_name
	 *
	 * @return mixed
	 */
	public function sanitize_string_with_underscores( $string_name ) {
		return preg_replace( '/[ \[\]]+/', '_', $string_name );
	}

	function shutdown() {
		foreach ( $this->registered_strings as $package_id => $data ) {
			$this->update_package_translations( $package_id, false );
		}
	}

	function register_string_for_translation( $string_value, $string_name, $package, $string_title, $string_kind ) {
		global $wpdb;

		$package_id = $this->_get_package_id( $package );
		if ( ! $package_id ) {
			// need to create a new record.

			if ( ! $this->package_has_kind_and_name( $package ) ) {
				return $string_value;
			}

			$package[ 'kind' ] = sanitize_title_with_dashes( $package[ 'kind' ] );

			if ( ! $this->package_has_title( $package ) ) {
				$package[ 'title' ] = $package[ 'name' ];
			}
			if ( ! isset( $package[ 'edit_link' ] ) ) {
				$package[ 'edit_link' ] = '';
			}

			$wpdb->insert( $wpdb->prefix . 'icl_string_packages', $package );

			$package_id = $this->_get_package_id( $package, false );

			$this->update_package_translations( $package_id, true );
		}

		if ( $this->is_package_registered( $package_id ) ) {
			$this->registered_strings[ $package_id ] = array( 'strings' => array() );
		}

		$string_name = $this->sanitize_string_with_underscores( $string_name );

		$this->registered_strings[ $package_id ][ 'strings' ][ $string_name ] = array(
			'title' => $string_title,
			'kind'  => $string_kind,
			'value' => $string_value
		);

		$this->register_string_with_wpml( $package_id, $package, $string_name, $string_title, $string_kind, $string_value );

		return $string_value;
	}

	function get_string_context( $context ) {
		return sanitize_title_with_dashes( $context[ 'kind' ] . '-' . $context[ 'name' ] );
	}

	function register_string_with_wpml( $package_id, $context, $string_name, $string_title, $string_kind, $string_value ) {
		global $wpdb;

		$string_context = $this->get_string_context( $context );

		$string_id = $wpdb->get_var( "
            SELECT id 
            FROM {$wpdb->prefix}icl_strings WHERE context='" . esc_sql( $string_context ) . "' AND name='" . esc_sql( $package_id . '_' . $string_name ) . "'" );
		if ( ! $string_id ) {
			$string_id = icl_register_string( $string_context, $package_id . '_' . $string_name, $string_value );
		}

		if ( $string_id ) {
			// set the package id and string kind
			$update_date  = array(
				'type'              => $string_kind,
				'title'             => $string_title,
				'value'             => $string_value,
				'string_package_id' => $package_id,
			);
			$update_where = array(
				'id' => $string_id,
			);
			$wpdb->update( "{$wpdb->prefix}icl_strings", $update_date, $update_where );
		}
	}

	function translate_string( $string_value, $string_name, $package ) {
		$package_id = $this->_get_package_id( $package );

		if ( $package_id ) {

			$string_name = $this->sanitize_string_with_underscores( $string_name );

			$string_context = $this->get_string_context( $package );

			return icl_translate( $string_context, $package_id . '_' . $string_name, $string_value );
		} else {
			return $string_value;
		}
	}

	function get_translated_strings( $strings, $context ) {
		$package_id = $this->_get_package_id( $context );

		if ( $package_id ) {
			global $wpdb;

			// Get strings already in the database

			$results_query   = "SELECT id, name, value FROM {$wpdb->prefix}icl_strings WHERE string_package_id=%d";
			$results_prepare = $wpdb->prepare( $results_query, $package_id );
			$results         = $wpdb->get_results( $results_prepare );

			foreach ( $results as $result ) {
				$translations = icl_get_string_translations_by_id( $result->id );
				if ( ! empty ( $translations ) ) {
					$string_name = substr( $result->name, strlen( $package_id ) + 1 );

					$strings[ $string_name ] = $translations;
				}
			}
		}

		return $strings;
	}

	function set_translated_strings( $translations, $context ) {
		global $wpdb;

		$package_id = $this->_get_package_id( $context );

		if ( $package_id ) {
			foreach ( $translations as $string_name => $langs ) {
				$string_name       = $package_id . '_' . $string_name;
				$string_id_query   = "SELECT id FROM {$wpdb->prefix}icl_strings WHERE name=%s";
				$string_id_prepare = $wpdb->prepare( $string_id_query, $string_name );
				$string_id         = $wpdb->get_var( $string_id_prepare );
				foreach ( $langs as $lang => $data ) {
					icl_add_string_translation( $string_id, $lang, $data[ 'value' ], $data[ 'status' ] );
				}
			}
		}
	}

	function _get_package_id( $package, $from_cache = true ) {
		global $wpdb;
		static $cache = array();

		$package[ 'kind' ] = sanitize_title_with_dashes( $package[ 'kind' ] );

		$key = $package[ 'kind' ] . '-' . $package[ 'name' ];
		if ( ! $from_cache || ! array_key_exists( $key, $cache ) ) {
			$package_id_query   = "SELECT ID FROM {$wpdb->prefix}icl_string_packages WHERE kind=%s AND name=%s";
			$package_id_prepare = $wpdb->prepare( $package_id_query, array( $package[ 'kind' ], $package[ 'name' ] ) );
			$package_id         = $wpdb->get_var( $package_id_prepare );
			if ( ! $package_id ) {
				return false;
			}
			$cache[ $key ] = $package_id;
		}

		return $cache[ $key ];
	}

	function get_translatable_types( $types ) {
		global $wpdb;

		$types_added = array();

		$package_types = $wpdb->get_col( "SELECT kind FROM {$wpdb->prefix}icl_string_packages WHERE ID>0" );

		foreach ( $package_types as $new_type ) {

			if ( ! in_array( $new_type, $types_added ) ) {
				$types[ sanitize_title_with_dashes( $new_type ) ] = $new_type;
				$types_added[ ]                                   = $new_type;
			}
		}

		$types = apply_filters( 'WPML_register_string_package_types', $types );

		return $types;
	}

	function get_translatable_items( $items, $kind, $filter ) {
		global $wpdb;

		$packages = $wpdb->get_col( $wpdb->prepare( "SELECT name FROM {$wpdb->prefix}icl_string_packages WHERE kind=%s", $kind ) );
		do_action( 'WPML_register_string_packages', $kind, $packages );
		$packages = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}icl_string_packages WHERE kind=%s", $kind ) );

		//  for the Translation Dashboard

		$from_language = $filter[ 'from_lang' ];
		foreach ( $packages as $package_id ) {
			global $wpdb, $sitepress;

			$item                     = $this->get_package_details( $package_id );
			$package_default_language = apply_filters('WPML_ST_strings_language', false);

			if ( $package_default_language == $from_language ) {

				$icl_el_type  = $this->get_package_element_type( $kind );

				//create item and add it to the translation table if required
				$new_item  = $this->new_external_item( $kind, $item, false );
				$post_trid = $sitepress->get_element_trid( $new_item->ID, $icl_el_type );
				if ( ! $post_trid ) {
					$sitepress->set_element_language_details( $new_item->ID, $icl_el_type, false, $package_default_language, null, false );
					$post_trid = $sitepress->get_element_trid( $new_item->ID, $icl_el_type );
				}

				// get translation status for each item
				$post_translations = $sitepress->get_element_translations( $post_trid, $icl_el_type );

				foreach ( $post_translations as $lang => $translation ) {
					$res = $wpdb->get_row( "SELECT status, needs_update, md5 FROM {$wpdb->prefix}icl_translation_status WHERE translation_id={$translation->translation_id}" );
					if ( $res ) {
						$_suffix          = str_replace( '-', '_', $lang );
						$index            = 'status_' . $_suffix;
						$new_item->$index = $res->status;
						$index            = 'needs_update_' . $_suffix;
						$new_item->$index = $res->needs_update;
					}
				}

				$items[ ] = $new_item;
			}
		}

		return $items;
	}

	function new_external_item( $type, $package_item, $get_string_data = false ) {
		//create a new external item for the Translation Dashboard or for translation jobs

		$package_id = $package_item['ID'];

		$item                 = new stdClass();
		$item->external_type  = true;
		$item->type           = $type;
		$item->ID             = $package_id;
		$item->post_type      = $type;
		$item->post_id        = 'external_' . $item->post_type . '_' . $package_item['ID'];
		$item->post_date      = '';
		$item->post_status    = __( 'Active', 'wpml-package-trans' );
		$item->post_title     = $package_item['title'];
		$item->is_translation = false;

		if ( $get_string_data ) {
			$item->string_data = $this->_get_package_strings( $package_item );
		}

		return $item;
	}

	function get_translatable_item( $item, $id ) {
		//for TranslationManagement::send_jobs 

		if ( $item == null ) {

			$package = $this->get_package_from_id( $id );
			if ( ! $id ) {
				return null;
			}

			$item = $this->new_external_item( sanitize_title_with_dashes( $package['kind'] ), $package, true );
		}

		return $item;
	}

	function get_package_from_id( $post_id ) {

		global $wpdb;

		$packages = $wpdb->get_col( "SELECT ID FROM {$wpdb->prefix}icl_string_packages WHERE ID>0" );

		foreach ( $packages as $package_id ) {

			$item = $this->get_package_details( $package_id );

			$test = 'external_' . sanitize_title_with_dashes( $item['kind'] ) . '_' . $item['ID'];
			if ( is_string( $post_id ) && $post_id == $test ) {
				return $item;
			}
		}

		return false; //not a package type
	}

	function _get_package_strings( $package_item ) {
		global $wpdb;
		$strings = array();

		$package_item_id = $package_item[ 'ID' ];
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT name, value FROM {$wpdb->prefix}icl_strings WHERE string_package_id=%d", $package_item_id ) );

		foreach ( $results as $result ) {
			$string_name             = substr( $result->name, strlen( $package_item_id ) + 1 );
			$strings[ $string_name ] = $result->value;
		}

		// Add/update any registered strings
		if ( isset( $this->registered_strings[ $package_item_id ][ 'strings' ] ) ) {
			foreach ( $this->registered_strings[ $package_item_id ][ 'strings' ] as $id => $string_data ) {
				$strings[ $id ] = $string_data[ 'value' ];
			}
		}

		return $strings;
	}

	function get_link( $item, $package_item, $anchor, $hide_empty ) {
		if ( $item == "" ) {
			$package_item = $this->get_package_from_id( $package_item );
			if ( ! $package_item ) {
				return '';
			}

			if ( false === $anchor ) {
				if ( isset( $package_item->edit_link ) ) {
					$anchor = '<a href="' . $package_item->edit_link . '">' . $package_item['title'] . '</a>';
				} else {
					$anchor = $package_item['title'];
				}
			} else {
				if ( isset( $package_item->edit_link ) ) {
					$anchor = '<a href="' . $package_item['edit_link'] . '">' . $anchor . '</a>';
				}
			}

			$item = $anchor;
		}

		return $item;
	}

	function estimate_word_count( $word_count, $document, $source_language_code ) {
		if ( isset( $document->external_type ) && $document->external_type ) {
			$word_count = 0;

			$package = $this->get_package_from_id( $document->post_id );

			$strings = $this->_get_package_strings( $package );

			if ( $strings ) {
				global $WPML_String_Translation;
				if ( isset( $WPML_String_Translation ) ) {
					foreach ( $strings as $string_id => $string_value ) {
						$word_count += $WPML_String_Translation->estimate_word_count( $string_value, $source_language_code );
					}
				}
			}
		}

		return $word_count;
	}

	/**
	 * Update translations
	 *
	 * @param      $package_id
	 * @param bool $is_new       - set to true for newly created form (first save without fields)
	 * @param bool $needs_update - when deleting single field we do not need to change the translation status of the form
	 *
	 * @internal param array $item - package information
	 */
	function update_package_translations( $package_id, $is_new, $needs_update = true ) {

		global $sitepress, $wpdb, $iclTranslationManagement;

		$item = $this->get_package_details( $package_id );

		$post_id = 'external_' . sanitize_title_with_dashes( $item['kind'] ) . '_' . $item['ID'];
		$post    = $this->get_translatable_item( null, $post_id );
		if ( ! $post ) {
			return;
		}
		$default_lang = $sitepress->get_default_language();
		$icl_el_type  = $this->get_package_element_type( $item );
		$trid         = $sitepress->get_element_trid( $item['ID'], $icl_el_type );

		if ( $is_new ) {
			$sitepress->set_element_language_details( $post->ID, $icl_el_type, false, $default_lang, null, false );

			//for new package nothing more to do
			return;
		}

		$sql                  = "
        	SELECT t.translation_id, s.md5 FROM {$wpdb->prefix}icl_translations t
        		NATURAL JOIN {$wpdb->prefix}icl_translation_status s
        	WHERE t.trid=%d AND t.source_language_code IS NOT NULL";
		$element_translations = $wpdb->get_results( $wpdb->prepare( $sql, $trid ) );

		if ( ! empty( $element_translations ) ) {

			$md5 = $iclTranslationManagement->post_md5( $post );

			if ( $md5 != $element_translations[ 0 ]->md5 ) { //all translations need update

				$translation_package = $iclTranslationManagement->create_translation_package( $post );

				foreach ( $element_translations as $trans ) {
					$_prevstate = $wpdb->get_row( $wpdb->prepare( "
                        SELECT status, translator_id, needs_update, md5, translation_service, translation_package, timestamp, links_fixed
                        FROM {$wpdb->prefix}icl_translation_status
                        WHERE translation_id = %d
                    ", $trans->translation_id ), ARRAY_A );
					if ( ! empty( $_prevstate ) ) {
						$data[ '_prevstate' ] = serialize( $_prevstate );
					}
					$data = array(
						'translation_id'      => $trans->translation_id,
						'translation_package' => serialize( $translation_package ),
						'md5'                 => $md5,
					);

					//update only when something changed (we do not need to change status when deleting a field)
					if ( $needs_update ) {
						$data[ 'needs_update' ] = 1;
					}

					$update_result = $iclTranslationManagement->update_translation_status( $data );
					$rid           = $update_result[ 0 ];
					$this->update_icl_translate( $rid, $post );

					//change job status only when needs update
					if ( $needs_update ) {
						$job_id = $wpdb->get_var( $wpdb->prepare( "SELECT MAX(job_id) FROM {$wpdb->prefix}icl_translate_job WHERE rid=%d GROUP BY rid", $rid ) );
						if ( $job_id ) {
							$wpdb->update( "{$wpdb->prefix}icl_translate_job", array( 'translated' => 0 ), array( 'job_id' => $job_id ), array( '%d' ), array( '%d' ) );
						}
					}
				}
			}
		}
	}

	/**
	 * Functions to update translations when packages are modified in admin
	 *
	 * @param $rid
	 * @param $post
	 */

	function update_icl_translate( $rid, $post ) {

		global $wpdb;

		$job_id   = $wpdb->get_var( $wpdb->prepare( "SELECT MAX(job_id) FROM {$wpdb->prefix}icl_translate_job WHERE rid=%d GROUP BY rid", $rid ) );
		$elements = $wpdb->get_results( $wpdb->prepare( "SELECT field_type, field_data, tid, field_translate FROM {$wpdb->prefix}icl_translate
        												WHERE job_id=%d", $job_id ), OBJECT_K );

		foreach ( $post->string_data as $field_type => $field_value ) {
			$field_data = base64_encode( $field_value );
			if ( ! isset( $elements[ $field_type ] ) ) {
				//insert new field

				$data = array(
					'job_id'                => $job_id,
					'content_id'            => 0,
					'field_type'            => $field_type,
					'field_format'          => 'base64',
					'field_translate'       => 1,
					'field_data'            => $field_data,
					'field_data_translated' => 0,
					'field_finished'        => 0
				);

				$wpdb->insert( $wpdb->prefix . 'icl_translate', $data );
			} elseif ( $elements[ $field_type ]->field_data != $field_data ) {
				//update field value
				$wpdb->update( $wpdb->prefix . 'icl_translate', array( 'field_data' => $field_data, 'field_finished' => 0 ), array( 'tid' => $elements[ $field_type ]->tid ) );
			}
		}

		foreach ( $elements as $field_type => $el ) {
			//delete fields that are no longer present
			if ( $el->field_translate && ! isset( $post->string_data[ $field_type ] ) ) {
				$wpdb->delete( $wpdb->prefix . 'icl_translate', array( 'tid' => $el->tid ), array( '%d' ) );
			}
		}
	}

	private function get_package_details( $package_id ) {
		global $wpdb;
		static $cache = array();

		if ( ! isset( $cache[ $package_id ] ) ) {
			$item                 = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}icl_string_packages WHERE ID='%d'", $package_id ), ARRAY_A );
			$cache[ $package_id ] = $item;
		}

		return $cache[ $package_id ];
	}

	function get_string_context_title( $context, $string_details ) {
		global $wpdb;

		static $cache = array();

		if ( ! isset( $cache[ $context ] ) ) {
			$package_id = $wpdb->get_var( "SELECT string_package_id FROM {$wpdb->prefix}icl_strings WHERE id={$string_details['string_id']}" );
			if ( $package_id ) {
				$package_details = $this->get_package_details( $package_id );
				if ( $package_details ) {
					$cache[ $context ] = $package_details->kind . ' - ' . $package_details->title;
				} else {
					$cache[ $context ] = $context;
				}
			} else {
				$cache[ $context ] = $context;
			}
		}

		return $cache[ $context ];
	}

	function get_string_title( $title, $string_details ) {
		global $wpdb;

		$string_title = $wpdb->get_var( "SELECT title FROM {$wpdb->prefix}icl_strings WHERE id={$string_details['string_id']}" );
		if ( $string_title ) {
			return $string_title;
		} else {
			return $title;
		}
	}

	function get_post_title( $title, $post_id ) {
		$package = $this->get_package_from_id( $post_id );
		if ( ! $package ) {
			return $title; //not ours
		} else {
			return $package['kind'] . ' - ' . $package['title'];
		}
	}

	function get_editor_string_name( $name, $string_package ) {
		global $wpdb;
		$string_package_id = $string_package[ 'ID' ];
		$string_name = $string_package_id . '_' . $name;
		$title       = $wpdb->get_var( "SELECT title FROM {$wpdb->prefix}icl_strings WHERE string_package_id={$string_package_id} AND name='{$string_name}'" );
		if ( $title && $title != '' ) {
			$name = $title;
		}

		return $name;
	}

	function get_editor_string_style( $style, $field_type, $string_package ) {
		global $wpdb;
		$string_package_id = $string_package[ 'ID' ];
		$string_name = $string_package['ID'] . '_' . $field_type;
		$new_style   = $wpdb->get_var( "SELECT type FROM {$wpdb->prefix}icl_strings WHERE string_package_id={$string_package_id} AND name='{$string_name}'" );
		if ( $new_style ) {
			switch ( $new_style ) {
				case 'AREA':
					$style = 1;
					break;

				case 'VISUAL':
					$style = 2;
					break;

				default:
					$style = 0;
			}
		}

		return $style;
	}

	function get_string_package( $state, $post_id ) {
		return $this->get_package_from_id( $post_id );
	}

	function get_package_type( $type, $post_id ) {
		$package = $this->get_package_from_id( $post_id );
		if ( $package ) {
			return $this->get_string_context( array(
				                                  'kind' => $package['kind'],
				                                  'name' => $package['name'],
			                                  ) );
		} else {
			return $type;
		}
	}

	function menu() {
		if ( ! defined( 'ICL_PLUGIN_PATH' ) ) {
			return;
		}
		global $sitepress;
		if ( ! isset( $sitepress ) || ( method_exists( $sitepress, 'get_setting' ) && ! $sitepress->get_setting( 'setup_complete' ) ) ) {
			return;
		}

		global $sitepress_settings;

		if ( ( ! isset( $sitepress_settings[ 'existing_content_language_verified' ] ) || ! $sitepress_settings[ 'existing_content_language_verified' ] ) ) {
			return;
		}

		// ????? What user capabilities should be used ??????
		if ( current_user_can( 'wpml_manage_string_translation' ) ) {
			$top_page = apply_filters( 'icl_menu_main_page', basename( ICL_PLUGIN_PATH ) . '/menu/languages.php' );

			add_submenu_page( $top_page, __( 'Packages', 'wpml-package-trans' ), __( 'Packages', 'wpml-package-trans' ), 'wpml_manage_string_translation', 'wpml-package-management', array( $this, 'package_translation_menu' ) );
		}
	}

	function package_translation_menu() {
		global $wpdb;

		$packages      = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}icl_string_packages WHERE ID>0" );
		$package_kinds = array();

		foreach ( $packages as $package ) {
			if ( ! in_array( $package->kind, $package_kinds ) ) {
				$package_kinds[ ] = $package->kind;
			}
		}
		?>

		<div id="icon-wpml" class="icon32"><br/></div>
		<h2><label for="package_kind"><?php _e( 'Package Management', 'wpml-package-trans' ) ?></label></h2>

		<p>
			<?php _e( 'Display packages for this kind:', 'wpml-package-trans' ) ?>
			<select id="package_kind">
				<option value="-1"><?php _e( 'All', 'wpml-package-trans' ) ?></option>

				<?php foreach ( $package_kinds as $kind ): ?>
					<option value="<?php echo $kind; ?>"><?php echo $kind; ?></option>
				<?php endforeach; ?>

			</select>
		</p>

		<table id="icl_package_translations" class="widefat" cellspacing="0">
			<thead>
			<tr>
				<th scope="col" class="manage-column column-cb check-column">
					<label for="js_package_all_cb_head" style="display: none;"></label>
					<input id="js_package_all_cb_head" class="js_package_all_cb" type="checkbox"/>
				</th>
				<th scope="col"><?php echo __( 'Kind', 'wpml-package-trans' ) ?></th>
				<th scope="col"><?php echo __( 'Name', 'wpml-package-trans' ) ?></th>
				<th scope="col"><?php echo __( 'Info', 'wpml-package-trans' ) ?></th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th scope="col" class="manage-column column-cb check-column">
					<label for="js_package_all_cb_foot" style="display: none;"></label>
					<input id="js_package_all_cb_foot" class="js_package_all_cb" type="checkbox"/>
				</th>
				<th scope="col"><?php echo __( 'Kind', 'wpml-package-trans' ) ?></th>
				<th scope="col"><?php echo __( 'Name', 'wpml-package-trans' ) ?></th>
				<th scope="col"><?php echo __( 'Info', 'wpml-package-trans' ) ?></th>
			</tr>
			</tfoot>
			<tbody>

			<?php if ( count( $packages ) == 0 ): ?>
				<tr>
					<td colspan="6" align="center"><strong><?php echo __( 'No packages found', 'wpml-package-trans' ) ?></strong></td>
				</tr>
			<?php else: ?>

				<?php foreach ( $packages as $package ): ?>
					<?php
					$translation_in_progress = self::_is_translation_in_progress( $package );
					$string_count            = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}icl_strings WHERE string_package_id=%d", $package->ID ) );
					?>

					<tr>
						<td>
							<label for="js_package_row_cb<?php echo $package->ID ?>" style="display: none;"></label>
							<input id="js_package_row_cb<?php echo $package->ID ?>" class="js_package_row_cb" type="checkbox" value="<?php echo $package->ID ?>" <?php if ( $translation_in_progress ) {
								echo 'disabled="disabled" ';
							} ?>/>
						</td>
						<td class="js-package-kind"><?php echo $package->kind; ?></td>
						<td><?php echo $package->title; ?></td>

						<td>
							<?php echo sprintf( __( 'Contains %s strings', 'wpml-package-trans' ), $string_count ) ?>
							<?php if ( $translation_in_progress ) {
								echo ' - ' . __( 'Translation is in progress', 'wpml-package-trans' );
							}
							?>
						</td>
					</tr>
				<?php endforeach; ?>

			<?php endif; ?>

			</tbody>
		</table>

		<br/>

		<input id="delete_packages" type="button" class="button-primary" value="<?php echo __( 'Delete Selected Packages', 'wpml-package-trans' ) ?>" disabled="disabled"/>
		&nbsp;
		<img src="<?php echo ICL_PLUGIN_URL . '/res/img/ajax-loader.gif'; ?>" alt="loading" height="16" width="16" class="wpml_tt_spinner"/>
		<span style="display:none" class="js-delete-confirm-message"><?php echo __( "Are you sure you want to delete these packages?\nTheir strings and translations will be deleted too.", 'wpml-string-translation' ) ?></span>

		<?php

		wp_nonce_field( 'wpml_package_nonce', 'wpml_package_nonce' );
	}

	function _get_post_translations( $package ) {
		global $sitepress;

		if(is_object($package)) {
			$package = get_object_vars( $package );
		}

		$icl_el_type = $this->get_package_element_type( $package[ 'kind' ] );
		$trid        = $sitepress->get_element_trid( $package[ 'ID' ], $icl_el_type );

		return $sitepress->get_element_translations( $trid, $icl_el_type );
	}

	function _is_translation_in_progress( $package ) {
		global $wpdb;

		$post_translations = self::_get_post_translations( $package );

		foreach ( $post_translations as $lang => $translation ) {
			$res = $wpdb->get_row( "SELECT status, needs_update, md5 FROM {$wpdb->prefix}icl_translation_status WHERE translation_id={$translation->translation_id}" );
			if ( $res && $res->status == ICL_TM_IN_PROGRESS ) {
				return true;
			}
		}

		return false;
	}

	function enqueue_scripts() {
		global $pagenow;

		if ( $pagenow == 'admin.php' && isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wpml-package-management' ) {
			wp_register_script( 'wpml-package-trans-man-script', WPML_PACKAGE_TRANSLATION_URL . '/resources/js/wpml_package_management.js', array( 'jquery' ) );
			wp_enqueue_script( 'wpml-package-trans-man-script' );
		}
	}

	function delete_packages() {
		global $wpdb;

		if ( ! isset( $_POST[ 'wpnonce' ] )
		     || ! wp_verify_nonce( $_POST[ 'wpnonce' ], 'wpml_package_nonce' )
		) {
			die( 'verification failed' );
		}

		$packages = $_POST[ 'packages' ];

		foreach ( $packages as $package_id ) {

			// delete the strings and the translations

			$strings = $wpdb->get_col( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}icl_strings WHERE string_package_id=%d", $package_id ) );

			foreach ( $strings as $string_id ) {
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}icl_strings WHERE id=%d", $string_id ) );
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}icl_string_translations WHERE string_id=%d", $string_id ) );
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}icl_string_positions WHERE string_id=%d", $string_id ) );
			}

			// delete the translation jobs			
			self::_delete_translation_job( $package_id );

			// delete the package
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}icl_string_packages WHERE ID='%d'", $package_id ) );
		}
		exit;
	}

	function _delete_translation_job( $package_id ) {
		global $wpdb;

		$package = $this->get_package_details( $package_id );

		$post_translations = $this->_get_post_translations( $package );
		foreach ( $post_translations as $lang => $translation ) {
			$rid = $wpdb->get_var( "SELECT rid FROM {$wpdb->prefix}icl_translation_status WHERE translation_id={$translation->translation_id}" );
			if ( $rid ) {
				$job_id = $wpdb->get_var( "SELECT job_id FROM {$wpdb->prefix}icl_translate_job WHERE rid={$rid}" );

				if ( $job_id ) {
					$wpdb->query( "DELETE FROM {$wpdb->prefix}icl_translate_job WHERE job_id={$job_id}" );
					$wpdb->query( "DELETE FROM {$wpdb->prefix}icl_translate WHERE job_id={$job_id}" );
				}
			}
		}
	}

	/**
	 * @param       $package
	 * @param array $args
	 */
	function show_language_selector( $package, $args = array() ) {
		global $wpdb, $sitepress;

		$default_args = array(
			'show_title'                  => true,
			'show_description'            => true,
			'show_status'                 => true,
			'show_link'                   => true,
			'title_tag'                   => 'h2',
			'status_container_tag'        => 'p',
			'main_container_attributes'   => array(),
			'status_container_attributes' => array( 'style' => 'padding-left: 10px' ),
		);

		$args = array_merge( $default_args, $args );

		$show_title                  = $args[ 'show_title' ];
		$show_description            = $args[ 'show_description' ];
		$show_status                 = $args[ 'show_status' ];
		$show_link                   = $args[ 'show_link' ];
		$title_tag                   = $args[ 'title_tag' ];
		$status_container_tag        = $args[ 'status_container_tag' ];
		$main_container_attributes   = $args[ 'main_container_attributes' ];
		$status_container_attributes = $args[ 'status_container_attributes' ];

		$container_attributes_html        = $this->attributes_to_string( $main_container_attributes );
		$status_container_attributes_html = $this->attributes_to_string( $status_container_attributes );

		$package_id = $this->_get_package_id( $package );
		$sanitized_package_kind = sanitize_title_with_dashes($package[ 'kind' ]);
		if ( $package_id ) {

			$dashboard_link = admin_url( 'admin.php?page=' . WPML_TM_FOLDER . '/menu/main.php&sm=dashboard&type=' . strtolower( $sanitized_package_kind ) );

			$package           = $this->get_package_details( $package_id );
			if($show_status) {
				$post_translations = $this->_get_post_translations( $package );
				$status            = array();
				foreach ( $post_translations as $lang => $translation ) {
					$res = $wpdb->get_row( "SELECT status, needs_update FROM {$wpdb->prefix}icl_translation_status WHERE translation_id={$translation->translation_id}" );
					if ( $res ) {
						switch ( $res->status ) {
							case ICL_TM_WAITING_FOR_TRANSLATOR:
								$res->status = __( 'Waiting for translator', 'wpml-package-trans' );
								break;
							case ICL_TM_IN_PROGRESS:
								$res->status = __( 'In progress', 'wpml-package-trans' );
								break;
							case ICL_TM_NEEDS_UPDATE:
								$res->status = '';
								break;
							case ICL_TM_COMPLETE:
								$res->status = __( 'Complete', 'wpml-package-trans' );
								break;
							default:
								$res->status = __( 'Not translated', 'wpml-package-trans' );
								break;
						}

						if ( $res->needs_update ) {
							if ( $res->status ) {
								$res->status .= ' - ';
							}
							$res->status .= __( 'Needs update', 'wpml-package-trans' );
						}
						$status[ $lang ] = $res;
					}
				}
			}
			$active_languages = $sitepress->get_active_languages();
			$default_language = $sitepress->get_default_language();
			?>
			<div <?php echo $container_attributes_html; ?>>
				<?php
				if ( $show_title ) {
					if($title_tag) {
						echo $this->get_tag($title_tag);
					}
					echo __( 'WPML Translation', 'wpml-package-trans' );
					if($title_tag) {
						echo $this->get_tag($title_tag, 'closed');
					}
				}
				if ( $show_description ) {
					?>
					<p>
						<?php echo sprintf( __( 'Language of this %s is %s', 'wpml-package-trans' ), $package[ 'kind' ], $active_languages[ $default_language ][ 'display_name' ] ) ?>
						<br/>
						<?php _e( 'Translation status:', 'wpml-package-trans' ); ?>
					</p>
				<?php
				}
				if ( $show_status ) {

					if ( $status_container_tag ) {
						echo $this->get_tag( $status_container_tag . ' ' . $status_container_attributes_html );
					}
					foreach ( $active_languages as $lang => $data ) {
						if ( $lang != $default_language ) {
							if ( isset( $status[ $lang ] ) ) {
								echo $data[ 'display_name' ] . ' : ' . $status[ $lang ]->status;
							} else {
								echo $data[ 'display_name' ] . ' : ' . __( 'Not translated', 'wpml-package-trans' );
							}
							echo '<br />';
						}
					}
					if ( $status_container_tag ) {
						echo $this->get_tag( $status_container_tag, 'closed' );
					}
				}
				if ( $show_link ) {
					?>
					<p><a href="<?php echo $dashboard_link ?>" target="_blank"><?php echo sprintf( __( 'Send %s to translation', 'wpml-package-trans' ), $package[ 'kind' ] ); ?></a></p>
				<?php
				}
				?>
			</div>
		<?php
		}
	}

	private function get_tag($tag, $closed = false) {
		$result = '<';
		if($closed) {
			$result .= '/';
		}
		$result .= $tag . '>';

		return $result;
	}
}
