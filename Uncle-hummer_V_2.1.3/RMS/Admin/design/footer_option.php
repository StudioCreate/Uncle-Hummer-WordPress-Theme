<?php
    if(isset($_POST['footer_settings']) && $_POST['footer_settings'] == 'Save Footer Settings')
    {
        $footer_address = $_POST['footer_address'];
        $footerSocial = $_POST['footerSocial'];
        $footerCopy = $_POST['footerCopy'];
        $footerHeadin = $_POST['footerHeadin'];
        $footermenu = $_POST['footermenu'];
        update_option('footer_address', $footer_address);
        update_option('footerSocial', $footerSocial);
        update_option('footerCopy', $footerCopy);
        update_option('footerHeadin', $footerHeadin);
        update_option('footermenu', $footermenu);
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=f_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<tr>
			<th>
				Footer
			</th>
		</tr>
		<tr>
			<td>
				<?php 
					$footer_address = get_option('footer_address', FALSE); 
					$footerSocial = get_option('footerSocial', FALSE);
					$footerCopy = get_option('footerCopy', FALSE);
					$footermenu = get_option('footermenu', FALSE);
				?>
				<p class="rmsnotic"><i class="up_icon fa fa-indent"></i>Insert Your Credit with link.</p>
				<textarea style="height: 150px;" name="footer_address"><?php echo stripslashes($footer_address); ?></textarea>
				<div class="clear"></div>
			</td>
		</tr>
		<tr>
			<td>
				<p class="rmsnotic"><i class="up_icon fa fa-indent"></i>Insert Copy Right Text.</p>
				<textarea style="height: 150px;" name="footerCopy"><?php echo stripslashes($footerCopy); ?></textarea>
			</td>
		</tr>
	</table>
	<div class="submit_area">
		<input type="submit" value="Save Footer Settings" name="footer_settings"/>
	</div>
</form>

    
