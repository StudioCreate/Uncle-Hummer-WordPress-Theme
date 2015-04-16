<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

get_header(); ?>

<section id="four_0_four">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="_404">
                    <div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'reorder' ); ?></h1>
                                
			</header>

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'reorder' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->
                </div>
            </div>
        </div>
    </div>
	
</section>
<?php

get_footer();
