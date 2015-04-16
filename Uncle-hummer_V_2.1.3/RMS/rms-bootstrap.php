<?php
/**
 * RMS WordPress Framework
 *
 * Copyright (c) 2014, ThemeOnLab, s.r.o. (http://themeonlab.com)
 */

define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_CSS_DIR', THEME_DIR.'/css');
define('THEME_CSS_URL', THEME_URL.'/css');
define('THEME_JS_DIR', THEME_DIR.'/js');
define('THEME_JS_URL', THEME_URL.'/js');

define('THEME_STYLESHEET_URL', get_bloginfo('stylesheet_url'));
define('THEME_STYLESHEET_FILE', THEME_DIR . '/style.css');

define('RMS_FRAMEWORK_DIR', THEME_DIR . '/RMS/Framework');
define('RMS_FRAMEWORK_URL', THEME_URL . '/RMS/Framework');
define('RMS_ADMIN_DIR', THEME_DIR . '/RMS/Admin');
define("RMS_ADMIN_URL", THEME_URL . '/RMS/Admin');

/*
*   Load RMS FRAMEWORK.
*
*
*
*/
require dirname(__FILE__) . '/Framework/bootstrap_load.php';
require dirname(__FILE__) . '/Admin/admin_load.php';