<?php
/**
 * RMS WordPress Framework
 *
 * Copyright (c) 2014, ThemeOnLab,(http://themeonlab.com)
 */

//===================================
// Generate Custom Post type
//===================================
if(isset($custom_post_type) && !empty($custom_post_type))
{
    foreach($custom_post_type as $key => $val)
    {
        $cup_name = $key;
        $position = $val;
        global $position;
        require RMS_FRAMEWORK_DIR.'/custom_post_type/'.$cup_name.'/'.$cup_name.'.php';
        unset($position);
    }
}

//===================================
// Admin Hook Variable
//===================================
function rms_custom_admin_head()
{
?>
<script type="text/javascript"> var url = '<?php get_template_directory_uri(); ?>';</script>
<?php
}
add_action('admin_head', 'rms_custom_admin_head');

//===================================
// Generate Widget
//===================================

if(isset($aitThemeWidgets) && !empty($aitThemeWidgets))
{
    foreach($aitThemeWidgets as $widget)
    {
        require RMS_FRAMEWORK_DIR.'/widget/rms_'.$widget.'_widget.php';
    }
}

//======================================
// Load Widgets Areas
//======================================

function rmsRegisterWidgetAreas($areas, $defaultParams = array())
{
	if(empty($defaultParams)){
		$defaultParams = array(
			'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
			'after_widget' => "</div></div>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		);
	}

	foreach($areas as $id => $area){
		$params = array_merge($defaultParams, $area, array('id' => $id));
		register_sidebar($params);
	}
}

//======================================
// Activate Shortcode
//======================================

if(isset($rmsThemePageShortcode) && !empty($rmsThemePageShortcode))
{
    foreach($rmsThemePageShortcode as $short)
    {
        require RMS_FRAMEWORK_DIR.'/shortcodes/'.$short.'/load.php';
    }
}

//======================================
// Register Shortcode Buttons In TinyMce
//======================================

function register_button( $buttons ) {
   global $rmsThemePageShortcode;
   if(isset($rmsThemePageShortcode) && !empty($rmsThemePageShortcode))
   {
       foreach ($rmsThemePageShortcode as $shortcode)
       {
           array_push( $buttons, "|", $shortcode );
       }
   }
   return $buttons;
}

function add_plugin( $plugin_array ) {
   global $rmsThemePageShortcode;
   if(isset($rmsThemePageShortcode) && !empty($rmsThemePageShortcode))
   {
       foreach ($rmsThemePageShortcode as $shortcode)
       {
           $plugin_array[$shortcode] = RMS_FRAMEWORK_URL.'/shortcodes/'.$shortcode.'/rms-'.$shortcode.'.js';
       }
   }
   return $plugin_array;
}

function my_recent_posts_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
add_action('init', 'my_recent_posts_button');

//===============================================
// Load Some Extras
//===============================================
require RMS_FRAMEWORK_DIR.'/extras/extra_load.php';

//==============================================
// Make Widget Availabel In Shortcode
//==============================================
add_filter('widget_text', 'do_shortcode');






add_action( 'init','rms_rewrite_rules' );
function rms_rewrite_rules() {
	$ver = filemtime( __FILE__ );
	$defaults = array( 'version' => 0, 'time' => time() );
	$r = wp_parse_args( get_option( __CLASS__ . '_flush', array() ), $defaults );
        if ( $r['version'] != $ver || $r['time'] + 172800 < time() ) { 
		flush_rewrite_rules();
		$args = array( 'version' => $ver, 'time' => time() );
		if ( ! update_option( __CLASS__ . '_flush', $args ) )
                {
                    add_option( __CLASS__ . '_flush', $args );
                }
	}
}

//=========================================
//Default Style Initialize
//=========================================
function rms_font_url() 
{
	$font_url = '';
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'rms' ) ) 
        {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}
        return $font_url;
}


function enqueue_all_default_style()
{
    wp_enqueue_style( 'rms-ie', get_template_directory_uri() . '/css/ie.css', array( 'rms-style', 'genericons' ), '20131205' );
    wp_style_add_data( 'rms-ie', 'conditional', 'lt IE 9' );
    wp_enqueue_style('loader-css', get_template_directory_uri().'/RMS/Framework/assets/css/loader.css');
    wp_enqueue_style('essentials-css', get_template_directory_uri().'/RMS/Framework/assets/css/lib/essentials.css');
    wp_enqueue_style('awesome-css', get_template_directory_uri().'/RMS/Framework/assets/css/lib/font-awesome.min.css');
    wp_enqueue_style('bxslider-css', get_template_directory_uri().'/RMS/Framework/assets/css/lib/jquery.bxslider.css');
    wp_enqueue_style('magnific-css', get_template_directory_uri().'/RMS/Framework/assets/css/lib/magnific-popup.css');
    wp_enqueue_style('uncle-css', get_template_directory_uri().'/RMS/Framework/assets/css/uncle.css');
    wp_enqueue_style('preset-css', get_template_directory_uri().'/RMS/Framework/assets/css/theme.css');
	
    wp_enqueue_style('custom-css', get_template_directory_uri().'/RMS/Framework/assets/css/selfCreated/custom.css');
    wp_enqueue_style('typography-css', get_template_directory_uri().'/RMS/Framework/assets/css/selfCreated/typography.css');
}
add_action('wp_enqueue_scripts', 'enqueue_all_default_style');
//=========================================
// Enqueue all Default JS
//=========================================
function enqueue_all_default_script()
{
	wp_enqueue_script('map-plugin', 'http://maps.googleapis.com/maps/api/js', array( 'jquery' ), '20131209', true);
	wp_enqueue_script('navs-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.nav.js', array( 'map-plugin' ), '', true );
	wp_enqueue_script('preset-js', get_template_directory_uri().'/RMS/Framework/assets/js/preset.js', array( 'navs-js' ), '', true );
    wp_enqueue_script('magnific-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.magnific-popup.min.js', array( 'preset-js' ), '23222', true );
    wp_enqueue_script('bxslider-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.bxslider.min.js', array('magnific-js'), '', TRUE);
    wp_enqueue_script('count-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/count.js', array('bxslider-js'), '', TRUE);
    wp_enqueue_script('appear-code', get_template_directory_uri().'/RMS/Framework/assets/js/lib/appear.js', array('count-js'), '', TRUE);
	wp_enqueue_script('equal-code', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.equal.js', array('appear-code'), '', TRUE);
    wp_enqueue_script('isotope-photo', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.isotope.js', array('equal-code'), '', TRUE);
    wp_enqueue_script('superslides', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.superslides.min.js', array('isotope-photo'), '', TRUE);
    wp_enqueue_script('touchswipe', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.touchswipe.min.js', array('superslides'), '', TRUE);
    wp_enqueue_script('caroufredsel-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.caroufredsel.min.js', array('touchswipe'), '', TRUE);
    wp_enqueue_script('baslider-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.baslider.js', array('caroufredsel-js'), '', TRUE);
	wp_enqueue_script('scroll-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.nicescroll.min.js', array('baslider-js'), '', TRUE);
	wp_enqueue_script('menus-js', get_template_directory_uri().'/RMS/Framework/assets/js/lib/jquery.dropotron.min.js', array('scroll-js'), '', TRUE);
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
    }
    
}
add_action('wp_enqueue_scripts', 'enqueue_all_default_script');

// //
function popular_post_tab()
{
    
    $pop = array(
        'post_type'         => array('post'),
        'meta_key'          => 'wpb_post_views_count',
        'orderby'           => 'meta_value_num',
        'order'             => 'DESC',
        'posts_per_page'    => 3
    );
    
    $popular_post = new WP_Query($pop);
    if($popular_post->have_posts())
    {
        $popular = '';
        while($popular_post->have_posts())
        {
            $popular_post->the_post();
            if(has_post_thumbnail( get_the_ID() ))
            {
                $team_thumb = get_the_post_thumbnail(get_the_ID(), 'monial-thumb');
            }
            else
            {
                $team_thumb = '<img src="http://placehold.it/53x53" alt="Reorder">';
            }
            $popular .= '<div class="tab-pane-item">
                '.$team_thumb.'
                <p><a href="'.  get_permalink().'">'.  substr(get_the_title(), 0, 20).'..</a></p>
                <span class="date">'.  get_the_author().'</span>
            </div>';
        }
        
    }
    return $popular;
}

function recent_post_tab()
{
    $pop = array(
        'post_type'         => array('post'),
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 3
    );
    
    $popular_post = new WP_Query($pop);
    if($popular_post->have_posts())
    {
        $popular = '';
        while($popular_post->have_posts())
        {
            $popular_post->the_post();
            if(has_post_thumbnail( get_the_ID() ))
            {
                $team_thumb = get_the_post_thumbnail(get_the_ID(), 'monial-thumb');
            }
            else
            {
                $team_thumb = '<img src="http://placehold.it/53x53" alt="Reorder">';
            }
            $popular .= '<div class="tab-pane-item">
                '.$team_thumb.'
                <p><a href="'.get_permalink().'">'.  substr(get_the_title(), 0, 20).'..</a></p>
                <span class="date">'.  get_the_author().'</span>
            </div>';
        }
        
    }
    return $popular;
}

add_shortcode('popular_post_for_tab', 'popular_post_tab');
add_shortcode('recent_post_for_tab', 'recent_post_tab');
