<?php
function features($atts)
{
    extract(shortcode_atts(array(
        'number'       => '6'
    ), $atts));
    
    $fa = '';
        $features = array(
            'post_type'     => array('features'),
            'post_status'   => array('publish'),
            'orderby'       => 'date',
            'order'         => 'DESC',
            'posts_per_page'=> $number                      
        );
        
        query_posts($features);
        if(have_posts())
        {
            while (have_posts())
            {
                the_post();
                $icon = get_post_meta(get_the_ID(), 'featuresicon', TRUE);
                if($icon != '')
                {
                    $ic = $icon;
                }
                else
                {
                    $ic = 'fa fa-pencil-square-o';
                }
                $fa .= '<div class="four columns own_gap">
							<p><a href="'.get_permalink().'"><i class="'.$ic.' icon huge"></i></a></p>
							<h4>'.substr(get_the_title(), 0, 25).'</h4>
							<p>'.substr(get_the_content(), 0, 300).'</p>
                        </div>';
            }
        }
        else
        {
            $fa .= '<div class="container"><div class="row"><div class="col-lg-12"><h1 class="common_heading">Please Insert Some Features First.</h1></div></div></div>';
        }
        wp_reset_query();
        return $fa;
    
}
add_shortcode( "features", "features" );