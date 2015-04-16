<?php
/**
 * RMS WordPress Framework
 *
 * Copyright (c) 2014, ThemeOnLab, s.r.o. (http://themeonlab.com)
 */

//=================================
// Theme Option Menu
//=================================
add_action('admin_menu', 'rms_theme_menu');

function rms_theme_menu() {
	add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'rms_theme_option', 'rms_options');
}


function rms_options()
{
    require_once RMS_ADMIN_DIR.'/script/options_settings.php';
}

function rms_frame_admin_enqueue()
{
    wp_enqueue_style( 'rms-option-style', get_template_directory_uri(). '/RMS/Admin/assets/css/optionFrameworkCss.css');
    wp_enqueue_style( 'rms-option-font', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
    wp_enqueue_style( 'option-select', get_template_directory_uri().'/RMS/Admin/assets/css/rms_select.css');
    wp_enqueue_style( 'option-color', get_template_directory_uri().'/RMS/Admin/assets/css/colorpicker.css');
    wp_enqueue_style( 'rms_wp_admin_css', get_template_directory_uri() . '/RMS/Admin/assets/css/admin-style.css');
    wp_enqueue_style( 'codemirror_css', get_template_directory_uri() . '/RMS/Admin/assets/css/codemirror.css');
    wp_enqueue_style( 'codemirrorr_css', get_template_directory_uri() . '/RMS/Admin/assets/css/lesser-dark.css');
    wp_enqueue_style( 'fontello-css', get_template_directory_uri() . '/RMS/Admin/assets/css/fontello.css');
    wp_enqueue_style( 'animation-css', get_template_directory_uri() . '/RMS/Admin/assets/css/animation.css');
    wp_enqueue_script('rms-cuostom-select-admin-js', get_template_directory_uri().'/RMS/Admin/assets/js/rms_select.js');
    wp_enqueue_script('rms-color-admin-js', get_template_directory_uri().'/RMS/Admin/assets/js/colorpicker.js');
    wp_enqueue_script('codemirror-js', get_template_directory_uri().'/RMS/Admin/assets/js/codemirror.js');
    wp_enqueue_script('codemirrorr-js', get_template_directory_uri().'/RMS/Admin/assets/js/javascript.js');
    wp_enqueue_script('rms-cuostom-admin-js', get_template_directory_uri().'/RMS/Admin/assets/js/admin_core.js');
    wp_enqueue_script('rms-importer', get_template_directory_uri().'/RMS/Framework/rms_importer/rms-importer.js');
}
add_action( 'admin_enqueue_scripts', 'rms_frame_admin_enqueue' );