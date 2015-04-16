<?php
    if(isset($_POST['header_settings']) && $_POST['header_settings'] == "Save Header Settings")
    {
        $logo_text = $_POST['logo_text'];
        if(isset($_FILES['logo_upload']) && $_FILES['logo_upload']['name'] != '')
        {
            
            require_once ABSPATH.'wp-admin/includes/file.php';

            $allowed_image_types = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'png'          => 'image/png',
                'gif'          => 'image/gif',
                
            );

                $upload_overrides = array( 'test_form' => false );
                $status = wp_handle_upload($_FILES['logo_upload'], $upload_overrides);

               if(empty($status['error']) && isset($status['file']))
               {
                    $uploads = wp_upload_dir();
                    $resized_url = $uploads['url'].'/'.$_FILES['logo_upload']['name'];

              }
              else
              {
                wp_die(sprintf(__('Upload Error: %s', 'rms'), $status['error']));
              }

        }
        
        
        update_option('logo_text', $logo_text);
        update_option('quick_phone', $_POST['quick_phone']);
        update_option('quick_email', $_POST['quick_email']);
        update_option('slidersettings', $_POST['slidersettings']);
        update_option('lohoheight', $_POST['lohoheight']);
        update_option('logowidth', $_POST['logowidth']);
        update_option('logopadding', $_POST['logopadding']);
        update_option('logomargin', $_POST['logomargin']);
        update_option('stickyHeader', $_POST['stickyHeader']);
        update_option('headerstyle', $_POST['headerstyle']);
        if(isset($resized_url) && $resized_url != '')
        {
            update_option('logo_url', $resized_url);
        }
        
        
        if(get_option('stickyHeader', FALSE) == 'yes')
        {
            $js_file = 'stickyMenu.js';
            $stickyjs = '//===============================================
                        // Sticky Header
                        //===============================================


                        jQuery(window).on("scroll", function(){
                                if( jQuery(window).scrollTop() > 100 ) 
                                {
                                    jQuery("#re_nav_bar").css({position: "fixed", width: "100%", background: "#000000", height: "auto", top: "0px", padding: "0px 0px 15px 0px"});
                                    jQuery("#navbar").css({padding: "22px 15px 0px 0px", margin: "0px"});
                                    jQuery("#logo img").css("padding", "16px 0px 0px 0px");
                                    jQuery("#mamenu").css({right: "116px", top: "24px"});
                                    jQuery("#re_nav_bar").addClass("animated3 fadeInUp");
                                    
                                } else 
                                {
                                    jQuery("#re_nav_bar").css({position: "relative", height: "auto", background: "rgba(0, 0, 0, .5)", padding: "0px 0px 15px 0px"});
                                    jQuery("#navbar").css("padding", "35px 15px 0px 0px");
                                    jQuery("#logo img").css("padding", "31px 0px 0px 0px");
                                    jQuery("#mamenu").css({right: "116px", top: "24px"});
                                    jQuery("#re_nav_bar").removeClass("animated3 fadeInUp");
                                }
                            });
                        jQuery(window).on("scroll", function(){
                                if( jQuery(window).scrollTop() > 100 ) 
                                {
                                    jQuery("#reorderheadertwo").css({position: "fixed", width: "100%", background: "rgba(255, 255, 255, 1)", top: "0px"});
                                    jQuery("#reorderheadertwo").addClass("animated3 fadeInUp");
                                    
                                } else 
                                {
                                    jQuery("#reorderheadertwo").css({position: "relative", height: "auto", background: "#ffffff"});
                                    jQuery("#reorderheadertwo").removeClass("animated3 fadeInUp");
                                    
                                }
                            });';
        
            WP_Filesystem();
            global $wp_filesystem;
            if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/js/'.$js_file, stripslashes($stickyjs), FS_CHMOD_FILE)) {
                echo 'Generating CSS error!';
            }
        }
        else
        {
            $js_file = 'stickyMenu.js';
            $stickyjs = 'jQuery(document).ready(function(){});';
        
            WP_Filesystem();
            global $wp_filesystem;
            if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/js/'.$js_file, stripslashes($stickyjs), FS_CHMOD_FILE)) {
                echo 'Generating CSS error!';
            }
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=h_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'removelogo')
    {
        delete_option('logo_url');
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=h_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET[''] == 'reset_general')
    {
        delete_option('logo_url');
        delete_option('logo_text');
        delete_option('quick_phone');
        delete_option('quick_email');
        delete_option('slidersettings');
        delete_option('lohoheight');
        delete_option('logowidth');
        delete_option('logopadding');
        delete_option('logomargin');
        delete_option('stickyHeader');
        delete_option('headerstyle');
        
         $js_file = 'stickyMenu.js';
            $stickyjs = 'jQuery(document).ready(function(){});';
        
            WP_Filesystem();
            global $wp_filesystem;
            if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/js/'.$js_file, stripslashes($stickyjs), FS_CHMOD_FILE)) {
                echo 'Generating CSS error!';
            }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=h_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Logo
        </th>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-upload"></i> Upload Logo Image With (226x44) Resolation. Other wise its heard crop automatically. </p>
            
            <?php
                $logo_url = get_option('logo_url', FALSE);
                if($logo_url != '' && isset($logo_url))
                {
                    echo '<div class="admin_logo_option"><img src="'.$logo_url.'" alt="ThemeOnLab"/></div>';
                }
            ?>
            
            <div class="custom_file_upload">
                <input type="text" class="file" id="upfile" name="file_info">
                    <div class="file_upload">
                            <input type="file" id="file_upload" name="logo_upload">
                    </div>
            </div>
            <div class="removebutton"><a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=h_option&action=removelogo'; ?>">Remove</a></div>
            <div class="clear"></div>
            <?php $logo_text = get_option('logo_text', FALSE); ?>
            <p style="margin-top: 20px;" class="rmsnotic"><i class="up_icon fa fa-indent"></i> Write your Logo Text. It will be show if logo is not present. </p>
            <input type="text" name="logo_text" class="general_input" value="<?php echo $logo_text; ?>" placeholder="RMS">
        </td>
    </tr>
    <tr>
        <td>
            <?php $lohoheight = get_option('lohoheight', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Set logo height.</p>
            <input type="text" class="general_input" name="lohoheight" placeholder="0px" value="<?php echo stripslashes($lohoheight); ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?php $logowidth = get_option('logowidth', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Set logo width.</p>
            <input type="text" class="general_input" name="logowidth" placeholder="0px" value="<?php echo stripslashes($logowidth); ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?php $logopadding = get_option('logopadding', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Set logo padding.</p>
            <input type="text" class="general_input" name="logopadding" placeholder="0px 0px 0px 0px" value="<?php echo stripslashes($logopadding); ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?php $logomargin = get_option('logomargin', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Set logo margin.</p>
            <input type="text" class="general_input" name="logomargin" placeholder="0px 0px 0px 0px" value="<?php echo stripslashes($logomargin); ?>"/>
        </td>
    </tr>
</table>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Slider Settings
        </th>
    </tr>
    <tr id="headerstylecheck">
        <td>
            <?php $slidersettings = get_option('slidersettings', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Slider Shortcode.</p>
            <input type="text" class="general_input" value="<?php echo $slidersettings; ?>" name="slidersettings"/>
        </td>
    </tr>
</table>

<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=h_option&reset=reset_general'; ?>">Default Options</a>
    <input type="submit" value="Save Header Settings" name="header_settings"/>
</div>
</form>

<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};

</script>