<?php
    if(isset($_POST['layout_settings']) && $_POST['layout_settings'] == 'Save Layout Settings')
    {
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
        
        
        
        update_option('siteLayout', $_POST['siteLayout']);
        update_option('backgroundimageurl', $_POST['backgroundimageurl']);
        update_option('boxBackgrounColor', $_POST['boxBackgrounColor']);
        if(isset($org_url) && $org_url != '')
        {
            update_option('boxBackground', $org_url);
        }
        
        
        $layoutcss = '';
        
        if(get_option('siteLayout', FALSE) == 'wide')
        {
            $layoutcss .= 'body{
                                background:#FFFFFF;
                            }
                            #page{
                                width: 100%;
                                margin: 0 auto;
                            }
                            #page #header #re_nav_bar{
                                max-width: 100% !Important;
                            }';
        }
        elseif(get_option('siteLayout', FALSE) == 'semibox')
        {
            if(get_option('boxBackground', FALSE) != '')
            {
                $bac = get_option('boxBackground', FALSE);
            }
            elseif(get_option('backgroundimageurl', FALSE) != '')
            {
                $bac = get_option('backgroundimageurl', FALSE);
            }
            else
            {
                $bac = '';
            }
            
            if(get_option('boxBackgrounColor', FALSE) != '')
            {
                $color = get_option('boxBackgrounColor', FALSE);
            }
            else
            {
                $color = 'FFFFFF';
            }
            
            $layoutcss .= 'body{
                                background: url('.$bac.') repeat #'.$color.';
                            }
                            #page{
                                width: 1170px;
                                margin: 0 auto;
                                box-shadow: 0 0 3px rgba(0, 0, 0, 0.5) !important;
                                background: #ffffff;
                            }
                            #page #header #re_nav_bar{
                                max-width: 1170px !Important;
                            }';
        }
        elseif(get_option('siteLayout', FALSE) == 'box')
        {
            if(get_option('boxBackground', FALSE) != '')
            {
                $bac = get_option('boxBackground', FALSE);
            }
            elseif(get_option('backgroundimageurl', false) != '')
            {
                $bac = get_option('backgroundimageurl', false);
            }
            else
            {
                $bac = '';
            }
            
            if(get_option('boxBackgrounColor', FALSE) != '')
            {
                $color = get_option('boxBackgrounColor', FALSE);
            }
            else
            {
                $color = 'FFFFFF';
            }
            
            $layoutcss .= 'body{
                                background: url('.$bac.') repeat #'.$color.';
                            }
                            #page{
                                width: 1170px;
                                margin: 60px auto;
                                box-shadow: 0 0 3px rgba(0, 0, 0, 0.5) !important;
                                background: #ffffff;
                            }
                            #page #header #re_nav_bar{
                                max-width: 1170px !Important;
                            }';
        }
        else
        {
            $layoutcss .= 'body{
                                background: #FFFFFF;
                            }';
        }
        $js_file = 'layout.css';    
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/preset/'.$js_file, stripslashes($layoutcss), FS_CHMOD_FILE)) {
            echo 'Generating CSS error!';
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=layout_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'removebackimage')
    {
        delete_option('boxBackground');
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=layout_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'removebackimageurl')
    {
        delete_option('backgroundimageurl');
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=layout_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_layout')
    {
        delete_option('boxBackground');
        delete_option('backgroundimageurl');
        delete_option('siteLayout');
        delete_option('boxBackgrounColor');
        
        $layoutcss = 'body{background: #ffffff;}';
        $js_file = 'layout.css';    
        WP_Filesystem();
        global $wp_filesystem;
        if(!$wp_filesystem->put_contents(get_template_directory().'/RMS/Framework/assets/preset/'.$js_file, stripslashes($layoutcss), FS_CHMOD_FILE)) {
            echo 'Generating CSS error!';
        }
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=layout_option';
        echo "<script>window.location= '".$url."'</script>";
    }
        
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Layout Settings
        </th>
    </tr>
    <tr>
        <td>
            <?php $siteLayout = get_option('siteLayout', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Available Layout</p>
            <select id="selectLayout" name="siteLayout">
                <option value="">Select Layout</option>
                <option value="wide" <?php if($siteLayout == 'wide') { echo 'Selected';} ?> >Full Width</option>
                <option value="semibox" <?php if($siteLayout == 'semibox') { echo 'Selected';} ?> >Box</option>
                <option value="box" <?php if($siteLayout == 'box') { echo 'Selected';} ?> >Box With Margin</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-upload"></i> Upload Image for box layout background.</p>
            <?php $boxBackground = get_option('boxBackground', FALSE); ?>
            <?php 
                if($boxBackground != ''):
                    echo '<div class="bgbox_image"><img src="'.$boxBackground.'" alt="RMS"/></div>';
                endif;
            ?>
            <div class="custom_file_upload">
                <input type="text" class="file" id="upfile" name="file_info">
                    <div class="file_upload">
                            <input type="file" id="file_upload" name="file_upload">
                    </div>
            </div>
            <div class="removebutton"><a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=layout_option&action=removebackimage'; ?>">Remove</a></div>
        </td>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-upload"></i> Or.</p>
            <?php $backgroundimageurl = get_option('backgroundimageurl', FALSE); ?>
            <input style="float: left;" class="general_input" type="text" value="<?php echo $backgroundimageurl; ?>" placeholder="http://" name="backgroundimageurl"/>
            <div class="removebutton margincase"><a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=layout_option&action=removebackimageurl'; ?>">Remove</a></div>
        </td>
    </tr>
     <tr>
        <td>
            <?php $boxBackgrounColor = get_option('boxBackgrounColor', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Insert background color HEX(#FFFFFF) code for Box layout instant of background Image. </p>
            <input class="general_input"  id="h3Color" type="text" value="<?php echo $boxBackgrounColor; ?>" placeholder="#FFFFFF" name="boxBackgrounColor"/>
        </td>
    </tr>
</table>



<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=layout_option&reset=reset_layout'; ?>">Default Options</a>
    <input type="submit" value="Save Layout Settings" name="layout_settings"/>
</div>
<div class="clear"></div>
</form>
<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};
</script>