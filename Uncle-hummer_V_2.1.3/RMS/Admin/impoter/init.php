<?php
/**
 * Version 0.0.2
 */

require dirname( __FILE__ ) .'/importer/radium-importer.php'; //load admin theme data importer

class Radium_Theme_Demo_Data_Importer extends Radium_Theme_Importer {

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 0.0.1
     *
     * @var object
     */
    private static $instance;
    
    /**
     * Set the key to be used to store theme options
     *
     * @since 0.0.2
     *
     * @var object
     */
    public $theme_option_name = 'my_theme_options_name'; //set theme options name here
	
	public $content_demo_file_name  =  'content.xml';
	
	/**
	 * Holds a copy of the widget settings 
	 *
	 * @since 0.0.2
	 *
	 * @var object
	 */
	public $widget_import_results;
	
    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 0.0.1
     */
    public function __construct() {
    
		$this->demo_files_path = dirname(__FILE__) . '/demo-files/';

        self::$instance = $this;
		parent::__construct();

    }
	
	/**
	 * Add menus
	 *
	 * @since 0.0.1
	 */
	public function set_demo_menus(){

		// Menus to Import and assign - you can remove or add as many as you want
		$top_menu = get_term_by('name', 'Top Menu', 'nav_menu');
		$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
		$footer_menu = get_term_by('name', 'Main Menu', 'nav_menu');

		set_theme_mod( 'nav_menu_locations', array(
                'top-menu' => $top_menu->term_id,
                'primary' => $main_menu->term_id,
                'footer-menu' => $footer_menu->term_id
            )
        );

	}

}

new Radium_Theme_Demo_Data_Importer;