<?php
function partner($atts)
{
    extract(shortcode_atts(array(
        'view'          => 'normal',
        'member'       => '4'
    ), $atts));
    
    $partner_return = '';
    
    if($view == 'slide')
    {
        $args = array(
            'post_type'         => array('client'),
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
            $partner_return .= '<div class="rms_tema_member">';
            $partner_return .= '<div id="carousel-example-generic-partner" class="carousel slide" data-ride="carousel">';
            $partner_return .= '<div class="carousel-inner">';            
            
            $t = 1;
            while (have_posts()): the_post();
                if($t == 1) { $partner_return .= '<div class="item active">';}
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
                $partner_thumb = get_the_post_thumbnail(get_the_ID(), 'partner_thumb');
            }
            else
            {
                $partner_thumb = '<img src="http://placehold.it/220x215" alt="Reorder">';
            }
           $partner_return .='
            <div class="col-xs-12 col-sm-4 col-lg-3">
                <div class="partner_element">
                    <div class="partner_show_area">
                        <div class="partner_thumb">
                            '.$partner_thumb.'
                        </div>
                        <div class="partner_details text-center">
                            <h3 class=""> '.substr(get_the_title(), 0, 12).'</h3>
                                                        <p class="">'.$desig.'</p>
                        </div>
                    </div>
                    <div class="partner_hide_area">
                        <p class="partner_member_des">'.substr(get_the_content(), 0, 150).'</p>
                        <div class="our_partner_social" >';
                            $fa = get_post_meta(get_the_ID(), 'facebook', true); if($fa != '') { 
                                                        $partner_return .='<a href="http://facebook.com/'.$fa.'"><i class="fa fa-facebook"></i></a>';
                            }
                            $tw = get_post_meta(get_the_ID(), 'twitter', true); if($tw != '') { 
                                                        $partner_return .='<a href="https://twitter.com/'.$tw.'"><i class="fa fa-twitter"></i></a>';
                            } 
                           $gp = get_post_meta(get_the_ID(), 'google', true); if($gp != '') { 
                                                         $partner_return .='<a href="https://plus.google.com/'.$gp.'"><i class="fa fa-google-plus"></i></a>';
                            }
                            $li = get_post_meta(get_the_ID(), 'linkedin', true); if($li != '') { 
                                                        $partner_return .='<a href="https://linkedin.com/'.$li.'"><i class="fa fa-linkedin"></i></a>';
                            }
                             $partner_return .='<a href="#partnermodal_'.  get_the_ID().'" data-toggle="modal"><i class="fa fa-plus"></i></a>';
                             $partner_return .='</div>
                    </div>
                </div>
            </div>';
            $partner_return .= '<div class="partner_modal modal fade" id="partnermodal_'.  get_the_ID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.get_the_ID().'" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="myModalLabel'.get_the_ID().'">'.  get_the_title().'</h4>
                            </div>
                            <div class="modal-body">
                                <div class="partner_modal_left">'.  get_the_post_thumbnail(get_the_ID(), 'full').'</div>
                                <div class="partner_modal_right">
                                    <p class="designation">'.  get_post_meta(get_the_ID(), 'designation', TRUE).'</p>
                                    <p class="tm_details">'.  get_the_content().'</p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>';
                if($t %  4 == 0 && $t < $total){ $partner_return .='</div><div class="item">';}
                elseif($t % 4 == 0 && $t == $total){$partner_return .='</div>';}
                elseif($t == $total){$partner_return .='</div>';}
                $t++;
            endwhile;
            $partner_return .= '</div>';
            $partner_return .= '
                                <div class="controls">
                                    <a class="left carousel-control" href="#carousel-example-generic-partner" data-slide="prev">
                                          <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic-partner" data-slide="next">
                                          <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>';
            $partner_return .= '</div>';
            $partner_return .= '</div>';
        }
        else
        {
            $partner_return .= '<div class="col-lg-12 text-center">';
                $partner_return .= '<h1 class="common_main_heading">Please Insert Some <span>Member</span> First.</h1>';
            $partner_return .= '</div>';
        }
        wp_reset_query();
    }
    else
    {
        $args1 = array(
            'post_type'         => array('client'),
            'post_status'       => array('publish'),
            'posts_per_page'    => $member,
            'orderby'           => 'date',
            'order'             => 'DESC'
        );
        
        query_posts($args1);
        if(have_posts())
        {
            $partner_return .= '<div id="partner-slider" class="list_carousel"><ul id="partners-slider">';
            
            while(have_posts())
            {
                the_post();
				$des1 = get_post_meta(get_the_ID(), 'client_url', TRUE);
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
					$partner_thumb = get_the_post_thumbnail(get_the_ID(), 'partner_thumb');
				}
				else
				{
					$partner_thumb = '<img src="http://placehold.it/215x160" alt="Reorder">';
				}
			   $partner_return .='
				<li class="partner-item"><a href="'.$desig.'" title="some-partners-link">'.$partner_thumb.'</a></li>';
            }
			$partner_return .= '</ul>';
			$partner_return .= 
					'<p>
						<a id="partners-prev" href=""><i class="fa fa-chevron-left icon arrow-next outline attached"></i></a>
						<a id="partners-next" href=""><i class="fa fa-chevron-right icon arrow-prev outline attached"></i></a>
					</p>';
			$partner_return .= '</div>';
        }
        else
        {
            $partner_return .= '<div class="col-lg-12 text-center">';
                $partner_return .= '<h1 class="common_main_heading">Please Insert Some <span>Client</span> First.</h1>';
            $partner_return .= '</div>';
        }
        wp_reset_query();
    }
    
    return $partner_return;
}
add_shortcode( "rms-partner", "partner" );