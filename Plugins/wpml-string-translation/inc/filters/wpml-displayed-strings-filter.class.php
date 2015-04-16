<?php

class WPML_Displayed_String_Filter {

	protected $language;
	protected $cache = array();
	protected $name_cache = array();

	public function __construct( $language ) {
		$this->language = $language;
		$this->warm_cache();
	}

	protected function warm_cache() {
		global $wpdb;

		$query = $wpdb->prepare( "
					SELECT st.value AS tra, s.name AS nam, s.value AS org, s.context AS ctx
					FROM {$wpdb->prefix}icl_strings s
					JOIN {$wpdb->prefix}icl_string_translations st
						ON s.id = st.string_id
					WHERE st.status = 1 AND st.language = %s",
		                         $this->language );
		$res   = $wpdb->get_results( $query, ARRAY_A );

		$name_cache = array();
		$warm_cache = array();
		foreach ( $res as $str ) {
			$warm_cache[ md5( stripcslashes( $str[ 'org' ] ) ) ] = stripcslashes( $str[ 'tra' ] );
			$name_cache[ $str[ 'nam' ] . $str[ 'ctx' ] ]         = &$str[ 'tra' ];
		}

		$this->cache      = $warm_cache;
		$this->name_cache = $name_cache;
	}

	public function translate_by_name_and_context( $untranslated_text, $name, $context = "", &$has_translation = null ) {


		$res             = $this->string_from_registered( $untranslated_text, $name, $context );
		$has_translation = $res ? true : null;
		$res             = ( ! $res && $untranslated_text ) ? $untranslated_text : $res;

		if ( ! $res ) {
			$res = $this->string_by_name_and_ctx( $name, $context );
		}

		return $res;
	}

	protected function string_from_registered( $untranslated_text, $name, $context = "" ) {
		$key = $name . $context;
		$res = isset( $this->name_cache[ $key ] ) ? $this->name_cache[ $key ] : false;

		if ( ! $res && $untranslated_text ) {
			$key = md5( $untranslated_text );
			$res = isset( $this->cache[ $key ] ) ? $this->cache[ $key ] : false;
		}

		return $res;
	}

	public function export_cache() {
		return array(
			'cache'      => $this->cache,
			'name_cache' => $this->name_cache,
		);
	}

	protected function string_by_name_and_ctx( $name, $context ) {
		/** @var wpdb $wpdb */
		global $wpdb;

		$query = $wpdb->prepare( "SELECT value FROM {$wpdb->prefix}icl_strings WHERE name = %s AND context = %s LIMIT 1",
		                         $name,
		                         $context );

		$value = $wpdb->get_var( $query );

		if ( $value ) {
			$this->name_cache[ $name . $context ] = $value;
		}

		return $value;
	}
}