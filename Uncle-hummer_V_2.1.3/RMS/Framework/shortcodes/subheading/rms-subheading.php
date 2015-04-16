<?php
function subheading($atts)
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
    
    
    if($hsize == 'Subheading')
    {
        $result = '<h2 class="text-dark text-subtitle '.$class.'" style="margin: '.$hmargin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.'" >'.$text.'</h2>';
    }
    elseif($hsize == 'Parallax-Subheading')
    {
        $result = '<div class="centerdiv text-white"><h6 class="bigtext serif italic '.$class.'" style="margin: '.$hmargin.'; width: 100%; color: '.$color.'; font-size: '.$fsize.'; text-align:'.$align.'">'.$text.'</h6></div>';
    }

    return $section_heading = force_balance_tags( $result );
    
    
}
add_shortcode( "rms-subheading", "subheading" );