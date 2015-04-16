<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>
<?php
if ( has_post_format( 'image' ))
{
?>
	<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
	<div class="post-media">
			<?php
				if(has_post_thumbnail()) {
					echo get_the_post_thumbnail(get_the_ID());
				} else { 
					echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
				} 
			?>
	</div>
<?php
}
elseif ( has_post_format( 'audio' ))
{
?>
	<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
	<div class="post-media">
		<?php echo get_post_meta($post->ID, "audio", true); ?>
	</div>
<?php
}
elseif ( has_post_format( 'video' ))
{
?>	
	<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
	<div class="post-media">
		<?php echo get_post_meta($post->ID, "video", true); ?>
	</div>
<?php
}
else
{
?>	
	<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
<?php
}
?>	
<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
	<div class="post-details">
		<h2><?php echo get_the_title();?></h2>
		<div class="post-details">
			<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
			<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
			<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a> </span>
		</div>
	</div>		
	<div class="post-body">
		<p>
		<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) ); ?>
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
