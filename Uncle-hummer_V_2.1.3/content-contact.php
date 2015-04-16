<?php
/**
 * The template used for displaying contact section
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>

<section id="contact" class="contact">
    <div class="row">
        <div class="ten columns center">

            <?php
            $ctitle = get_option('quick_title', FALSE);
            $cshead = get_option('quick_subhead', FALSE);
            $cstitle = get_option('quick_subtitle', FALSE);
            ?>
            <!-- The title -->
            <div class="title">
                <?php if ($ctitle != '') { ?>
                    <h1><?php echo $ctitle; ?></h1>
                <?php } else { ?>
                    <h1>Contact</h1>
                <?php } ?>
                <hr>
            </div>


            <!-- Intro text -->
            <?php if ($cshead != '') { ?>
                <h2 class="text-dark text-subtitle"><?php echo $cshead; ?></h2>
            <?php } else { ?>
                <h2 class="text-dark text-subtitle">Let's get in touch</h2>
            <?php } ?>
            <br/>
            <?php if ($cstitle != '') { ?>
                <p class="big thin"><?php echo $cstitle; ?></p>
            <?php } else { ?>
                <p class="big thin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ornare sem sit amet mauris bibendum, ac fringilla quam eleifend. Praesent elit tellus, venenatis in lorem ac, porta accumsan sapien. Cras malesuada feugiat .</p>
            <?php } ?>

        </div>
    </div>
    <div class="row">
        <!-- Succes message after sending the form, see also the php file around line 90 -->
        <div class="twelve columns">
            <div id="message"></div>
        </div>
    </div>
    <div class="row">
        <?php
        $cform = get_option('formsettings', FALSE);
        $cform2 = get_option('formsettings2', FALSE);
        ?>
        <?php echo do_shortcode('[contact-form-7 id="' . $cform . '" title="' . $cform2 . '"]'); ?>
    </div>
</section>