<?php
function counter($atts, $content = null)
{
    extract(shortcode_atts(array(
        'text' => '',
        'text1' => '',
        'icon' => ''
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
	
	$results .= '
	<i class="'.$icon.' count"></i>
	<h4 class="details"><span class="counter" data-to="'.$text.'">'.$text.'</span>'.$text1.'</h4>';
	
    return $section_mybtn = force_balance_tags( $results );
}
add_shortcode( "rms-counter", "counter" );