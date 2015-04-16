<?php

class WPML_Localization {

	public function get_theme_localization_stats() {
		global $sitepress_settings, $wpdb;

		$results = array();
		if ( isset( $sitepress_settings[ 'st' ][ 'theme_localization_domains' ] ) ) {
			$domains = array();

			foreach ( (array) $sitepress_settings[ 'st' ][ 'theme_localization_domains' ] as $domain ) {
				$domains[ ] = $domain ? 'theme ' . $domain : 'theme';
			}
			if ( ! empty( $domains ) ) {
				$results = $wpdb->get_results( "
		            SELECT context, status, COUNT(id) AS c
		            FROM {$wpdb->prefix}icl_strings
		            WHERE context IN ('" . join( "','", $domains ) . "')
		            GROUP BY context, status
		        " );
			}
		}

		return $this->results_to_array( $results );
	}

	public function get_plugin_localization_stats() {
		global $wpdb;

		$results = $wpdb->get_results( "
	        SELECT context, status, COUNT(id) AS c
	        FROM {$wpdb->prefix}icl_strings
	        WHERE context LIKE ('plugin %')
	        GROUP BY context, status
	    " );

		return $this->results_to_array( $results );
	}

	private function results_to_array( $results ) {
		$stats = array();

		foreach ( $results as $r ) {
			if ( ! isset( $stats[ $r->context ][ 'complete' ] ) ) {
				$stats[ $r->context ][ 'complete' ] = 0;
			}
			if ( ! isset( $stats[ $r->context ][ 'incomplete' ] ) ) {
				$stats[ $r->context ][ 'incomplete' ] = 0;
			}
			if ( $r->status == ICL_STRING_TRANSLATION_COMPLETE ) {
				$stats[ $r->context ][ 'complete' ] = $r->c;
			} else {
				$stats[ $r->context ][ 'incomplete' ] += $r->c;
			}
		}

		return $stats;
	}
}