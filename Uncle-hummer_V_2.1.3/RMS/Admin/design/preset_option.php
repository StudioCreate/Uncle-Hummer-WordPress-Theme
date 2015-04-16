<?php
    if(isset($_POST['preset_settings']) && $_POST['preset_settings'] == 'Save Color Preset')
    {
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
        if(isset($resized_url) && $resized_url != '')
        {
            update_option('topBgUrl', $resized_url);
        }
        update_option('presetColor', $_POST['presetColor']);
        update_option('presetColorrgb', $_POST['presetColorrgb']);
        
        $preset_color = get_option('presetColor', false);
        $preset_rgb = get_option('presetColorrgb', false);
        
        $css = '';
        $hbg = get_option('topBgUrl', FALSE);
        if($hbg != '')
        {
            $css .= '#header{ background:url('.stripslashes($hbg).') no-repeat fixed center 0;}';
        }
        else
        {
            $css.= '#header{ background:url('.  get_template_directory_uri().'/RMS/Framework/assets/images/slider_bg/slider4.jpg) no-repeat fixed center 0;}';
        }
        
        if($preset_color != '' && $preset_rgb != '')
        {
            $css .= '
			#home:before,
			.rev_slider_wrapper .tp-bullets.simplebullets.round .bullet.selected,
			.ba-control-bar,
			.ba-control-handle,
			a .icon.arrow-top{
				background: #'.$preset_color.';
			}
			li.service-item ul li:hover{
				background: #'.$preset_color.'!important;
			}
			.rev_slider_wrapper .tp-bullets.simplebullets.round .bullet,
			li.partner-item:hover,
			.footer-two,
			.portfolio-thumb i,
			li.service-item i,
			#contactform input:focus,
			#contactform textarea:focus,
			#contactform select:focus{
				border-color: #'.$preset_color.';
			}
			#contactform img.preset_border{
				border-right: 2px solid #'.$preset_color.'!important;
			}
			.ba-control-handle:after{
				border-left: 35px solid transparent;
				border-right: 35px solid transparent;
				border-top: 22px solid #'.$preset_color.';
			}
			.ba-control-handle:before{
				border-left: 35px solid transparent;
				border-right: 35px solid transparent;
				border-bottom: 22px solid #'.$preset_color.';
			}
			.main-menu h1 a,
			.green-skin a:hover,
			.green-skin a.arrow-link:after,
			.portfolio-thumb i,
			.bigtext h5,
			.green-skin h5.bigtext,
			.text-subtitle:before,
			.text-subtitle:after,
			.text-color,
			li.service-item i,
			#partners-prev i:hover,
			#partners-next i:hover,
			#services-prev i:hover,
			#services-next i:hover{
				color: #'.$preset_color.';
			}
			.icon.huge:hover{
				border-color: #'.$preset_color.';
				color: #'.$preset_color.';
			}
			.ba-control-handle i,.red-skin .ba-control-handle i:hover{
				color: #fff;
			}
			.ba-control-handle:hover.ba-control-handle i{
				color: #fff;
			}';
        }
        
        $css_file = 'preset.css';
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/preset/'.$css_file, $css, FS_CHMOD_FILE)) 
        {
            echo 'Generating CSS error!';
        }
        
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=preset_option';
        echo "<script>window.location= '".$url."'</script>";
        
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'colorpreset')
    {
        delete_option('presetColor');
        delete_option('presetColorrgb');
        delete_option('topBgUrl');
        
        $css = '';
            
        $css_file = 'preset.css';
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/preset/'.$css_file, $css, FS_CHMOD_FILE)) 
        {
            echo 'Generating CSS error!';
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=preset_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'removebg')
    {
        delete_option('topBgUrl');
        
        $preset_color = get_option('presetColor', false);
        $preset_rgb = get_option('presetColorrgb', false);
        
        $css = '';
        $hbg = get_option('topBgUrl', FALSE);
        if($hbg != '')
        {
            $css .= '#header{ background:url('.stripslashes($hbg).') no-repeat fixed center 0;}';
        }
        else
        {
            $css.= '#header{ background:url('.  get_template_directory_uri().'/RMS/Framework/assets/images/slider_bg/slider4.jpg) no-repeat fixed center 0;}';
        }
        
        if($preset_color != '' && $preset_rgb != '')
        {
            $css .= '
			#home:before,
			.rev_slider_wrapper .tp-bullets.simplebullets.round .bullet.selected,
			.ba-control-bar,
			.ba-control-handle,
			a .icon.arrow-top{
				background: #'.$preset_color.';
			}
			li.service-item ul li:hover{
				background: #'.$preset_color.'!important;
			}
			.rev_slider_wrapper .tp-bullets.simplebullets.round .bullet,
			li.partner-item:hover,
			.footer-two,
			.portfolio-thumb i,
			li.service-item i,
			#contactform input:focus,
			#contactform textarea:focus,
			#contactform select:focus{
				border-color: #'.$preset_color.';
			}
			#contactform img.preset_border{
				border-right: 2px solid #'.$preset_color.'!important;
			}
			.ba-control-handle:after{
				border-left: 35px solid transparent;
				border-right: 35px solid transparent;
				border-top: 22px solid #'.$preset_color.';
			}
			.ba-control-handle:before{
				border-left: 35px solid transparent;
				border-right: 35px solid transparent;
				border-bottom: 22px solid #'.$preset_color.';
			}
			.main-menu h1 a,
			.green-skin a:hover,
			.green-skin a.arrow-link:after,
			.portfolio-thumb i,
			.bigtext h5,
			.green-skin h5.bigtext,
			.text-subtitle:before,
			.text-subtitle:after,
			.text-color,
			li.service-item i,
			#partners-prev i:hover,
			#partners-next i:hover,
			#services-prev i:hover,
			#services-next i:hover{
				color: #'.$preset_color.';
			}
			.icon.huge:hover{
				border-color: #'.$preset_color.';
				color: #'.$preset_color.';
			}
			.ba-control-handle i,.red-skin .ba-control-handle i:hover{
				color: #fff!important;
			}
			.ba-control-handle:hover.ba-control-handle i{
				color: #fff!important;
			}';
        }
        
        $css_file = 'preset.css';
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/preset/'.$css_file, $css, FS_CHMOD_FILE)) 
        {
            echo 'Generating CSS error!';
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=preset_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Color Preset Settings
        </th>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-upload"></i> Upload Logo Image With (226x44) Resolation. Other wise its heard crop automatically. </p>
            
            <?php
                $topBgUrl = get_option('topBgUrl', FALSE);
                if($topBgUrl != '' && isset($topBgUrl))
                {
                    echo '<div class="admin_logo_option"><img style="width: 500px;" src="'.$topBgUrl.'" alt="ThemeOnLab"/></div>';
                }
            ?>
            
            <div class="custom_file_upload">
                <input type="text" class="file" id="upfile" name="file_info">
                    <div class="file_upload">
                            <input type="file" id="file_upload" name="logo_upload">
                    </div>
            </div>
            <div class="removebutton"><a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=preset_option&action=removebg'; ?>">Remove</a></div>
            <div class="clear"></div>
        </td>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Insert Your Preset Color Code.</p>
            <input type="text" name="presetColor" id="baseColor" value="<?php echo get_option('presetColor', FALSE);?>" placeholder="000000" class="general_input" />
                
        </td>
    </tr>
    <tr>
        <td>
            
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i>Please Insert Preset Color Code With RGB Formate. ie(0, 0, 0).</p>
            <input type="text" name="presetColorrgb" value="<?php echo get_option('presetColorrgb', FALSE);?>" placeholder="0, 0, 0" class="general_input" />
        </td>
    </tr>
</table>


<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=preset_option&reset=colorpreset'; ?>">Default Options</a>
    <input type="submit" value="Save Color Preset" name="preset_settings"/>
</div>
</form>

<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};

</script>