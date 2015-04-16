<?php
if(session_id() == '')
{
    session_start();
}
/**
 * Reorder Wordpress Theme
 * 
 * Reorder only works in WordPress.
 */

//==============================
// WP Title
//==============================


//==================================
// Custom template tags for this theme.
//==================================
require get_template_directory() . '/inc/template-tags.php';





//============================================
// Load Language
//============================================

load_theme_textdomain('rms', get_template_directory() . '/languages');

// ============================================================================================
// Enables theme custom post types, widget, Shortcodes
// --------------------------------------------------------------------------------------------
$custom_post_type = array('portfolio'=>32, 'team'=> 34, 'testimonial'=> 35, 'features'=> 36, 'client' => 37);
$aitThemeWidgets = array('categorylist', 'popularpost', 'recentpost');
$rmsThemePageShortcode = array('features', 'team', 'portfolio', 'testimonial', 'googlemap', 'mybtn', 'heading', 'subtitle','partner','listimg','subheading','textblock','counter','product');

//==============================================================================================
// Loa  d RMS Bootstrap
//==============================================================================================
require dirname(__FILE__) . '/RMS/rms-bootstrap.php';
require dirname(__FILE__) . '/RMS/Admin/impoter/init.php';

if ( ! function_exists( 'alx_load' ) ) {
	
	function alx_load() {
		// Load TGM plugin activation
		load_template( get_template_directory() . '/RMS/Plugin/class-tgm-plugin-activation.php' );
	}
	
}
add_action( 'after_setup_theme', 'alx_load' );
/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'alx_plugins' ) ) {
	
	function alx_plugins() {
		
		// Add the following plugins
		$plugins = array(
			array(
				'name' 				=> 'Slider Revolution',
				'slug' 				=> 'revslider',
				'source'			=> get_template_directory() . '/RMS/Plugin/plugins/revslider.zip',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
            'name'			=> 'WPBakery Visual Composer', // The plugin name
            'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
            'source'			=> get_template_directory() . '/RMS/Plugin/plugins/js_composer.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name' 				=> 'Multiple Post Thumbnails',
				'slug' 				=> 'multiple-post-thumbnails',
				'source'			=> get_template_directory() . '/RMS/Plugin/plugins/multiple-post-thumbnails.zip', // The plugin source
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Really Simple CAPTCHA',
				'slug' 				=> 'really-simple-captcha',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Contact Form 7',
				'slug' 				=> 'contact-form-7',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'woocommerce',
				'slug' 				=> 'woocommerce',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'WooCommerce Cart Tab',
				'slug' 				=> 'woocommerce-cart-tab',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'WooCommerce Currency Switcher',
				'slug' 				=> 'woocommerce-currency-switcher',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			)
		);	
		tgmpa( $plugins );
	}
	
}
add_action( 'tgmpa_register', 'alx_plugins' );
//============================================
// Widget Settings                     
//============================================

function rms_widgets_init() 
{
        rmsRegisterWidgetAreas(array(
		'sidebar-1'      => array('name' => __('Primary Sidebar', 'rms')),
		'sidebar-3'   => array('name' => __('Footer Widget Area', 'rms')),
		'sidebar-5'   => array('name' => __('Why People Love Us', 'rms')),
		'sidebar-8'   => array('name' => __('Reorder Main Sidebar', 'rms')),
		'sidebar-9'   => array('name' => __('Reorder Blog Sidebar', 'rms')),
		'sidebar-10'   => array('name' => __('Footer Sidebar One', 'rms')),
		'sidebar-11'   => array('name' => __('Footer Sidebar Two', 'rms')),
		'sidebar-12'   => array('name' => __('Footer Sidebar Three', 'rms')),
		'sidebar-13'   => array('name' => __('Footer Sidebar Four', 'rms')),
		'sidebar-15'   => array('name' => __('Contact Person', 'rms')),
		'sidebar-16'   => array('name' => __('Currency Switcher', 'rms')),
		'footer-widgets' => array(
			'name' => __('Footer Widget Area', 'rms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h1 class="widget-title"><span>',
			'after_title' => '</span></h1>',
		),
	), 
	array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="uppercase">',
		'after_title'   => '</h4>',
	));
	
}
add_action( 'widgets_init', 'rms_widgets_init' );

//=======================================
// Set View Counter
//=======================================
function RMSPostViews($postID) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
    {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    else
    {
        $count += 1;
        update_post_meta($postID, $count_key, $count);
    }
}

//============================================
// Action After Theme Setup
//============================================

function rms_themeSetup()
{
	add_theme_support('woocommerce');
    add_editor_style( array( 'css/editor-style.css', rms_font_url() ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size( 1090, 820, true );
    add_image_size('monial-thumb', 53, 53, true);
    add_image_size('front-post-thumb', 290, 190, true);
    add_image_size('front-product-thumb', 180, 140, true);
    add_image_size('blog-thumb', 1090, 820, TRUE);
    add_image_size('portfolio', 240, 200, true);
    add_image_size('portfolio_square', 340, 340, TRUE);
    add_image_size('product_related', 360, 260, TRUE);
    add_image_size('product_single', 375, 506, TRUE);
    add_image_size('product_single_thumb', 119, 162, TRUE);
    add_theme_support( 'title-tag' );
    
    register_nav_menu('primary-menu', __('Primary Menu', 'rms-admin'));
    register_nav_menu('footer-menu', __('Footer Menu', 'rms-admin'));
    
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', ) );
    
    add_theme_support( 'post-formats', array('image', 'video', 'audio' ));
}

add_action('after_setup_theme', 'rms_themeSetup');

//=========================================
// SET Content Width
//=========================================

if(!isset($content_width)) {
    $content_width = 800;
}

//=========================================
// Custome Post Class
//=========================================
function rms_post_classes( $classes ) 
{
    if ( ! post_password_required() && has_post_thumbnail() ) 
    {
        $classes[] = 'has-post-thumbnail';
    }
    return $classes;
}
add_filter( 'post_class', 'rms_post_classes' );

//=================================================
// Enable Page excerpt
//=================================================

add_action('init', 'enable_page_excerpt');
function enable_page_excerpt() 
{
	add_post_type_support( 'page', 'excerpt' );
}

//====================
// Plugin Activity
//====================
function rms_is_plugin_active( $plugin ) 
{
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}




//======================================
// Preset Area 
//======================================

function preset_import()
{
    $sess = $_SESSION['preset_version'];
    wp_enqueue_style( 'preset_version', get_template_directory_uri().'/RMS/Framework/assets/preset/'.$sess.'.css');
}
if(isset($_GET['preset']) && $_GET['preset'] != '')
{
    unset($_SESSION['preset_version']);
    $_SESSION['preset_version'] = $_GET['preset'];
}
if(isset($_SESSION['preset_version']) && $_SESSION['preset_version'] != '')
{
    if($_SESSION['preset_version'] != '')
    {
        add_action( 'wp_enqueue_scripts', 'preset_import' );
    }
}

function rms_preset_create_by_admin()
{
    wp_enqueue_style( 'preset_default', get_template_directory_uri().'/RMS/Framework/assets/preset/preset.css');
    wp_enqueue_style( 'layout_default', get_template_directory_uri().'/RMS/Framework/assets/preset/layout.css');
}
add_action( 'wp_enqueue_scripts', 'rms_preset_create_by_admin' );



function rms_preset_layout()
{
    $sess = $_SESSION['preset_layout'];
    wp_enqueue_style( 'preset_layout', get_template_directory_uri().'/RMS/Framework/assets/preset/'.$sess.'.css');
}


if(isset($_GET['layout']) && $_GET['layout'] != '')
{
    unset($_SESSION['preset_layout']);
    $_SESSION['preset_layout'] = $_GET['layout'];

}
if(isset($_SESSION['preset_layout']) && $_SESSION['preset_layout'] != '')
{
    if($_SESSION['preset_layout'] != '')
    {
        add_action( 'wp_enqueue_scripts', 'rms_preset_layout' );
    }
}

//====================================
// Parallax Background Image
//====================================

if (class_exists('MoreThumb')) {
    new MoreThumb(
        array(
            'label' => 'Parallax Background',
            'id' => 'parallax-image',
            'post_type' => 'page',
            'priority' => 'low',
        )
    );
}

//====================================
// Client Image
//====================================

if (class_exists('MoreThumb')) {
    new MoreThumb(
        array(
            'label' => 'Colored Image',
            'id' => 'colored-image',
            'post_type' => 'client',
            'priority' => 'low',
        )
    );
}


//=====================================
// Script for Sicky Menu
//=====================================
function rms_inner_scripts() {
        wp_enqueue_script( 'rms-inner', get_template_directory_uri().'/RMS/Framework/assets/js/inner_page_script.js', array('theme-js'), '1.0.0', true  );
}

function rms_front_scripts() {
        wp_enqueue_script( 'rms-front', get_template_directory_uri().'/RMS/Framework/assets/js/front_page_script.js', array('theme-js'), '1.0.0', true  );
}


add_action( 'wp', 'script_check_loadin' );
function script_check_loadin()
{
    if(is_front_page() || is_home())
    {
        add_action( 'wp_enqueue_scripts', 'rms_front_scripts' );
    }
    else
    {
        add_action( 'wp_enqueue_scripts', 'rms_inner_scripts' );
    } 
}

//========================================
// Woocommerce Scripts
//========================================
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
global $woocommerce;
ob_start();
?>
<a class="cart-contents login" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
    <span class="h_subtotal">
    <?php echo $woocommerce->cart->get_cart_total(); ?>
    </span>
    <span class="cart_item_h">
    <i class="fa fa-shopping-cart"></i>
    <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
    </span>
<?php

$fragments['a.cart-contents'] = ob_get_clean();

return $fragments;

}

add_action('init', 'rms_page_excerpt_init');
function rms_page_excerpt_init() {
	add_post_type_support( 'page', 'excerpt' );
}

// Pagination //
function pagination($pages = '', $range = 1)
{ 
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"blog-pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'> <i class='fa fa-angle-left'></i></a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a class=\"cur-page\">".$i."</a>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"><i class='fa fa-angle-right'></i></a>";
         echo "</div>\n";
     }
}
// inner page script //

function uncle_inner_scripts() {
        wp_enqueue_script( 'uncle-inner', get_template_directory_uri().'/RMS/Framework/assets/js/inner.js', array('menus-js'), '', true  );
}

function uncle_front_scripts() {
        wp_enqueue_script( 'uncle-front', get_template_directory_uri().'/RMS/Framework/assets/js/main.js', array('menus-js'), '', true  );
}


add_action( 'wp', 'script_check_loading' );
function script_check_loading()
{
    if(is_front_page() || is_home())
    {
        add_action( 'wp_enqueue_scripts', 'uncle_front_scripts' );
    }
    else
    {
        add_action( 'wp_enqueue_scripts', 'uncle_inner_scripts' );
    } 
}