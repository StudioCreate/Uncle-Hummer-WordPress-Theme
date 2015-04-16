<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


	<div class="row">
	<div id="comments-container">
		<div class="twelve columns">
		<?php if ( have_comments() ) : ?>
		<h2 class="text-white uppercase">Comments <span class="text-color">[<?php echo get_comments_number(); ?>]</span></h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'reorder' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'reorder' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'reorder' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ul class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'author' => true,
				'avatar_size'=> 50,
				'author_email' => true,
			) );
		?>
	</ul><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'reorder' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'reorder' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'reorder' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'reorder' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>
	<h2 class="own_comment_title text-white uppercase">Leave a comment</h2>
    <hr>
	<?php comment_form(); ?>
