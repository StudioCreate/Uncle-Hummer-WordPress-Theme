<?php

class WPML_Package_Translation_Schema {

	private static $charset_collate;
	private static $table_name;

	static function activate() {
		try {
			self::$charset_collate = self::build_charset_collate();

			self::build_icl_string_packages_table();
			self::fix_icl_string_packages_ID_column();
			self::build_icl_strings_columns();
		} catch ( Exception $e ) {
			trigger_error( $e->getMessage(), E_USER_ERROR );
			exit;
		}
	}

	private static function current_table_has_column( $column ) {
		global $wpdb;

		$cols  = $wpdb->get_results( "SHOW COLUMNS FROM `" . self::$table_name . "`" );
		$found = false;
		foreach ( $cols as $col ) {
			if ( $col->Field == $column ) {
				$found = true;
				break;
			}
		}

		return $found;
	}

	private static function add_string_package_id_to_icl_strings() {
		global $wpdb;
		$sql = "ALTER TABLE `" . self::$table_name . "`
						ADD `string_package_id` BIGINT unsigned NULL AFTER value,
						ADD INDEX (`string_package_id`)";
		return $wpdb->query( $sql );
	}

	private static function add_type_to_icl_strings() {
		global $wpdb;
		$sql = "ALTER TABLE `" . self::$table_name . "` ADD `type` VARCHAR(40) NOT NULL DEFAULT 'LINE' AFTER string_package_id";
		return $wpdb->query( $sql );
	}

	private static function add_title_to_icl_strings() {
		global $wpdb;
		$sql = "ALTER TABLE `" . self::$table_name . "` ADD `title` VARCHAR(160) NULL AFTER type";
		return $wpdb->query( $sql );
	}

	private static function build_icl_strings_columns() {
		global $wpdb;
		self::$table_name = $wpdb->prefix . 'icl_strings';

		if ( ! self::current_table_has_column( 'string_package_id' ) ) {
			self::add_string_package_id_to_icl_strings();
		}

		if ( ! self::current_table_has_column( 'type' ) ) {
			self::add_type_to_icl_strings();
		}

		if ( ! self::current_table_has_column( 'title' ) ) {
			self::add_title_to_icl_strings();
		}
	}

	private static function build_icl_string_packages_table() {
		global $wpdb;
		self::$table_name = $wpdb->prefix . 'icl_string_packages';
		$sql              = "
                 CREATE TABLE IF NOT EXISTS `" . self::$table_name . "` (
                  `ID` bigint(20) unsigned NOT NULL auto_increment,
                  `kind` varchar(160) NOT NULL,
                  `name` varchar(160) NOT NULL,
                  `title` varchar(160) NOT NULL,
                  `edit_link` text NOT NULL,
                  PRIMARY KEY  (`ID`)
                ) " . self::$charset_collate . "";
		if ( $wpdb->query( $sql ) === false ) {
			throw new Exception( $wpdb->last_error );
		}
	}

	private static function fix_icl_string_packages_ID_column() {
		global $wpdb;
		self::$table_name = $wpdb->prefix . 'icl_string_packages';
		if ( self::current_table_has_column( 'id' ) ) {
			$sql = "ALTER TABLE `" . self::$table_name . "` CHANGE id ID BIGINT UNSIGNED NOT NULL auto_increment;";
			$wpdb->query( $sql );
		}
	}

	private static function build_charset_collate() {
		$charset_collate = '';
		if ( self::wpdb_has_cap_collation() ) {
			$charset_collate .= self::build_default_char_set();
			$charset_collate .= self::build_collate();
		}

		return $charset_collate;
	}

	private static function wpdb_has_cap_collation() {
		global $wpdb;

		return method_exists( $wpdb, 'has_cap' ) && $wpdb->has_cap( 'collation' );
	}

	private static function build_default_char_set() {
		global $wpdb;
		$charset_collate = '';
		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

			return $charset_collate;
		}

		return $charset_collate;
	}

	private static function build_collate() {
		global $wpdb;
		$charset_collate = '';
		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE $wpdb->collate";

			return $charset_collate;
		}

		return $charset_collate;
	}
}