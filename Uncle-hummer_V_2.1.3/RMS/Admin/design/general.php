<?php
    if(isset($_POST['general_settings']) && $_POST['general_settings'] == 'Save General Settings')
    {
        $commentswithc = $_POST['commentswithc'];
        $google_tracking = $_POST['google_tracking'];
        
        
        if(isset($_FILES['file_upload']) && $_FILES['file_upload']['name'] != '')
        {
            
            require_once ABSPATH.'wp-admin/includes/file.php';

            $allowed_image_types = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'png'          => 'image/png',
                'gif'          => 'image/gif',
                
            );

                $upload_overrides = array( 'test_form' => false );
                $status = wp_handle_upload($_FILES['file_upload'], $upload_overrides);

               if(empty($status['error']) && isset($status['file']))
               {
                    
                    
                    $uploads = wp_upload_dir();
                    //$org_url = $uploads['url'].'/'.basename($resized);
                    $org_url = $uploads['url'].'/'.$_FILES['file_upload']['name'];

				}
				else
				{
					wp_die(sprintf(__('Upload Error: %s', 'rms'), $status['error']));
				}

        }
        
        $js_file = 'analyticgoogle.js';
        
        
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/js/'.$js_file, stripslashes($google_tracking), FS_CHMOD_FILE)) {
            echo 'Generating CSS error!';
        }
        
        update_option('commentswithc', $commentswithc);
        update_option('google_tracking', $google_tracking);
        if(isset($org_url) && $org_url != '')
        {
            update_option('favicon_url', $org_url);
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'removefavicon')
    {
        delete_option('favicon_url');
        $url = admin_url().'themes.php?page=rms_theme_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_general')
    {
        delete_option('commentswithc');
        delete_option('google_tracking');
        delete_option('favicon_url');
        $url = admin_url().'themes.php?page=rms_theme_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Google Analytics Tracking Code
        </th>
    </tr>
    <tr>
        <td>
            <?php $google_tracking = get_option('google_tracking', FALSE); ?>
            <p class="rmsnotic"> Paste your Google Analytics Code (or other) here. </p>
            <textarea name="google_tracking" ><?php echo stripslashes($google_tracking); ?></textarea>
        </td>
    </tr>
</table>

<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Favicon Icon
        </th>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-upload"></i> Upload your Favicon (16x16px ico/png - use <a href="#">favicon.cc</a> to make sure it's fully compatible).</p>
            <?php $favicon_url = get_option('favicon_url', FALSE); ?>
            <?php 
                if($favicon_url != ''):
                    echo '<div class="favicon_image"><img src="'.$favicon_url.'" alt="Winter"/></div>';
                endif;
            ?>
            <div class="custom_file_upload">
                <input type="text" class="file" id="upfile" name="file_info">
                    <div class="file_upload">
                            <input type="file" id="file_upload" name="file_upload">
                    </div>
            </div>
            <div class="removebutton"><a href="<?php echo admin_url().'themes.php?page=rms_theme_option&action=removefavicon'; ?>">Remove</a></div>
            
        </td>
    </tr>
</table>

<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&reset=reset_general'; ?>">Default Options</a>
    <input type="submit" value="Save General Settings" name="general_settings"/>
    
</div>
<div class="clear"></div>
</form>
<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};
</script>