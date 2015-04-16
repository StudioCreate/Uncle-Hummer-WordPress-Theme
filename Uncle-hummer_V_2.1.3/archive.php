<?php
/**
 * The template for displaying Archive pages
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="common_heading">
                            <?php
                            if ( is_day() ) :
                                    printf( __( 'Daily Archives: %s', 'reorder' ), get_the_date() );

                            elseif ( is_month() ) :
                                    printf( __( 'Monthly Archives: %s', 'reorder' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'reorder' ) ) );

                            elseif ( is_year() ) :
                                    printf( __( 'Yearly Archives: %s', 'reorder' ), get_the_date( _x( 'Y', 'yearly archives date format', 'reorder' ) ) );

                            else :
                                    _e( 'Archives', 'reorder' );

                            endif;
                    ?>
                        </h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="reorderblogsection">
        <div class="container">
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
                            $bltr .= '<div style="margin-top: 30px">';
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
                                    if(has_post_thumbnail()) {
                                        echo get_the_post_thumbnail(get_the_ID(), 'blog-thumb');
                                    } else { 
                                        echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
                                    } 
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
                            $bltr .= '<div style="margin-top: 30px">';
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
                                    if(has_post_thumbnail()) {
                                        echo get_the_post_thumbnail(get_the_ID(), 'blog-thumb');
                                    } else { 
                                        echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
                                    } 
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
                <div class="col-xs-12 co-sm-8 col-lg-9">
                    <?php
                        
                        if(have_posts())
                        {
                            $bltr .= '<div style="margin-top: 30px">';
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
                                    if(has_post_thumbnail()) {
                                        echo get_the_post_thumbnail(get_the_ID(), 'blog-thumb');
                                    } else { 
                                        echo '<img src="http://placehold.it/670x270" alt="Reorder"/>';
                                    } 
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
                <div class="col-xs-12 col-sm-4 col-lg-3 blog_sidebar">
                    <div class="reorder_search" style="padding-top: 26px !important; padding-bottom: 30px !important;">
                        <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) );?>">
                            <div>
                                    <input type="text" value="<?php echo get_search_query();?>" name="s" id="s" placeholder="<?php echo __( 'Search for posts', 'woocommerce' );?>" />
                                    <input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' );?>" />
                                    <input type="hidden" name="post_type" value="post" />
                            </div>
                        </form><div class="clear"></div>
                     </div>
                    <?php echo dynamic_sidebar('sidebar-9'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="clear"></div>
    </section>
</div><!-- #main-content -->
<?php

get_footer();
