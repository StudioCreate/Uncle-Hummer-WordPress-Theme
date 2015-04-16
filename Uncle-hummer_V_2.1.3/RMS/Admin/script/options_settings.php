<?php
/**
 * RMS WordPress Framework
 *
 * Copyright (c) 2014, ThemeOnLab, s.r.o. (http://themeonlab.com)
 */
require RMS_ADMIN_DIR.'/design/optionHeader.php';

if(isset($_GET['CPart']))
{
    $cpart = $_GET['CPart'];
    switch ($cpart)
    {
        case "h_option" :
            require RMS_ADMIN_DIR.'/design/header_option.php';
            break;
        case "home_option" :
            require RMS_ADMIN_DIR.'/design/home_option.php';
            break;
		case "c_option" :
            require RMS_ADMIN_DIR.'/design/contact_option.php';
            break;
        case "f_option" :
            require RMS_ADMIN_DIR.'/design/footer_option.php';
            break;
        case  "b_option":
            require RMS_ADMIN_DIR.'/design/blog_option.php';
            break;
        case "ts_option":
            require RMS_ADMIN_DIR.'/design/typographyStyle_option.php';
            break;
        case "css_option":
            require RMS_ADMIN_DIR.'/design/css_option.php';
            break;
        case "preset_option":
            require_once RMS_ADMIN_DIR.'/design/preset_option.php';
            break;
        case "extra_option":
            require RMS_ADMIN_DIR.'/design/extra_option.php';
            break;
        case "social_option":
            require RMS_ADMIN_DIR.'/design/social_option.php';
            break;
        case "layout_option":
            require RMS_ADMIN_DIR.'/design/layout_option.php';
            break;
        case "csoon_option":
            require RMS_ADMIN_DIR.'/design/csoon_option.php';
            break;
        case "import_option":
            require RMS_ADMIN_DIR.'/design/import_option.php';
            break;
    }
}
else
{
    require_once RMS_ADMIN_DIR.'/design/general.php';
}

require RMS_ADMIN_DIR.'/design/optionFooter.php';