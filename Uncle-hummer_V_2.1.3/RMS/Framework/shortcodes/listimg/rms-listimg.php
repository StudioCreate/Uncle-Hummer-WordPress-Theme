<?php
function rms_listimg($atts, $content = NULL)
{
    $retrun_list = '<div class="ba-slider ten columns center">'.do_shortcode($content).'</div>';
    return $retrun_list;
}
add_shortcode('rms-listimg', 'rms_listimg');

function rms_list_img($atts, $content = NULL)
{
    $retrun_item = '<img alt="" src="'.do_shortcode($content).'"/>';
    return $retrun_item;
}
add_shortcode('rms-list-img', 'rms_list_img');