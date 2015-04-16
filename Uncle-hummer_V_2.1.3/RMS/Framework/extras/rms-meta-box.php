<?php
add_action('add_meta_boxes', 'rms_page_custome_meta_box');
function rms_page_custome_meta_box()
{
    add_meta_box('pate_parrallax', __('Paralltax Settings', 'rms'), 'page_meta_action', 'page', 'side', 'high' );
}

function page_meta_action($post)
{
    echo '<p><i>Checked Parallax Status</i></p>';
    $meta = get_post_meta($post->ID, 'parallax_status', TRUE);
    if($meta == 'no')
    {
        $checked = 'checked="checked"';
    }
    else
    {
        $checked = '';
    }
	//
    $metas = get_post_meta($post->ID, 'parallax_animate', TRUE);
    if($metas == 'no')
    {
        $checkeds = 'checked="checked"';
    }
    else
    {
        $checkeds = '';
    }
	//
	$overley = get_post_meta($post->ID, 'parallax_overlay', TRUE);
	if($overley == 'no')
    {
        $checkede = 'checked="checked"';
    }
    else
    {
        $checkede = '';
    }
    $pbgcolor = get_post_meta($post->ID, 'pbgcolor', TRUE);
    
    
    echo '<p><input type="radio" value="yes" name="parallax_status" checked="checked"> Yes &nbsp;&nbsp; <input type="radio" value="no" name="parallax_status" '.$checked.'> No<br/><i><small>Checked Parallax Status.</small></i></p>';
	echo '<p><input type="radio" value="yes" name="parallax_animate" checked="checked"> Yes &nbsp;&nbsp; <input type="radio" value="no" name="parallax_animate" '.$checkeds.'> No<br/><i><small>Checked Parallax Animation.</small></i></p>';
	echo '<p><input type="radio" value="yes" name="parallax_overlay" checked="checked"> Yes &nbsp;&nbsp; <input type="radio" value="no" name="parallax_overlay" '.$checkede.'> No<br/><i><small>Checked Parallax Overlay.</small></i></p>';
    echo '<p><input type="text" value="'.$pbgcolor.'" name="pbgcolor"/><br/><i><small>Insert Parallax Section BG Color Code With HEX (#FFFFFF) Formate.</small></i></p>';
    
}

add_action( 'save_post', 'save_page_extra_info' );
function save_page_extra_info($post_ID)
{
    global $post;
    if(isset($_POST)):
        if(isset($_POST['parallax_status'])):
            update_post_meta($post_ID, 'parallax_status', $_POST['parallax_status']);
        endif;
		if(isset($_POST['parallax_animate'])):
            update_post_meta($post_ID, 'parallax_animate', $_POST['parallax_animate']);
        endif;
		if(isset($_POST['parallax_overlay'])):
            update_post_meta($post_ID, 'parallax_overlay', $_POST['parallax_overlay']);
        endif;
        if(isset($_POST['pbgcolor'])):
            update_post_meta($post_ID, 'pbgcolor', $_POST['pbgcolor']);
        endif;
    endif;
}

add_action('add_meta_boxes', 'rms_page_custome_extra_meta_box');
function rms_page_custome_extra_meta_box()
{
    add_meta_box('page_extra', __('Extra Settings', 'rms'), 'page_meta_extra_action', 'page', 'side', 'high' );
}

function page_meta_extra_action($post)
{
    echo '<p><i>Checked Title Status</i></p>';
    $letit = get_post_meta($post->ID, 'title_status', TRUE);
    if($letit == 'no')
    {
        $checked = 'checked="checked"';
    }
    else
    {
        $checked = '';
    }
    
    $sidebar = get_post_meta($post->ID, 'sidebar_status', TRUE);
    if($sidebar == 'no')
    {
        $checked1 = 'checked="checked"';
    }
    else
    {
        $checked1 = '';
    }
    
    
    
    echo '<p><input type="radio" value="yes" name="title_status" checked="checked"> Yes &nbsp;&nbsp; <input type="radio" value="no" name="title_status" '.$checked.'> No<br/><i><small>Checked Title Status.</small></i></p>';
    echo '<p><input type="radio" value="yes" name="sidebar_status" checked="checked"> Yes &nbsp;&nbsp; <input type="radio" value="no" name="sidebar_status" '.$checked1.'> No<br/><i><small>Checked No if you dont want to show sidebar.</small></i></p>';
}

add_action( 'save_post', 'save_page_extra_pagemeta_info' );
function save_page_extra_pagemeta_info($post_ID)
{
    global $post;
    if(isset($_POST)):
        if(isset($_POST['title_status'])):
            update_post_meta($post_ID, 'title_status', $_POST['title_status']);
        endif;
        if(isset($_POST['sidebar_status'])):
            update_post_meta($post_ID, 'sidebar_status', $_POST['sidebar_status']);
        endif;
    endif;
}




//==========================================
// Team Meta Box
//==========================================
add_action('add_meta_boxes', 'our_team_meta_box');
function our_team_meta_box()
{
    add_meta_box('our_team', __('Extra Information', 'reorder'), 'our_team_meta_action', 'team', 'advanced', 'high' );
}
function our_team_meta_action($post) { ?>
    <?php $designation = get_post_meta($post->ID, 'designation', true); ?>
    <div class="meta_tr"><div class="meta_lable">Prices</div><div class="meta_field"><input type="text" name="designation" value="<?php echo $designation; ?>"></div></div>
    <?php $linkedin = get_post_meta($post->ID, 'linkedin', true); ?>
    <div class="meta_tr"><div class="meta_lable">Worker Number</div><div class="meta_field"><input type="text" name="linkedin" value="<?php echo $linkedin; ?>"></div></div>
    <?php $google = get_post_meta($post->ID, 'google', true); ?>
    <div class="meta_tr"><div class="meta_lable">Discount / Equipment</div><div class="meta_field"><input type="text" name="google" value="<?php echo $google; ?>"></div></div>
    <?php $twitter = get_post_meta($post->ID, 'twitter', true); ?>
    <div class="meta_tr"><div class="meta_lable">Work Time</div><div class="meta_field"><input type="text" name="twitter" value="<?php echo $twitter; ?>"></div></div>
    <div class="clr"></div>
<?php 
}

add_action( 'save_post', 'save_team_extra_info' );
function save_team_extra_info($post_ID)
{
    global $post;
    if(isset($_POST))
    {
        if(isset($_POST['designation']))
        {
            update_post_meta( $post_ID, 'designation', strip_tags($_POST['designation']) );
        }
        if(isset($_POST['facebook']))
        {
            update_post_meta( $post_ID, 'facebook', strip_tags($_POST['facebook']) );
        }
        if(isset($_POST['linkedin']))
        {
            update_post_meta( $post_ID, 'linkedin', strip_tags($_POST['linkedin']) );
        }
        if(isset($_POST['google']))
        {
            update_post_meta( $post_ID, 'google', strip_tags($_POST['google']) );
        }
        if(isset($_POST['twitter']))
        {
            update_post_meta( $post_ID, 'twitter', strip_tags($_POST['twitter']) );
        }
        
    }
}
//==========================================
// End Team Meta Box
//==========================================

//==========================================
// Testimonial Meta Box
//==========================================

add_action('add_meta_boxes', 'our_testimonial_meta_box');
function our_testimonial_meta_box()
{
    add_meta_box('our_testimonial', __('Extra Information', 'reorder'), 'testimonial_meta_action', 'testimonial', 'advanced', 'high' );
}
function testimonial_meta_action($post) { ?>
    <?php $designation = get_post_meta($post->ID, 'designation', true); ?>
    <div class="meta_tr"><div class="meta_lable">Designation</div><div class="meta_field"><input type="text" name="designation" value="<?php echo $designation; ?>"></div></div>
    <div class="clr"></div>
<?php 
}

add_action( 'save_post', 'save_testimonial_extra_info' );
function save_testimonial_extra_info($post_ID)
{
    global $post;
    if(isset($_POST))
    {
        if(isset($_POST['designation']))
        {
            update_post_meta( $post_ID, 'designation', strip_tags($_POST['designation']) ); 
        }
    }
}

//==========================================
// End Testimonial Meta Box
//==========================================

//==========================================
// Client Meta Box
//==========================================


add_action('add_meta_boxes', 'rms_client_info');
function rms_client_info()
{
    add_meta_box('client_info', __('Client Info', 'rms'), 'client_information', 'client', 'advanced', 'high' );
}

function client_information($post)
{
    echo '<p><i>Insert your client URL.</i></p>';
    $url = get_post_meta($post->ID, 'client_url', TRUE);
    
    echo '<input type="text" name="client_url" value="'.$url.'" placeholder="http://" style="width: 100%; height: 30px;"/><br/><br/>';
}

add_action( 'save_post', 'save_clint_url' );
function save_clint_url($post_ID)
{
    global $post;
    if(isset($_POST)):
            if(isset($_POST['client_url']) && $_POST['client_url'] != ''):
                update_post_meta($post_ID, 'client_url', $_POST['client_url']);
            endif;
    endif;
}

//======================================

//======================================
// Product Meta Box
//======================================

add_action('add_meta_boxes', 'our_product_meta_box');
function our_product_meta_box()
{
    add_meta_box('product_template', __('Set Template', 'reorder'), 'product_meta_action', 'product', 'side', 'core' );
}
function product_meta_action($post) { 
    $template_style = get_post_meta($post->ID, 'template_style', true); 
    echo '<div class="inside">';
    echo '<p><strong>Template</strong></p>';
    ?>
    <select name="template_style" style="width: 190px !important;">
        <option value="1" <?php if($template_style == 1) echo "Selected"; ?>>Left To Right</option>
        <option value="2" <?php if($template_style == 2) echo "Selected"; ?>>Right to Left</option>
        <option value="3" <?php if($template_style == 3) echo "Selected"; ?>>Full Widt</option>
    </select>
    <?php
    echo '</div>';
}

add_action( 'save_post', 'save_product_template_style_info' );
function save_product_template_style_info($post_ID)
{
    global $post;
    if(isset($_POST))
    {
        if(isset($_POST['template_style']))
        {
            update_post_meta( $post_ID, 'template_style', strip_tags($_POST['template_style']) ); 
        }
    }
}

//==========================================================

//==========================================================
// Portfolio
//==========================================================

add_action('add_meta_boxes', 'rms_protfolio_custome_meta_box');
function rms_protfolio_custome_meta_box()
{
    add_meta_box('pate_parrallax', __('Extra Settings', 'rms'), 'protfolio_meta_action', 'portfolio', 'side', 'high' );
}

function protfolio_meta_action($post)
{
    echo '<p><i>Insert Live URL</i></p>';
    $meta = get_post_meta($post->ID, 'live_url', TRUE);
    ?>
    <input type="text" name="live_url" placeholder="http://" value="<?php echo $meta; ?>"/>
    <?php 
}

add_action( 'save_post', 'save_protfolio_url' );
function save_protfolio_url($post_ID)
{
    global $post;
    if(isset($_POST)):
            if(isset($_POST['live_url']) && $_POST['live_url'] != ''):
                update_post_meta($post_ID, 'live_url', $_POST['live_url']);
            endif;
    endif;
}

//=====================================================
// Features
//=====================================================
add_action('add_meta_boxes', 'rms_features_custome_meta_box');
function rms_features_custome_meta_box()
{
    add_meta_box('pate_parrallax', __('Extra Settings', 'rms'), 'features_meta_action', 'features', 'side', 'high' );
}

function features_meta_action($post)
{
    echo '<p><i>Insert FontAweSome icon class. ie(fa fa-facebook)</i></p>';
    $meta = get_post_meta($post->ID, 'featuresicon', TRUE);
    ?>
    <input type="text" name="featuresicon" placeholder="fa facebook" value="<?php echo $meta; ?>"/>
    <?php 
}

add_action( 'save_post', 'save_features_url' );
function save_features_url($post_ID)
{
    global $post;
    if(isset($_POST)):
            if(isset($_POST['featuresicon']) && $_POST['featuresicon'] != ''):
                update_post_meta($post_ID, 'featuresicon', $_POST['featuresicon']);
            endif;
    endif;
}