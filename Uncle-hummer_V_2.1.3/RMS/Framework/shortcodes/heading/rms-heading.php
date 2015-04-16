<?php
function heading($atts)
{
    extract(shortcode_atts(array(
        'hsize'              => '',
        'text'               => '',
        'class'              => '',
        'color'              => '',
        'fsize'              => '',
        'hmargin'            => '',
        'align'              => ''
    ), $atts));
    
    
    if($hsize == 'topheading')
    {
        $result = '<h5 class="bigtext letterspace bold '.$class.'" style="margin: '.$hmargin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.'" >'.$text.'</h5><hr style="width: 220px;height: 2px;background: #adadad;border: 0;margin: 50px auto 35px;">';
    }
    elseif($hsize == 'defaultheading')
    {
        $result = '<div class="title"><h1 class="'.$class.'" style=" width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.'" >'.$text.'</h1><hr style="width: 80px;height: 2px;background: #cccccc;border: 0;margin: 0 auto;"></div>';
    }
	elseif($hsize == 'parallaxheading')
    {
		$result = '<div class="centerdiv text-white"><h4 class="bigtext letterspace bold '.$class.'" style="margin: '.$hmargin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.'">'.$text.'</h4></div>';
    }
	elseif($hsize == 'parallaxcolorheading')
    {
        $result = '<h5 class="bigtext letterspace bold text-color '.$class.'" style=" width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.';">'.$text.'</h5><hr style="width: 220px;height: 2px;background: #ffffff;border: 0;margin: 50px auto 35px;">';
    }

    return $section_heading = force_balance_tags( $result );
    
    
}
add_shortcode( "rms-heading", "heading" );