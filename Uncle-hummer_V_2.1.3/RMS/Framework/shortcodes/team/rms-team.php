<?php
function team($atts)
{
    extract(shortcode_atts(array(
        'view'          => 'normal',
        'member'       => '4'
    ), $atts));
    
    $team_return = '';
    
    if($view == 'slide')
    {
        $args = array(
            'post_type'         => array('team'),
            'post_status'       => array('publish'),
            'posts_per_page'    => $member,
            'orderby'           => 'date',
            'order'             => 'DESC'
        );
        
        query_posts($args);
        if(have_posts())
        {
            $total = 0; 
            while(have_posts()){the_post(); $total++;}
            $team_return .= '<div class="rms_tema_member">';
            $team_return .= '<div id="carousel-example-generic-team" class="carousel slide" data-ride="carousel">';
            $team_return .= '<div class="carousel-inner">';            
            
            $t = 1;
            while (have_posts()): the_post();
                if($t == 1) { $team_return .= '<div class="item active">';}
                $des1 = get_post_meta(get_the_ID(), 'designation', TRUE);
            if($des1 != '')
            {
                $desig = $des1;
            }
            else
            {
                $desig = '';
            }
            if(has_post_thumbnail( get_the_ID() ))
            {
                $team_thumb = get_the_post_thumbnail(get_the_ID(), 'team_thumb');
            }
            else
            {
                $team_thumb = '<img src="http://placehold.it/220x215" alt="Reorder">';
            }
           $team_return .='
            <div class="col-xs-12 col-sm-4 col-lg-3">
                <div class="team_element">
                    <div class="team_show_area">
                        <div class="team_thumb">
                            '.$team_thumb.'
                        </div>
                        <div class="team_details text-center">
                            <h3 class=""> '.get_the_title().'</h3>
                                                        <p class="">'.$desig.'</p>
                        </div>
                    </div>
                    <div class="team_hide_area">
                        <p class="team_member_des">'.substr(get_the_content(), 0, 150).'</p>
                        <div class="our_team_social" >';
                            $fa = get_post_meta(get_the_ID(), 'facebook', true); if($fa != '') { 
                                                        $team_return .='<a href="http://facebook.com/'.$fa.'"><i class="fa fa-facebook"></i></a>';
                            }
                            $tw = get_post_meta(get_the_ID(), 'twitter', true); if($tw != '') { 
                                                        $team_return .='<a href="https://twitter.com/'.$tw.'"><i class="fa fa-twitter"></i></a>';
                            } 
                           $gp = get_post_meta(get_the_ID(), 'google', true); if($gp != '') { 
                                                         $team_return .='<a href="https://plus.google.com/'.$gp.'"><i class="fa fa-google-plus"></i></a>';
                            }
                            $li = get_post_meta(get_the_ID(), 'linkedin', true); if($li != '') { 
                                                        $team_return .='<a href="https://linkedin.com/'.$li.'"><i class="fa fa-linkedin"></i></a>';
                            }
                             $team_return .='<a href="#teammodal_'.  get_the_ID().'" data-toggle="modal"><i class="fa fa-plus"></i></a>';
                             $team_return .='</div>
                    </div>
                </div>
            </div>';
            $team_return .= '<div class="team_modal modal fade" id="teammodal_'.  get_the_ID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.get_the_ID().'" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="myModalLabel'.get_the_ID().'">'.  get_the_title().'</h4>
                            </div>
                            <div class="modal-body">
                                <div class="team_modal_left">'.  get_the_post_thumbnail(get_the_ID(), 'full').'</div>
                                <div class="team_modal_right">
                                    <p class="designation">'.  get_post_meta(get_the_ID(), 'designation', TRUE).'</p>
                                    <p class="tm_details">'.  get_the_content().'</p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>';
                if($t %  4 == 0 && $t < $total){ $team_return .='</div><div class="item">';}
                elseif($t % 4 == 0 && $t == $total){$team_return .='</div>';}
                elseif($t == $total){$team_return .='</div>';}
                $t++;
            endwhile;
            $team_return .= '</div>';
            $team_return .= '
                                <div class="controls">
                                    <a class="left carousel-control" href="#carousel-example-generic-team" data-slide="prev">
                                          <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic-team" data-slide="next">
                                          <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>';
            $team_return .= '</div>';
            $team_return .= '</div>';
        }
        else
        {
            $team_return .= '<div class="col-lg-12 text-center">';
                $team_return .= '<h1 class="common_main_heading">Please Insert Some <span>Member</span> First.</h1>';
            $team_return .= '</div>';
        }
        wp_reset_query();
    }
    else
    {
        $args1 = array(
            'post_type'         => array('team'),
            'post_status'       => array('publish'),
            'posts_per_page'    => $member,
            'orderby'           => 'date',
            'order'             => 'DESC'
        );
        
        query_posts($args1);
        if(have_posts())
        {
			$team_return .= 
					'<p>
						<a id="services-prev" href=""><i class="fa fa-chevron-left icon arrow-next outline attached"></i></a>
						<a id="services-next" href=""><i class="fa fa-chevron-right icon arrow-prev outline attached"></i></a>
					</p>';
            $team_return .= '<div class="list_carousel"><ul id="services-slider">';
            
            while(have_posts())
            {
                the_post();
                $des1 = get_post_meta(get_the_ID(), 'designation', TRUE);
				if($des1 != '')
				{
					$desig = $des1;
				}
				else
				{
					$desig = '';
				}
				if(has_post_thumbnail( get_the_ID() ))
				{
					$team_thumb = get_the_post_thumbnail(get_the_ID(), 'team_thumb');
				}
				else
				{
					$team_thumb = '<img src="http://placehold.it/360x270" alt="Reorder">';
				}
			   $team_return .='
				<li class="service-item">
					<i>'.$team_thumb.'</i>
					<p></p>
					<h4>'.get_the_title().'</h4>
					<p></p>
					<p>'.substr(get_the_content(), 0, 150).'</p>
					<h4 class="text-subtitle">From <b>'.$desig.'</b></h4>
					<ul>';
						$fa = get_post_meta(get_the_ID(), 'twitter', true); if($fa != '') { 
							$team_return .='<li>'.$fa.'</li>';
						} 
						$gp = get_post_meta(get_the_ID(), 'linkedin', true); if($gp != '') { 
							$team_return .='<li>'.$gp.'</li>';
						}
						$tw = get_post_meta(get_the_ID(), 'google', true); if($tw != '') { 
							$team_return .='<li>'.$tw.'</li>';
						}
					$team_return .='</ul>
					<p><a href="#" class="button outline">Order service</a></p>
				</li>';
            }
			$team_return .= '</ul></div>';
			
        }
        else
        {
            $team_return .= '<div class="col-lg-12 text-center">';
                $team_return .= '<h1 class="common_main_heading">Please Insert Some <span>Member</span> First.</h1>';
            $team_return .= '</div>';
        }
        wp_reset_query();
    }
    
    return $team_return;
}
add_shortcode( "rms-team", "team" );