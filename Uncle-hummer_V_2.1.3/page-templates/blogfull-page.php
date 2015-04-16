<?php
/**
 * Template Name: Blog No Sidebar Page
 *
 * @package Uncle Hummer
 * @subpackage Uncle Hummer
 * @since Uncle Hummer 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
    
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
				<?php
					$blogpagetitle = get_option('blogpagetitle', FALSE);
					$sidebarPosition = get_option('sidebarPosition', FALSE);
					if($blogpagetitle != ''):
				?>
				<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo $blogpagetitle ; ?></h5>
				<?php endif; ?>
                <hr/>
				<?php while ( have_posts() ) : the_post(); ?>
				<p class="big"><?php echo do_shortcode(get_the_content()); ?></p>
				<?php endwhile; // end of the loop. ?>
            </div>
		</div>
        <section class="page-content search-area">
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
				</div>
			</div>
		</section>
		<?php
		$ppp = get_option('posts_per_page', FALSE);
		$posts = array(
			'post_type'         => array('post'),
			'posts_per_page'    => $ppp,
			'post_status'       => array('publish'),
			'orderby'           => 'date',
			'order'             => 'DESC',
			'paged'             => get_query_var('paged') ? get_query_var('paged') : '1' 
		);
		query_posts($posts);
		if(have_posts())
		{
			while(have_posts())
			{
				the_post();
				$tags = wp_get_post_tags(get_the_ID());
				$tag = '';
				foreach($tags as $t)
				{
					$tag .= $t->name.', ';
				}
		?>
    <!-- Blog -->
	<section class="blog page-content">
		<div class="row">
			<!-- Begin Posts -->
			<div class="twelve columns">
							<?php
							if ( has_post_format( 'audio' ))
							{
							?>
							<div class="post">
                                
								<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
								<div class="post-media">
									<?php echo get_post_meta($post->ID, "audio", true); ?>
								</div>
								<div class="post-title">
									<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
									<div class="post-details">
										<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
										<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
										<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a> </span>
									</div>
								</div>				
									
								<div class="post-body">
									<p><?php echo substr(get_the_content(), 0, 2000);?></p>
									<div>
										<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
									</div>
								</div>
                            </div>
							<?php
							}
							elseif ( has_post_format( 'gallery' ))
							{
							?>
							<div class="post">
								<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
								<div class="post-media">
								
										<div class="single-media blog-single" >
											<ul class="slides" id="blog-single">
												<li><a href="#"><img src="images/bg/03.jpg" alt=""></a></li>
												<li><a href="#"><img src="images/bg/01.jpg" alt=""></a></li>
												<li><a href="#"><img src="images/bg/02.jpg" alt=""></a></li>
											</ul>
										  </div>	
								</div>
								<div class="post-title">
									<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
									<div class="post-details">
										<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
										<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
										<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a> </span>
									</div>
								</div>		
								<div class="post-body">
									<p><?php echo substr(get_the_content(), 0, 2000);?></p>
									<div>
										<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
									</div>
								</div>
							</div>
							<?php
							}
							elseif ( has_post_format( 'video' ))
							{
							?>
							<div class="post">
								<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
								<div class="post-media">
									<?php echo get_post_meta($post->ID, "video", true); ?>
								</div>
								<div class="post-title">
									<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
									<div class="post-details">
										<span><i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a></span> 
										<span><i class="fa fa-list-ul"></i><a href="#"><?php the_category(' '); ?></a></span>
										<span><i class="fa fa-comments"></i><a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
									</div>
								</div>				
									
								<div class="post-body">
									<p><?php echo substr(get_the_content(), 0, 2000);?></p>
									<div>
										<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
									</div>
								</div>
							</div>
							<?php
							}
							elseif ( has_post_format( 'image' ))
							{
							?>
							<div class="post">
								<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
								<div class="post-media">
									<a href="#">
										<?php
											if(has_post_thumbnail()) {
												echo get_the_post_thumbnail(get_the_ID());
											} else { 
												echo '<img src="http://placehold.it/1090x817" alt="Uncle"/>';
											} 
										?>
									</a>
								</div>
								<div class="post-title">
									<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
									<div class="post-details">
										<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
										<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
										<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a> </span>
									</div>
								</div>		
								<div class="post-body">
									<p><?php echo substr(get_the_content(), 0, 2000);?></p>
									<div>
										<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
									</div>
								</div>
                            </div>
							<?php
							}
							else
							{
							?>
							<div class="post">
								<span class="date"><?php echo get_the_date('j'); ?><br><small><?php echo get_the_time('M'); ?></small></span>
								<div class="post-title">
									<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
									<div class="post-details">
										<span> <i class="fa fa-user"></i> Posted by <a href="#"><?php echo get_the_author();?></a> </span> 
										<span> <i class="fa fa-list-ul"></i> <a href="#"><?php the_category(' '); ?></a> </span>
										<span> <i class="fa fa-comments"></i> <a href="#"><?php comments_number( '0', '1', '%' ); ?> Comments</a> </span>
									</div>
								</div>		
								<div class="post-body">
									<p><?php echo substr(get_the_content(), 0, 2000);?></p>
									<div>
										<a href="<?php echo get_permalink();?>" class="arrow-link-dark text-dark">Read more</a>
									</div>
								</div>
                            </div>
							<?php
							}
							?>
            </div>
        </div>
	</section>
	<?php
	}
	?>
	<section id="blog-nav" class="blog-nav">
        
		<div class="row">

			<!-- Begin Posts -->
			<div class="twelve columns centerdiv">
		
			<?php 
				if (function_exists("pagination")) {
					pagination($wp_query->max_num_pages);
				} 
			?>			
	
			</div>
			
        </div>
		
    </section>
		<?php
		}
		else
		{
			get_template_part('content', 'none');
		}

		wp_reset_query();
		?>
</section>
</div><!-- #main-content -->

<?php
get_footer();
