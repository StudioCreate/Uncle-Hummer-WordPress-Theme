<?php

class WPML_Admin_String_Filter extends WPML_Displayed_String_Filter {

	/**
	 * @param $language String
	 * @param $existing_filter WPML_Displayed_String_Filter
	 */
	public function __construct( $language, $existing_filter ) {
		parent::__construct( $language );


		if ( $existing_filter ) {
			$existing_cache      = $existing_filter->export_cache();
			$this->cache         = isset( $existing_cache[ 'cache' ] ) ? $existing_cache[ 'cache' ] : array();
			$this->name_cache    = isset( $existing_cache[ 'name_cache' ] ) ? $existing_cache[ 'cache' ] : array();
		}
	}

	public function translate_by_name_and_context( $untranslated_text, $name, $context = "", &$has_translation = null) {
		if ( $untranslated_text ) {
			$translation = $this->string_from_registered( $untranslated_text, $name, $context );
			if ( $translation === false && $this->language == 'en' ) {
				$this->register_string( $context, $name, $untranslated_text );
				$translation = $untranslated_text;
			}
		} else {
			$translation = parent::translate_by_name_and_context( $untranslated_text, $name, $context );
		}

		return $translation ? $translation : $untranslated_text;
	}

	public function register_string( $context, $name, $value, $allow_empty_value = false ) {
		global $wpdb, $sitepress_settings;

		/* cpt slugs - do not register them when scanning themes and plugins
		 * if name starting from 'URL slug: '
		 * and context is different from 'WordPress'
		 */
		if ( substr( $name, 0, 10 ) === 'URL slug: ' && 'WordPress' !== $context ) {
			return false;
		}

		// if the default language is not set up return without doing anything
		if (
			! isset( $sitepress_settings[ 'existing_content_language_verified' ] ) ||
			! $sitepress_settings[ 'existing_content_language_verified' ]
		) {
			return false;
		}

		$translation = $this->string_from_registered( $value, $name, $context );
		if ( $translation == $value ) {
			return false;
		}

		$language = isset( $sitepress_settings[ 'st' ][ 'strings_language' ] ) ? $sitepress_settings[ 'st' ][ 'strings_language' ] : 'en';
		$query    = $wpdb->prepare( "SELECT id, value, status, language FROM {$wpdb->prefix}icl_strings WHERE context=%s AND name=%s",
		                            $context,
		                            $name );
		$res      = $wpdb->get_row( $query );
		if ( $res ) {
			$string_id     = $res->id;
			$update_string = array();


			/*
			 * If Sticky Links plugin is active and set to change links in Strings,
			 * we need to process $value and change links into sticky before comparing
			 * with saved in DB $res->value.
			 * Otherwise after every String Translation screen refresh status of this string
			 * will be changed into 'needs update'
			 */
			$alp_settings = get_option( 'alp_settings' );
			if ( ! empty( $alp_settings[ 'sticky_links_strings' ] ) // do we have setting about sticky links in strings?
			     && $alp_settings[ 'sticky_links_strings' ] // is this set to TRUE?
			     && defined( 'WPML_STICKY_LINKS_VERSION' )
			) { // sticky links plugin is active?
				require_once ICL_PLUGIN_PATH . '/inc/absolute-links/absolute-links.class.php';
				$absolute_links_object = new AbsoluteLinks;
				$alp_broken_links      = array();
				$value                 = $absolute_links_object->_process_generic_text( $value, $alp_broken_links );
			}


			if ( $value != $res->value ) {
				$update_string[ 'value' ] = $value;
			}
			if ( $language != $res->language ) {
				$update_string[ 'language' ] = $language;
			}
			if ( ! empty( $update_string ) ) {
				$wpdb->update( $wpdb->prefix . 'icl_strings', $update_string, array( 'id' => $string_id ) );
				$wpdb->update( $wpdb->prefix . 'icl_string_translations',
				               array( 'status' => ICL_STRING_TRANSLATION_NEEDS_UPDATE ),
				               array( 'string_id' => $string_id ) );
				icl_update_string_status( $string_id );
			}
		} else {
			$string_id = $this->save_string( $value, $allow_empty_value, $language, $context, $name );
		}

		global $WPML_Sticky_Links;
		if ( ! empty( $WPML_Sticky_Links ) && $WPML_Sticky_Links->settings[ 'sticky_links_strings' ] ) {
			require_once ICL_PLUGIN_PATH . '/inc/translation-management/pro-translation.class.php';
			ICL_Pro_Translation::_content_make_links_sticky( $string_id, 'string', false );
		}

		$this->name_cache[ $name . $context ] = $value;

		return $string_id;
	}

	private function save_string( $value, $allow_empty_value, $language, $context, $name ) {

		if ( ( $name || $value )
		     && ( ! empty( $value )
		          && is_scalar( $value ) && trim( $value ) || $allow_empty_value )
		) {
			global $wpdb;

			$name = $name ? $name : md5( $value );
			$string = array(
				'language' => $language,
				'context'  => $context,
				'name'     => $name,
				'value'    => $value,
				'status'   => ICL_STRING_TRANSLATION_NOT_TRANSLATED,
			);

			$wpdb->insert( $wpdb->prefix . 'icl_strings', $string );

			$string_id = $wpdb->insert_id;

			icl_update_string_status( $string_id );
		} else {
			$string_id = 0;
		}

		return $string_id;
	}

}