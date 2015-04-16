<?php
    if(isset($_POST['contact_settings']) && $_POST['contact_settings'] == 'Save Contact Settings')
    {
        $quick_title = $_POST['quick_title'];
        $quick_subtitle = $_POST['quick_subtitle'];
        $quick_subhead = $_POST['quick_subhead'];
        $formsettings = $_POST['formsettings'];
        $formsettings2 = $_POST['formsettings2'];
        $googlelat = $_POST['googlelat'];
        $googlelng = $_POST['googlelng'];
        $googlezoom = $_POST['googlezoom'];
        $googleicon = $_POST['googleicon'];
        $googlect1 = $_POST['googlect1'];
        $googlect2 = $_POST['googlect2'];
        
        
        update_option('quick_title', $quick_title);
        update_option('quick_subtitle', $quick_subtitle);
        update_option('quick_subhead', $quick_subhead);
        update_option('formsettings', $formsettings);
        update_option('formsettings2', $formsettings2);
        update_option('googlelat', $googlelat);
        update_option('googlelng', $googlelng);
        update_option('googlezoom', $googlezoom);
        update_option('googleicon', $googleicon);
        update_option('googlect1', $googlect1);
        update_option('googlect2', $googlect2);
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=c_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Quick Contact Info
        </th>
    </tr>
    <tr>
        <td>
            <?php $quick_title = get_option('quick_title', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-mobile"></i> Type Your Title Here.</p>
            <input type="text" class="general_input" name="quick_title" value="<?php echo stripslashes($quick_title); ?>"/>
        </td>
    </tr>
	<tr>
        <td>
            <?php $quick_subhead = get_option('quick_subhead', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-envelope-o"></i> Type Your Sub-Head Here.</p>
            <textarea class="general_input" name="quick_subhead"><?php echo stripslashes($quick_subhead); ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <?php $quick_subtitle = get_option('quick_subtitle', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-envelope-o"></i> Type Your Sub-Title Here.</p>
            <textarea style="min-height:200px;" class="general_input" name="quick_subtitle"><?php echo stripslashes($quick_subtitle); ?></textarea>
        </td>
    </tr>
</table>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Form Settings
        </th>
    </tr>
    <tr id="headerstylecheck">
        <td>
            <?php $formsettings = get_option('formsettings', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Contact Form 7 ID.</p>
            <textarea class="general_input" name="formsettings"><?php echo stripslashes($formsettings); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $formsettings2 = get_option('formsettings2', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Contact Form 7 Title.</p>
            <textarea class="general_input" name="formsettings2"><?php echo stripslashes($formsettings2); ?></textarea>
        </td>
    </tr>
</table>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Map Settings
        </th>
    </tr>
    <tr id="headerstylecheck">
        <td>
            <?php $googlelat = get_option('googlelat', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Lat Direction.</p>
            <textarea class="general_input" name="googlelat"><?php echo stripslashes($googlelat); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $googlelng = get_option('googlelng', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Lng Direction.</p>
            <textarea class="general_input" name="googlelng"><?php echo stripslashes($googlelng); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $googlezoom = get_option('googlezoom', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Zoom.</p>
            <textarea class="general_input" name="googlezoom"><?php echo stripslashes($googlezoom); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $googleicon = get_option('googleicon', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Custom Icon Link.</p>
            <textarea class="general_input" name="googleicon"><?php echo stripslashes($googleicon); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $googlect1 = get_option('googlect1', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Top Content.</p>
            <textarea class="general_input" name="googlect1"><?php echo stripslashes($googlect1); ?></textarea>
        </td>
    </tr>
	<tr id="headerstylecheck">
        <td>
            <?php $googlect2 = get_option('googlect2', FALSE); ?>
            <p class="rmsnotic"><i class="fa fa-indent"></i> Insert Google Map Content.</p>
            <textarea class="general_input" name="googlect2"><?php echo stripslashes($googlect2); ?></textarea>
        </td>
    </tr>
</table>
<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=c_option&reset=reset_general'; ?>">Default Options</a>
    <input type="submit" value="Save Contact Settings" name="contact_settings"/>
</div>
</form>

<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};

</script>