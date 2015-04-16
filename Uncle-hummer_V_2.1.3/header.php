<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
        <?php
            $stime = get_option('starttimestamp', false);
            $etime = get_option('endtimestamp', false);
            
            if($stime != '') { $st = $stime; } else { $st = '1408014308'; }
            if($etime != '') { $et = $etime; } else { $et = '1439550308'; }
        ?>
        <script type="text/javascript">
            var theme_url = '<?php get_template_directory_uri(); ?>';
            var home_url = '<?php home_url( '/' );?>';
            var nav_url = '<?php echo home_url( '/' );?>';
            var blog_url = '<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>';
            var starttime = '<?php echo $st; ?>';
            var endtime = '<?php echo $et; ?>'
        </script>
        <?php
        $facicon = get_option('favicon_url', FALSE);
        if($facicon != ''){
        ?>
        <link rel="shortcut icon" href="<?php echo $facicon; ?>">
        <?php } else { ?>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/RMS/Framework/assets/images/favicon.png">
        <?php } ?>
    
    
    <?php wp_head(); ?>
</head>

<body data-spy="scroll" data-target=".rms-it" <?php body_class(); ?>>
<?php 
echo $h4FontSize;
add_theme_support( 'custom-header', array(
    // Header image default
    'default-image'         => get_template_directory_uri() . '/RMS/Framework/assets/images/logo.png'
) );
add_theme_support( 'custom-background', array(
	// Background color default
	'default-color' => '000',
	// Background image default
	'default-image' => get_template_directory_uri() . '/images/background.jpg'
) );
?>
	<!-- Preloader -->
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
	<!-- Menu -->
	<?php
		$logo = get_option('logo_url', FALSE);
		$logoText = get_option('logo_text', FALSE);
		$lohoheight = get_option('lohoheight', FALSE);
		$logowidth = get_option('logowidth', false);
		$logopadding = get_option('logopadding', FALSE);
		$logomargin = get_option('logomargin', FALSE);
		if($logowidth != ''){$lwidth = $logowidth;}else{$lwidth = '60';}
		if($lohoheight != ''){$lheight = $lohoheight;} else {$lheight = '60';}
	?>
	<div class="main-menu fixedmenu">
		<div class="menu-wrap">
			<!-- Your symbolic or typographic logo -->
			<a href="<?php echo home_url(); ?>">
				<?php if($logo != '') { ?>
					<img src="<?php echo $logo; ?>" alt="logo color" style="width:<?php echo $lwidth; ?>; height:<?php echo $lheight; ?>; max-height:<?php echo $lheight; ?>; padding:<?php echo $logopadding; ?>; margin:<?php echo $logomargin; ?>" class="menu-logo">
				<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/RMS/Framework/assets/images/logo.png" alt="logo color" style="width:<?php echo $lwidth; ?>; height:<?php echo $lheight; ?>" class="menu-logo">
				<?php } ?>
			</a>
            <h1><a href="<?php echo home_url( '/' ); ?>"><?php echo $logoText; ?></a></h1>
			<!---->
			<!-- The menu toggle -->
			<input type="checkbox" id="toggle" />
			<label for="toggle" class="toggle"></label>

			<?php do_action('icl_language_selector'); ?>
			<!-- The menu items -->
            <nav id="nav" class="menu rmsit_mein-menu">
				<?php             
					wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'rms-it' ) );
				?>
				<div id="nav-lang" class="nav-lang">
					<?php dynamic_sidebar('Currency Switcher'); ?>
					<ul class="language">
						<li> <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/en.png" alt=""/>English</a>
							<ul>
								<li> <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/fr.png" alt=""/>French</a></li>
								<li> <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/fr.png" alt=""/>Chinese</a></li>
							</ul>
						</li>
						
					</ul>
				</div>
            </nav>
		</div>
	</div>
	<div class="clear"></div>
	<!-- Fullscreen content and background slider / fader -->
		<?php 
            $slider = get_option('slidersettings', FALSE);
            if($slider != '' && is_front_page()) 
            { 
        ?>
		<div id="home" class="home-wrap">
            <section id="main-slider">
				<h2 class="empty">RMS</h2>
                <?php echo do_shortcode($slider); ?>
            </section><!--/#main-slider-->
		</div>
        <?php 
            } 
        ?>
	<div style="clear:both;"></div>
