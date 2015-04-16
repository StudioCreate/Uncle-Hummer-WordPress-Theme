<div class="option-header">
    <div class="clear"></div>
    <h1><a href="#">Theme Options</a></h1>
    <p>You are welcome into <b style="color: #ffd824; font-weight: 600;">UNCLE-HUMMER</b> Option page. </p>
    <div class="clear"></div>
</div>
<div class="main_option_area">
    <div class="option_left_nav">
        <?php
            $url = admin_url();
            if(isset($_GET['CPart'])):
                $cpart1 = $_GET['CPart'];
                if($cpart1 == ''):
                    $home_class = 'actve';
                elseif($cpart1 == 'h_option'):
                    $home_class1 = 'actve';
                elseif($cpart1 == 'home_option'):
                    $home_class2 = 'actve';
                elseif($cpart1 == 'f_option'):
                    $home_class3 = 'actve';
                elseif($cpart1 == 'b_option'):
                    $home_class4 = 'actve';
                elseif($cpart1 == 'ts_option'):
                    $home_class5 = 'actve';
                elseif( $cpart1 == "css_option"):
                    $home_class6 = 'actve';
                elseif( $cpart1 == "extra_option"):
                    $home_class7 = 'actve';
                elseif($cpart1 == 'preset_option'):
                    $home_class8 = 'actve';
                elseif($cpart1 == 'social_option'):
                    $home_class9 = 'actve';
                elseif($cpart1 == 'layout_option'):
                    $home_class10 = 'actve';
                elseif($cpart1 == 'csoon_option'):
                    $home_class11 = 'actve';
                elseif($cpart1 == 'import_option'):
                    $home_class12 = 'actve';
				elseif($cpart1 == 'c_option'):
                    $home_class13 = 'actve';
                endif;
            else:
                    $home_class = 'actve';
            endif;
        ?>
        <ul>
            <li class="<?php echo $home_class; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option';?>"><i class="fa fa-cogs"></i>General Settings</a></li>
            <li class="<?php echo $home_class1; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=h_option';?>"><i class="fa fa-header"></i>Header Settings</a></li>
            <li class="<?php echo $home_class2; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=home_option';?>"><i class="fa fa-home"></i>Home Option</a></li>
			<li class="<?php echo $home_class13; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=c_option';?>"><i class="fa fa-tasks"></i>Contact Settings</a></li>
            <li class="<?php echo $home_class3; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=f_option';?>"><i class="fa fa-tasks"></i>Footer Settings</a></li>
            <li class="<?php echo $home_class4; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=b_option';?>"><i class="fa fa-columns"></i>Blog Settings</a></li>			
            <li class="<?php echo $home_class5; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=ts_option';?>"><i class="fa fa fa-th"></i>Typography &AMP; Style</a></li>			
            <li class="<?php echo $home_class6; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=css_option';?>"><i class="fa fa-pencil-square-o"></i>Custom CSS</a></li>
            <li class="<?php echo $home_class8; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=preset_option';?>"><i class="fa fa-building-o"></i>Color Preset</a></li>
            <li class="<?php echo $home_class9; ?>"><a href="<?php echo $url .'themes.php?page=rms_theme_option&CPart=social_option';?>"><i class="fa fa-share-alt"></i>Social Settings</a></li>
        </ul>
    </div>
    <div class="right_option_details">
    
