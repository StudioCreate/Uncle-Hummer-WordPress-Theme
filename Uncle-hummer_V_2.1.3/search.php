<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

get_header(); ?>
<div id="main-content" class="main-content">
    <?php if ( have_posts() ) : ?>
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
				<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Search Results for: %s', 'uncle' ), get_search_query() ); ?></h5>
                <hr/>
            </div>
		</div>
	</section>
	<section class="page-content">
		<div class="row">
			<!-- Begin Posts -->
			<div class="twelve columns">
				<div class="post">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', 'search', get_post_format() );
						endwhile;
							pagination($wp_query->max_num_pages);
						else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );
						endif;
					?>
				</div>
            </div>
        </div>
	</section>
</div><!-- #main-content -->
<?php
get_footer();
