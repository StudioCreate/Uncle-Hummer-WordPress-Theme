<?php
function member($atts)
{
    extract(shortcode_atts(array(
        'member'       => ''
    ), $atts));
    
    $member_return = '';
    if($member != '')
    {
        if(has_post_thumbnail($member))
        {
            $srcfull = get_the_post_thumbnail($member, 'pthumb');
        }
        else
        {
            $srcfull = '<img src="http://placehold.it/220x220" alt="ThemeonLab"/>';
        }
        $content_post = get_post($member);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        $member_return .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2 col-lg-offset-2">
            <div class="team-details animation about_me">
                <div class="about_me_thumb">
                    '.$srcfull.'
                </div>
                <div class="team-detail-title">
                    <h2>'.get_the_title($member).'</h2>
                    <p>'.get_post_meta($member, 'designation', TRUE).'</p>
                </div>
                <div class="tem_mem_des">
                    '.$content.'
                </div>
                <div class="team-details-social">
                    <a href="'.get_post_meta($member, 'twitter', TRUE).'" class="twitter-ico"><i class="fa fa-twitter"></i></a>
                    <a href="'.get_post_meta($member, 'facebook', TRUE).'" class="facebook-ico"><i class="fa fa-facebook"></i></a>
                    <a href="'.get_post_meta($member, 'linkedin', TRUE).'" class="linkedin-ico"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>

        </div>';
    }
    else
    {
        $member_return .= '<div class="col-lg-12 text-center">';
            $member_return .= '<h1 class="common_main_heading"><span>Member</span> Not Exist.</h1>';
        $member_return .= '</div>';
    }
    
    
    return $member_return;
}
add_shortcode( "rms-member", "member" );