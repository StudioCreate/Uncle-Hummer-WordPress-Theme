<?php
    if(isset($_POST['blog_settings']) && $_POST['blog_settings'] == 'Save Blog Settings')
    {
        $sidebarPosition    = $_POST['sidebarPosition'];
        $blogpagetitle    = $_POST['blogpagetitle'];
        //$socialBlog         = $_POST['socialBlog'];
        $singlePostPageTemplate = $_POST['singlePostPageTemplate'];
        update_option('blogpagetitle', $blogpagetitle);
        update_option('sidebarPosition', $sidebarPosition);
        //update_option('socialBlog', $socialBlog);
        update_option('singlePostPageTemplate', $singlePostPageTemplate);
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=b_option';
        echo "<script>window.location= '".$url."'</script>";
    }
   
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_general')
    {
        delete_option('blogpagetitle');
        delete_option('sidebarPosition');
        //delete_option('socialBlog');
        delete_option('singlePostPageTemplate');		
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=b_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<tr>
			<th>
				Blog Settings
			</th>
		</tr>
		<tr>
			<td>
				<?php $blogpagetitle = get_option('blogpagetitle', FALSE); ?>
				<p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Insert Blog Page Title </p>
				<input type="text" name="blogpagetitle" class="general_input" value="<?php echo $blogpagetitle; ?>" placeholder="Deep Ocean Blog">
			</td>
		</tr>
	</table>	<table class="wp-list-table widefat fixed posts" cellspacing="0">		<tr>			<td>				<?php $bppt = get_option('sidebarPosition', FALSE); ?>				<p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Select Template For Blog Page.</p>				<select id="selectLayoutSingel" name="sidebarPosition">					<option value="">Select Template</option>					<option value="leftSidebar" <?php if($bppt == 'leftSidebar') { echo 'Selected';} ?> >Left Side Bar</option>					<option value="rightSidebar" <?php if($bppt == 'rightSidebar') { echo 'Selected';} ?> >Right Side Bar</option>					<option value="noSidebar" <?php if($bppt == 'noSidebar') { echo 'Selected';} ?> >No Side Bar</option>				</select>			</td>		</tr>	</table>
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<tr>
			<td>
				<?php $sppt = get_option('singlePostPageTemplate', FALSE); ?>
				<p class="rmsnotic"><i class="up_icon fa fa-indent"></i> Select Template For Single Post.</p>
				<select id="selectLayoutSingel" name="singlePostPageTemplate">
					<option value="">Select Template</option>
					<option value="leftSidebar" <?php if($sppt == 'leftSidebar') { echo 'Selected';} ?> >Left Side Bar</option>
					<option value="rightSidebar" <?php if($sppt == 'rightSidebar') { echo 'Selected';} ?> >Right Side Bar</option>
					<option value="noSidebar" <?php if($sppt == 'noSidebar') { echo 'Selected';} ?> >No Side Bar</option>
				</select>
			</td>
		</tr>
	</table>
	<div class="submit_area">
		<a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=b_option&reset=reset_general'; ?>">Default Options</a>
		<input type="submit" value="Save Blog Settings" name="blog_settings"/>
	</div>
</form>