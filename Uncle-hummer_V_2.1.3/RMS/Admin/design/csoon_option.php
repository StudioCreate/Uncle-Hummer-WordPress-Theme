<?php
    if(isset($_POST['csoon_settings']) && $_POST['csoon_settings'] == 'Save Settings')
    {
       
        
        update_option('starttimestamp', $_POST['starttimestamp']);
        update_option('endtimestamp', $_POST['endtimestamp']);
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=csoon_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_csoon')
    {
        delete_option('starttimestamp');
        delete_option('endtimestamp');
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=csoon_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">

<table class="wp-list-table widefat fixed posts social_table" cellspacing="0">
    <tr>
        <th>
            Time Settings
        </th>
    </tr>
    <tr>
        <td>
            <?php $starttimestamp = get_option('starttimestamp', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-clock-o"></i> <b>Start time stamp</b></p>
            <input type="text" name="starttimestamp"  value="<?php echo $starttimestamp; ?>" placeholder="" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $endtimestamp = get_option('endtimestamp', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa fa-clock-o"></i> <b>End Time Stamp</b></p>
            <input type="text" name="endtimestamp" value="<?php echo $endtimestamp; ?>" placeholder="" class="general_input" />
        </td>
    </tr>
    
</table>

<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=csoon_option&reset=reset_csoon'; ?>">Default Options</a>
    <input type="submit" value="Save Settings" name="csoon_settings"/>
</div>
<div class="clear"></div>
</form>