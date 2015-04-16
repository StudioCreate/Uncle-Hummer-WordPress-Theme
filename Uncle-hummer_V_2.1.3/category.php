<?php
/**
 * The template for displaying Category pages
 *
 * 
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
    <?php
        $blogpagetitle = get_option('blogpagetitle', FALSE);
        $sidebarPosition = get_option('sidebarPosition', FALSE);
        
    ?>
    <section class="reorderpagetitle paddinbbottom40">
        <div class="container">
			<section class="page-header no_seperator" id="page-header">
				<div class="row">
					<div class="col-lg-12">
						<h5 class="bigtext uppercase letterspace bold text-subtitle"><?php printf( __( 'Category : %s', 'reorder' ), single_cat_title( '', false ) ); ?></h5>
					</div>
				</div>
			</section>
        </div>
    </section>
    
    <section class="reorderblogsection">
        <div class="container page-content">
            <div class="row">
                <?php if($sidebarPosition == 'leftSidebar'): ?>
                <div class="col-xs-12 col-sm-4 col-lg-3 blog_sidebar">
                    <div class="reorder_search" style="padding-top: 26px !important; padding-bottom: 30px !important;">
                        <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) );?>">
                            <div>
                                    <input type="text" value="<?php echo get_search_query();?>" name="s" id="s" placeholder="<?php echo __( 'Search for Posts', 'woocommerce' );?>" />
                                    <input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' );?>" />
                                    <input type="hidden" name="post_type" value="post" />
                            </div>
                        </form><div class="clear"></div>
                     </div>
                    <?php echo dynamic_sidebar('sidebar-9'); ?>
                </div>
                <div class="col-xs-12 co-sm-8 col-lg-9">
                    <?php
                        
                        if(have_posts())
                        {
                            //$bltr .= '<div style="margin-top: 30px">';
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
                        
                            <div class="blog_post">
                                <?php
                                    // if(has_post_thumbnail()) {
                                        // echo get_the_post_thumbnail(get_the_ID(), 'blog-thumb');
                                    // } else { 
                                        // echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
                                    // } 
                                ?>
                                <h4 class="heading_4"><?php echo get_the_title();?></h4>
                                <p><?php echo substr(get_the_content(), 0, 346);?></p>
                                <div class="row ">
                                    <div class="col-lg-12 ">
                                        <div class="col-lg-10 blog_commenter"><span class="green">By <?php echo get_the_author();?></span> | <?php echo $tag; ?></div>
                                        <div class="col-lg-2 blog_commenter more_details"><a href="<?php echo get_permalink();?>">More Details &nbsp;<i class="fa fa-angle-right"></i></a></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                            ?>
                            <div class="reorder_pagination">
                                <?php echo rms_paging_nav(); ?>
                           </div>
                            <?php
                        }
                        else
                        {
                            get_template_part('content', 'none');
                        }

                        wp_reset_query();
                    ?>
                </div>
                <?php elseif($sidebarPosition == 'noSidebar'): ?>
                <div class="col-xs-12 co-sm-12 col-lg-12">
                    <?php
                        
                        if(have_posts())
                        {
                            //$bltr .= '<div style="margin-top: 30px">';
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
                        
                            <div class="blog_post">
                                <?php
                                    // if(has_post_thumbnail()) {
                                        // echo get_the_post_thumbnail(get_the_ID(), 'blog-thumb');
                                    // } else { 
                                        // echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
                                    // } 
                                ?>
                                <h4 class="heading_4"><?php echo get_the_title();?></h4>
                                <p><?php echo substr(get_the_content(), 0, 346);?></p>
                                <div class="row ">
                                    <div class="col-lg-12 ">
                                        <div class="col-lg-10 blog_commenter"><span class="green">By <?php echo get_the_author();?></span> | <?php echo $tag; ?></div>
                                        <div class="col-lg-2 blog_commenter more_details"><a href="<?php echo get_permalink();?>">More Details &nbsp;<i class="fa fa-angle-right"></i></a></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                            ?>
                            <div class="reorder_pagination">
                                <?php echo rms_paging_nav(); ?>
                           </div>
                            <?php
                        }
                        else
                        {
                            get_template_part('content', 'none');
                        }

                        wp_reset_query();
                    ?>
                </div>
                <?php else: ?>
            <div class="eight columns">
                    <?php
                       
                        if(have_posts())
                        {
                            //$bltr .= '<div style="margin-top: 30px">';
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
                            <div class="reorder_pagination">
                                <?php echo rms_paging_nav(); ?>
                           </div>
                            <?php
                        }
                        else
                        {
                            get_template_part('content', 'none');
                        }

                        wp_reset_query();
                    ?>
                </div>
                <div class="three columns">
					<div class="sidebar">
						<?php dynamic_sidebar('Primary Sidebar'); ?>
					</div>
				</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="clear"></div>
    </section>
</div><!-- #main-content -->

<?php
get_footer();
