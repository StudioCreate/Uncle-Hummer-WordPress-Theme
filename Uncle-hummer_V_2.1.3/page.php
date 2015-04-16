<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
				<?php while ( have_posts() ) : the_post(); ?>
				<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo do_shortcode(get_the_title()); ?></h5>
				<?php endwhile; // end of the loop. ?>
                <hr/>
            </div>
		</div>
	</section>
	<section class="page-content">
		<div class="row">
			<!-- Begin Posts -->
			<div class="twelve columns">
				<div class="post">
					<div class="post-body">
						<p>
						<?php echo do_shortcode(get_the_content()); ?>
						</p>
						<?php
							$h = get_option('footerHeadin', FALSE);
							$a = get_option('footer_address', FALSE);
							$s = get_option('footerSocial', FALSE);
							$c = get_option('footerCopy', FALSE);
							$fm = get_option('footermenu', FALSE);
						?>
						<?php if($s == 'yes') : ?>
						<div class="aligncenter">
							Share:&nbsp;&nbsp;
							<?php if(get_option('googlePlus', FALSE) != ''): ?>
							<a href="<?php echo get_option('googlePlus', FALSE); ?>"><i class="fa fa-google-plus icon outline light"></i></a>
							<?php endif;?>
							<?php if(get_option('skype', FALSE) != ''): ?>
							<a href="<?php echo get_option('skype', FALSE); ?>"><i class="fa fa-skype icon outline light"></i></a>
							<?php endif;?>
							<?php if(get_option('youtube', FALSE) != ''): ?>
							<a href="<?php echo get_option('youtube', FALSE); ?>"><i class="fa fa-youtube icon outline light"></i></a>   
							<?php endif;?>
							<?php if(get_option('twitter', FALSE) != ''): ?>
							<a href="<?php echo get_option('twitter', FALSE); ?>"><i class="fa fa-twitter icon outline light"></i></a>
							<?php endif;?>
							<?php if(get_option('facebook', FALSE) != ''): ?>
							<a href="<?php echo get_option('facebook', FALSE); ?>"><i class="fa fa-facebook icon outline light"></i></a>
							<?php endif;?>
							<?php if(get_option('linkedin', FALSE) != ''): ?>
							<a href="<?php echo get_option('linkedin', FALSE); ?>"><i class="fa fa-linkedin icon outline light"></i></a>
							<?php endif;?>
						</div>
						<?php endif;?>
					</div>
				</div>
            </div>
        </div>
	</section>
</div><!-- #main-content -->

<?php

get_footer();
