<?php
function subtitle($atts)
{
    extract(shortcode_atts(array(
        'substyle'           => '',
        'class'              => '',
        'text'               => '',
        'color'              => '',
        'fsize'              => '',
        'margin'             => '',
        'align'              => ''
    ), $atts));
    
	if($substyle == 'Sub-Heading-Bold'){
		$result = '<p class="big'.$class.'" style="margin: '.$margin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.';" >'.$text.'</p><br>';
    }
	elseif($substyle == 'Sub-Heading-Thin'){
		$result = '<p class="big thin'.$class.'" style="margin: '.$margin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.';" >'.$text.'</p>';
	}

    return $section_heading = force_balance_tags( $result );
    
    
}
add_shortcode( "rms-subtitle", "subtitle" );