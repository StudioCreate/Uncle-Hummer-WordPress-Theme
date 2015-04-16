<?php
    if(isset($_POST['social_settings']) && $_POST['social_settings'] == 'Save Social Settings')
    {
        
        $facebook = $_POST['facebook'];
        $googlePlus = $_POST['googlePlus'];
        $flicker = $_POST['flicker'];
        $vimeo = $_POST['vimeo'];
        $linkedin = $_POST['linkedin'];
        $twitter = $_POST['twitter'];
        
        
//        update_option('twitterUserName', $_POST['twitterUserName']);
//        update_option('consumerKey', $_POST['consumerKey']);
//        update_option('consumerSecret', $_POST['consumerSecret']);
        
        
        update_option('facebook', $facebook);
        update_option('googlePlus', $googlePlus);
        update_option('flicker', $flicker);
        update_option('vimeo', $vimeo);
        update_option('linkedin', $linkedin);
        update_option('twitter', $twitter);
        
        update_option('pinterest', $_POST['pinterest']);
        update_option('youtube', $_POST['youtube']);
        update_option('behance', $_POST['behance']);
        update_option('bitbucket', $_POST['bitbucket']);
        update_option('dribbble', $_POST['dribbble']);
        update_option('dropbox', $_POST['dropbox']);
        update_option('git', $_POST['git']);
        update_option('instagram', $_POST['instagram']);
        update_option('skype', $_POST['skype']);
        update_option('weibo', $_POST['weibo']);
        update_option('pagelines', $_POST['pagelines']);
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=social_option';
        echo "<script>window.location= '".$url."'</script>";
    }
    
    if(isset($_GET['reset']) && $_GET['reset'] == 'reset_social')
    {
        delete_option('facebook');
        delete_option('googlePlus');
        delete_option('flicker');
        delete_option('vimeo');
        delete_option('linkedin');
        delete_option('twitter');
        
        delete_option('pinterest');
        delete_option('youtube');
        delete_option('behance');
        delete_option('bitbucket');
        delete_option('dribbble');
        delete_option('dropbox');
        delete_option('git');
        delete_option('instagram');
        delete_option('skype');
        delete_option('weibo');
        delete_option('pagelines');
        
        
        $url = admin_url().'themes.php?page=rms_theme_option&CPart=social_option';
        echo "<script>window.location= '".$url."'</script>";
    }
?>
<form method="post" name="general" enctype="multipart/form-data" action="">

<table class="wp-list-table widefat fixed posts social_table" cellspacing="0">
    <tr>
        <th>
            Social Settings
        </th>
    </tr>
    <tr>
        <td>
            <?php $facebook = get_option('facebook', FALSE); ?>
            <p class="rmsnotic facebook"><i class="up_icon fa fa-facebook-square"></i> <b>Facebook</b></p>
            <input type="text" name="facebook"  value="<?php echo $facebook; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $twitter = get_option('twitter', FALSE); ?>
            <p class="rmsnotic twitter"><i class="up_icon fa fa-twitter-square"></i> <b>Twitter</b></p>
            <input type="text" name="twitter" value="<?php echo $twitter; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $googlePlus = get_option('googlePlus', FALSE); ?>
            <p class="rmsnotic googlePlus"><i class="up_icon fa fa-google-plus-square"></i> <b>Google Plus</b></p>
            <input type="text" name="googlePlus" value="<?php echo $googlePlus; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $pinterest = get_option('pinterest', FALSE); ?>
            <p class="rmsnotic pinterest"><i class="up_icon fa fa-pinterest-square"></i> <b>Pinterest</b></p>
            <input type="text" name="pinterest" value="<?php echo $pinterest; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $youtube = get_option('youtube', FALSE); ?>
            <p class="rmsnotic youtube"><i class="up_icon fa fa-youtube-square"></i> <b>Youtube</b></p>
            <input type="text" name="youtube" value="<?php echo $youtube; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $flicker = get_option('flicker', FALSE); ?>
            <p class="rmsnotic flicker"><i class="up_icon fa fa-flickr"></i> <b>Flicker</b></p>
            <input type="text" name="flicker" value="<?php echo $flicker; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $vimeo = get_option('vimeo', FALSE); ?>
            <p class="rmsnotic vimeo"><i class="up_icon fa fa-vimeo-square"></i> <b>Vimeo</b></p>
            <input type="text" name="vimeo" value="<?php echo $vimeo; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $linkedin = get_option('linkedin', FALSE); ?>
            <p class="rmsnotic linkedin"><i class="up_icon fa fa-linkedin-square"></i> <b>LinkdIn</b></p>
            <input type="text" name="linkedin" value="<?php echo $linkedin; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    
    <tr>
        <td>
            <?php $behance = get_option('behance', FALSE); ?>
            <p class="rmsnotic behance"><i class="up_icon fa fa-behance-square"></i> <b>Behance</b></p>
            <input type="text" name="behance" value="<?php echo $behance; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $bitbucket = get_option('bitbucket', FALSE); ?>
            <p class="rmsnotic bitbucket"><i class="up_icon fa fa-bitbucket-square"></i> <b>Bitbucket</b></p>
            <input type="text" name="bitbucket" value="<?php echo $bitbucket; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $dribbble = get_option('dribbble', FALSE); ?>
            <p class="rmsnotic dribbble"><i class="up_icon fa fa-dribbble"></i> <b>Dribbble</b></p>
            <input type="text" name="dribbble" value="<?php echo $dribbble; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $dropbox = get_option('dropbox', FALSE); ?>
            <p class="rmsnotic Dropbox"><i class="up_icon fa fa-dropbox"></i> <b>Dropbox</b></p>
            <input type="text" name="dropbox" value="<?php echo $dropbox; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $git = get_option('git', FALSE); ?>
            <p class="rmsnotic git"><i class="up_icon fa fa-github-square"></i> <b>Git Hub</b></p>
            <input type="text" name="git" value="<?php echo $git; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $instagram = get_option('instagram', FALSE); ?>
            <p class="rmsnotic instagram"><i class="up_icon fa fa-instagram"></i> <b>Instagram</b></p>
            <input type="text" name="instagram" value="<?php echo $instagram; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $pagelines = get_option('pagelines', FALSE); ?>
            <p class="rmsnotic pagelines"><i class="up_icon fa fa-pagelines"></i> <b>Pagelines</b></p>
            <input type="text" name="pagelines" value="<?php echo $pagelines; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $skype = get_option('skype', FALSE); ?>
            <p class="rmsnotic skype"><i class="up_icon fa fa-skype"></i> <b>Skype</b></p>
            <input type="text" name="skype" value="<?php echo $skype; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $weibo = get_option('weibo', FALSE); ?>
            <p class="rmsnotic weibo"><i class="up_icon fa fa-weibo"></i> <b>Weibo</b></p>
            <input type="text" name="weibo" value="<?php echo $weibo; ?>" placeholder="http://" class="general_input" />
        </td>
    </tr>
</table>
<!--<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <tr>
        <th>
            Twitter API Setup
        </th>
    </tr>
    <tr>
        <td>
            <?php $twitterUserName = get_option('twitterUserName', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> <b>Twitter Username</b></p>
            <input type="text" name="twitterUserName" value="<?php echo $twitterUserName; ?>" placeholder="" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $consumerKey = get_option('consumerKey', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> <b>Consumer Key</b></p>
            <input type="text" name="consumerKey" value="<?php echo $consumerKey; ?>" placeholder="" class="general_input" />
        </td>
    </tr>
    <tr>
        <td>
            <?php $consumerSecret = get_option('consumerSecret', FALSE); ?>
            <p class="rmsnotic"><i class="up_icon fa fa-indent"></i> <b>Consumer Secret</b></p>
            <input type="text" name="consumerSecret" value="<?php echo $consumerSecret; ?>" placeholder="" class="general_input" />
        </td>
    </tr>
</table>-->
<div class="submit_area">
    <a href="<?php echo admin_url().'themes.php?page=rms_theme_option&CPart=social_option&reset=reset_social'; ?>">Default Options</a>
    <input type="submit" value="Save Social Settings" name="social_settings"/>
</div>
<div class="clear"></div>
</form>
<script type="text/javascript">
    document.getElementById("file_upload").onchange = function () {
    document.getElementById("upfile").value = this.value;
};
</script>