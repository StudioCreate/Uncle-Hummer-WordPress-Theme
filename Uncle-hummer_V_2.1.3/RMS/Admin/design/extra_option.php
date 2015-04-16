<?php
    if(isset($_POST['extra_settings']) && $_POST['extra_settings'] == 'Save Extra Settings')
    {
        update_option('google_map_link', $_POST['google_map_link']);
        update_option('p_phone', $_POST['p_phone']);
        update_option('loation_info', $_POST['loation_info']);
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=extra_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_extra')
    {
        delete_option('google_map_link');
        delete_option('p_phone');
        delete_option('loation_info');
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=extra_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Extra Settings
        </th>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-map-marker"></i> Goole Mape SRC.</p>
            <textarea name="google_map_link"><?php echo get_option('google_map_link', FALSE); ?></textarea>
        </td>
    </tr>
</table>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Contact Info
        </th>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-mobile"></i> Your Personal Phone Number.</p>
            <input class="general_input" type="text" value="<?php echo get_option('p_phone', FALSE); ?>" placeholder="+011...." name="p_phone"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <p class="rmsnotic"><i class="up_icon fa fa-map-marker"></i> Location Information</p>
            <textarea name="loation_info"><?php echo get_option('loation_info', FALSE); ?></textarea>
        </td>
    </tr>
</table>
<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=extra_option&reset=reset_extra'; ?>">Default Options</a>
    <input type="submit" value="Save Extra Settings" name="extra_settings"/>
</div>
</form>