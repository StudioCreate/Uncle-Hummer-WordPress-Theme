<?php
require_once '../../../../../../wp-load.php';

$numpost = $_POST['numpost'];
$args = array(
    'post_type'     => array('post'),
    'post_status'   => array('publish'),
    'orderby'       => 'date',
    'order'         => 'DESC',
    'posts_per_page'=> 4,
    'offset'        => $numpost
);
query_posts($args);
$return_html = '';
if(have_posts())
{
    while(have_posts()): the_post();
            if(has_post_thumbnail())
            {
                $img = get_the_post_thumbnail(get_the_ID(), 'blog');
            }
            else
            {
                $img = '<img src="http://placehold.it/290x180" alt="'.get_the_title().'">';
            }
            
            $return_html .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="thumbnail blog_post">
                                      '.$img.'
                                      <div class="caption">
                                            <h3>'.  get_the_title().'</h3>
                                            <p>'.  substr(get_the_content(), 0, 110).'</p>
                                            <a href="'.  get_permalink().'" class="read_more">Read More >></a>
                                      </div>
                                    </div>
                            </div>';
    endwhile;
}
else
{
    $return_html .= '<div class="clear"></div><p style="text-align:center; width: 100%;" class="moreposterror">No more post available.</p>';
}
echo $return_html;