<?php 
/*
Plugin Name: WPML package translation
Plugin URI: http://wpml.org/
Description: WPML package translation
Author: OnTheGoSystems
Author URI: http://www.onthegosystems.com/
Version: 0.0.1-b1
*/

if(defined('WPML_PACKAGE_TRANSLATION')) return;

define('WPML_PACKAGE_TRANSLATION', '0.0.1');
define('WPML_PACKAGE_TRANSLATION_PATH', dirname(__FILE__));
define('WPML_PACKAGE_TRANSLATION_URL', plugins_url() . '/' . basename(WPML_PACKAGE_TRANSLATION_PATH) );

require WPML_PACKAGE_TRANSLATION_PATH  . '/inc/wpml_package_translation_schema.php';
register_activation_hook( __FILE__, array('WPML_Package_Translation_Schema', 'activate') );

require WPML_PACKAGE_TRANSLATION_PATH  . '/inc/wpml_package_translation.class.php';

$WPML_package_translation = new WPML_package_translation();