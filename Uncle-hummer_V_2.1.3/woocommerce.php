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
<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
    <h5><?php echo do_shortcode(get_the_title()); ?></h5>
<?php endwhile; // end of the loop. ?>
</div>
<?php woocommerce_content(); ?>
<?php

get_footer();
