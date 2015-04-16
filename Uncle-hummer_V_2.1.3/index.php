<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content saikat">
    <?php
		$blogsidePos = get_option('sidebarPosition', FALSE);
	?>
	<?php if($blogsidePos == 'rightSidebar'): ?>
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
			<?php
					if (is_front_page())
					{?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Welcome to ' ,'uncle')); ?><?php bloginfo('name'); ?></h5>
					<?php } else { ?>
					<?php
					$blogpagetitle = get_option('blogpagetitle', FALSE);
					$sidebarPosition = get_option('sidebarPosition', FALSE);
					if($blogpagetitle != ''):
					?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo $blogpagetitle ; ?></h5>
					<?php endif; ?>
					<?php } ?>
                <hr/>
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
		<!-- Blog -->
		<section class="blog page-content">
			<div class="row">
				<!-- Begin Posts -->
				<div class="nine columns">
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
											<span><i class="fa fa-comments"></i><a href="#"><?php comments_number( '0', '1', '%' ); ?></a></span>
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
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
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
								<?php
								}
								?>
								<?php
								}
								?>
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
	<?php elseif($blogsidePos == 'leftSidebar'): ?>
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
			<?php
					if (is_front_page())
					{?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Welcome to ' ,'volta')); ?><?php bloginfo('name'); ?></h5>
					<?php } else { ?>
					<?php
					$blogpagetitle = get_option('blogpagetitle', FALSE);
					$sidebarPosition = get_option('sidebarPosition', FALSE);
					if($blogpagetitle != ''):
					?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo $blogpagetitle ; ?></h5>
					<?php endif; ?>
					<?php } ?>
                <hr/>
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
		<!-- Blog -->
		<section class="blog page-content">
			<div class="row">
				<!-- Begin Sidebar -->
				<div class="three columns">
					<div class="sidebar">
						<?php dynamic_sidebar('Primary Sidebar'); ?>
					</div>
				</div>
				<!-- End Sidebar -->
				
				<!-- Begin Posts -->
				<div class="nine columns">
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
											<span><i class="fa fa-comments"></i><a href="#"><?php comments_number( '0', '1', '%' ); ?></a></span>
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
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
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
								<?php
								}
								?>
								<?php
								}
								?>
				</div>
			</div>
		</section>
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
	<?php elseif($blogsidePos == 'noSidebar'): ?>
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
			<?php
					if (is_front_page())
					{?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Welcome to ' ,'volta')); ?><?php bloginfo('name'); ?></h5>
					<?php } else { ?>
					<?php
					$blogpagetitle = get_option('blogpagetitle', FALSE);
					$sidebarPosition = get_option('sidebarPosition', FALSE);
					if($blogpagetitle != ''):
					?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo $blogpagetitle ; ?></h5>
					<?php endif; ?>
					<?php } ?>
                <hr/>
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
		<!-- Blog -->
		<section class="blog page-content">
			<div class="row">
				<!-- Begin Posts -->
				<div class="twelve columns">
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
											<span><i class="fa fa-comments"></i><a href="#"><?php comments_number( '0', '1', '%' ); ?></a></span>
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
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
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
								<?php
								}
								?>
								<?php
								}
								?>
				</div>
			</div>
		</section>
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
	<?php else: ?>
	<section class="page-header" id="page-header">
    
	<!-- Blog title text -->
		<div class="row">
			<div class="ten columns center">
			<?php
					if (is_front_page())
					{?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Welcome to ' ,'volta')); ?><?php bloginfo('name'); ?></h5>
					<?php } else { ?>
					<?php
					$blogpagetitle = get_option('blogpagetitle', FALSE);
					$sidebarPosition = get_option('sidebarPosition', FALSE);
					if($blogpagetitle != ''):
					?>
					<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php echo $blogpagetitle ; ?></h5>
					<?php endif; ?>
					<?php } ?>
                <hr/>
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
		<!-- Blog -->
		<section class="blog page-content">
			<div class="row">
				<!-- Begin Posts -->
				<div class="nine columns">
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
										<h2><a href="#"><?php echo get_the_title();?></a></h2>
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
											<span><i class="fa fa-comments"></i><a href="#"><?php comments_number( '0', '1', '%' ); ?></a></span>
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
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
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
								<?php
								}
								?>
								<?php
								}
								?>
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
	<?php endif; ?>
</div><!-- #main-content -->

<?php
get_footer();
