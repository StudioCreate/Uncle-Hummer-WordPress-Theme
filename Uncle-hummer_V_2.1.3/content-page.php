<?php
/**
 * The template used for displaying page content
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		echo '<div class="rms_singl_page_img">';
                    echo get_the_post_thumbnail(get_the_ID());
                echo '</div>';
		the_title( '<header class="entry-header"><h1 class="common_heading text-left">', '</h1></header><!-- .entry-header -->' );
	?>

	<div class="entry-content">
		<?php
			the_content();
			

			edit_post_link( __( 'Edit', 'reorder' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
