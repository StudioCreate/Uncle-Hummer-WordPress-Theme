<?php
/**
 * The Template for displaying all single posts
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
				<?php
					$singlesidePos = get_option('singlePostPageTemplate', FALSE);
				?>
				<?php while ( have_posts() ) : the_post(); ?>
				<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo do_shortcode(get_the_title()); ?></h5>
				<?php endwhile; // end of the loop. ?>
                <hr/>
            </div>
		</div>
	</section>
    <!-- Blog -->
	<?php if($singlesidePos == 'noSidebar'): ?>
	<section class="page-content">
		<div class="row">
			<!-- Begin Posts -->
			<div class="twelve columns">
				<!-- search widget -->
				<div class="widget clearfix">
					<form action="#" class="searh-holder" action="<?php esc_url( home_url( '/' ) ); ?>">
						<input name="search" id="se" type="text" class="search" placeholder="Search.." value="<?php echo get_search_query(); ?>" />
						<button class="search-submit" id="submit_btn" value="<?php esc_attr_x( 'Search', 'submit button' ); ?>"><i class="fa fa-search transition"></i> </button>
					</form>
				</div>
				<div class="post">
					<?php if(function_exists('RMSPostViews')): RMSPostViews(get_the_ID()); endif;?>  
					
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						endwhile;
					?>
				</div>
            </div>
        </div>
	</section>
	<?php elseif($singlesidePos == 'rightSidebar'): ?>
	<section class="page-content">
		<div class="row">
			<!-- Begin Posts -->
			<div class="eight columns">
				<div class="post">
					<?php if(function_exists('RMSPostViews')): RMSPostViews(get_the_ID()); endif;?>  
					
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						endwhile;
					?>
				</div>
            </div>
			<!-- Begin Sidebar -->
			<div class="three columns">
				<div class="sidebar">
					<?php dynamic_sidebar('Primary Sidebar'); ?>
				</div>
			</div>
			<!-- End Sidebar -->
        </div>
	</section>
	<?php elseif($singlesidePos == 'leftSidebar'): ?>
	<section class="page-content">
		<div class="row">
			<!-- Begin Sidebar -->
			<div class="three columns">
				<div class="sidebar">
					<?php dynamic_sidebar('Primary Sidebar'); ?>
				</div>
			</div>
			<!-- End Sidebar -->
			<!-- Begin Posts -->
			<div class="eight columns">
				<div class="post">
					<?php if(function_exists('RMSPostViews')): RMSPostViews(get_the_ID()); endif;?>  
					
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						endwhile;
					?>
				</div>
            </div>
        </div>
	</section>
	<?php endif; ?>
	<section id="page-comments" class="page-comments">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
	?>
	</section>

</div><!-- #main-content -->

<?php
get_footer();