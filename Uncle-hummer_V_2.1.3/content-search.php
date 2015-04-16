<?php
/**
 * The template used for displaying page content
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>

<div class="post">
	<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
	<div class="post-title">
		<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
		<div class="post-details">
			<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
			<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
			<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?></a> </span>
		</div>
	</div>		
	<div class="post-body">
		<p><?php echo substr(get_the_content(), 0, 2000);?></p>
		<div>
			<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
		</div>
	</div>
</div>
