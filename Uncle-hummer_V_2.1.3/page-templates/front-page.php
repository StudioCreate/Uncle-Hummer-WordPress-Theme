<?php

/**
 * Template Name: Front Page
 *
 * @package Reorder
 * @subpackage Reorder
 * @since Reorder 1.0
 */
get_header();
?>

<?php

$pages = unserialize(get_option('parallax_page_list', true));
$p_count = count($pages);
if (is_array($pages) && !empty($pages)) {
    foreach ($pages as $ids) {
        $content_post = get_post($ids);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $color = get_post_meta($ids, 'pbgcolor', true);
        $paraanimate = get_post_meta($ids, 'parallax_animate', true);
        $paraoverlay = get_post_meta($ids, 'parallax_overlay', true);
        $custom = MultiPostThumbnails::get_post_thumbnail_id('page', 'parallax-image', $ids);
        $custom = wp_get_attachment_image_src($custom, 'parallax-image');
        $url = $custom[0];
        $back_status = get_post_meta($ids, 'backgroud_status', true);


        $back = '';
        if ($url != '') {
            $back = $url;
        } else {
            $back = '';
        }
        $animate = '';
        if ($paraanimate == 'yes') {
            $animate = 'animation: animatedBackground 80s linear infinite;-ms-animation: animatedBackground 80s linear infinite;-moz-animation: animatedBackground 80s linear infinite;-webkit-animation: animatedBackground 80s linear infinite;background-attachment: fixed;';
        }
        $overlay = '';
        if ($paraoverlay == 'yes') {
            $overlay = 'position: absolute;height: 100%;width: 100%;left: 0;top: 0;background: rgba(11, 13, 13, 0.4) url(' . get_template_directory_uri() . '/images/overlay.png);background-size: initial;';
        }

        echo '<section id="' . strtolower(str_replace(' ', '_', $content_post->post_title)) . '" style=" background: url(' . $back . ') fixed center center ' . $color . ';position: relative;overflow: hidden;padding: 100px 0px 80px 0px;' . $animate . '"><h2 class="empty">RMS</h2><div style="' . $overlay . '"></div>';
        echo $content;
        echo '</section>';
    }
}
?>
<?php get_template_part('content', 'contact'); ?>    
<?php

get_footer();
