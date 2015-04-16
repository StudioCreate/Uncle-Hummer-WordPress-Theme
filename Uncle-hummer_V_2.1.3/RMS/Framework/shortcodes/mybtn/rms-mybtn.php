<?php
function mybtn($atts, $content = null)
{
    extract(shortcode_atts(array(
        'text' => '',
        'link' => '#',
        'position' => '',
        'icon' => '',
        'bg' => '',
        'color' => '',
        'margin'        => '',
        'padding'       => '',
        'types' => '',
        'border'        => ''
    ), $atts));
	$results = '';
    if($position == 'center')
    {
        $style = 'margin: 0 auto;';
    }
    else
    {
        $style = 'float: '.$position.';';
    }
    if($icon != '')
    {
        $i = '<i class="'.$icon.'"></i>';
    }
    else
    {
        $i = ' ';
    }
    if($types == 'Normal-Button')
    {
        $results .= '<p><a href="'.$link.'" class="button outline smoothscroll" style="border: '.$border.'; padding: '.$padding.'; margin: '.$margin.'; background:'.$bg.'; color: '.$color.'">'.$text.' '.$i.'</a></p>';
    }
    elseif($types == 'Parallax-Button')
    {
        $results .= '<p><a href="'.$link.'" class="button outline white smoothscroll" style="border: '.$border.'; padding: '.$padding.'; margin: '.$margin.'; background:'.$bg.'; color: '.$color.'">'.$text.' '.$i.'</a></p>';
    }
	elseif($types == 'Simple-Button')
    {
        $results .= '<p><a href="'.$link.'" class="arrow-link smoothscroll" style="width: 100%; float: left; border: '.$border.'; padding: '.$padding.'; margin: '.$margin.'; background:'.$bg.'; color: '.$color.'">'.$text.' '.$i.'</a></p>';
    }
    return $section_mybtn = force_balance_tags( $results );
}
add_shortcode( "rms-mybtn", "mybtn" );