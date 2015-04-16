<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'reorder' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'reorder' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>
	<h2><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'reorder' ); ?></h2>
	<h2 class="discover">
		Go <a href="<?php echo home_url();?>" class="link"><b>Home</b></a>
	</h2>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'reorder' ); ?></p>
	<div class="discover">
		Go <a href="<?php echo home_url();?>" class="link"><b>Home</b></a>
	</div>

	<?php endif; ?>
</div><!-- .page-content -->
