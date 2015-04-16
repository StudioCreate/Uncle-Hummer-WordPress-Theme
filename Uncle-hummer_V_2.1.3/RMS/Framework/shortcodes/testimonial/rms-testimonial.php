<?php
function testimonial($atts)
{
    extract(shortcode_atts(array(
        'number'       => '8'
    ), $atts));
    
    $testimonial_return = '';
    
        $normal1 = array(
            'post_type'         => array('testimonial'),
            'status'            => array('publish'),
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => $number
        );
        
        query_posts($normal1);
        if(have_posts())
        {
            $testimonial_return .= '<div class="header medium"><div class="header-center"><div class="centerdiv text-white"><ul id="reviews-slider" class="bxslider">';
            
            $total = 0; 
            while(have_posts()){the_post(); $total++;}
            
            $t = 1;
            while(have_posts()): the_post();
                
                $designation = get_post_meta(get_the_ID(), 'designation', true);
                if(has_post_thumbnail( get_the_ID() ))
                {
                    $team_thumb = get_the_post_thumbnail(get_the_ID(), 'monial-thumb');
                }
                else
                {
                    $team_thumb = '<img src="http://placehold.it/53x53" alt="Reorder">';
                }
                
                $testimonial_return .='
						<li>
							<h4 class="bigtext margin-bottom-big quote">'.substr(get_the_content(), 0, 210).'</h4>
							<h6 class="bigtext serif italic">&mdash; '.get_the_title().', '.$designation.'</h6>
						</li>';
                $t++;  
            endwhile;
            $testimonial_return .= '</ul></div></div></div>';
        }
        else
        {
            
                    $testimonial_return .= '<div class="col-lg-12 text-center">';
                        $testimonial_return .= '<h1 class="common_main_heading">Please Insert Some <span>Testimonial</span> First.</h1>';
                    $testimonial_return .= '</div>';
            
        }
        wp_reset_query();
    
    
    return $testimonial_return;
}
add_shortcode( "rms-testimonial", "testimonial" );