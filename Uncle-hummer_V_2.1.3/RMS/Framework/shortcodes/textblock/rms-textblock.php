<?php
function textblock($atts, $content = null)
{
    extract(shortcode_atts(array(
        'text' => '',
        'icon' => '',
        'text1' => '',
        'contents' => '',
        'color' => '',
        'fsize' => '',
        'margin'        => ''
    ), $atts));
	$results ='';
    if($icon != '')
    {
        $i = '<i class="'.$icon.'"></i>';
    }
    else
    {
        $i = ' ';
    }
	
	$results .= '<h4 style="margin: '.$margin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.';" >'.$text.' &nbsp; '.$i.' &nbsp; '.$text1.'</h4><p>'.$contents.'</p>';
	
    return $section_mybtn = force_balance_tags( $results );
}
add_shortcode( "rms-textblock", "textblock" );