<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Roerder
 * @subpackage Roerder
 * @since Roerder 1.0
 */
?>	<!-- Contact -->


	<?php 
		$glat = get_option('googlelat', FALSE);
		$glng = get_option('googlelng', FALSE);
		$gzoom = get_option('googlezoom', FALSE);
		$gicon = get_option('googleicon', FALSE);
		$gct1 = get_option('googlect1', FALSE);
		$gct2 = get_option('googlect2', FALSE);
	?>
	<?php echo do_shortcode( '[rms-googlemap lat="'.$glat.'" lng="'.$glng.'" icon="'.$gicon.'" zoom="'.$gzoom.'" contents="'.$gct1.'" contents2="'.$gct2.'"]' ); ?>
	
	
	<!-- The footer -->
	<section class="footer-two">
		<h2 class="empty">RMS</h2>
		<div class="row">
			<div class="twelve columns">
				<!-- Back to top button -->
				<p class="back-to-top"><a href="#home" class="smoothscroll"><i class="fa fa-chevron-up icon arrow-top"></i></a></p>
				<?php
					$h = get_option('footerHeadin', FALSE);
					$a = get_option('footer_address', FALSE);
					$s = get_option('footerSocial', FALSE);
					$c = get_option('footerCopy', FALSE);
					$fm = get_option('footermenu', FALSE);
				?>
				<!-- Social icons -->
				<p class="footer_social">
					<?php if(get_option('googlePlus', FALSE) != ''): ?>
					<a href="<?php echo get_option('googlePlus', FALSE); ?>"><i class="fa fa-google-plus icon outline light google"></i></a>
					<?php endif;?>
					<?php if(get_option('skype', FALSE) != ''): ?>
                    <a href="<?php echo get_option('skype', FALSE); ?>"><i class="fa fa-skype icon outline light skype"></i></a>
					<?php endif;?>
					<?php if(get_option('youtube', FALSE) != ''): ?>
                    <a href="<?php echo get_option('youtube', FALSE); ?>"><i class="fa fa-youtube icon outline light youtube"></i></a>   
					<?php endif;?>
					<?php if(get_option('twitter', FALSE) != ''): ?>
                    <a href="<?php echo get_option('twitter', FALSE); ?>"><i class="fa fa-twitter icon outline light twitter"></i></a>
					<?php endif;?>
					<?php if(get_option('facebook', FALSE) != ''): ?>
					<a href="<?php echo get_option('facebook', FALSE); ?>"><i class="fa fa-facebook icon outline light facebook"></i></a>
					<?php endif;?>
					<?php if(get_option('linkedin', FALSE) != ''): ?>
					<a href="<?php echo get_option('linkedin', FALSE); ?>"><i class="fa fa-linkedin icon outline light linkedin"></i></a>
					<?php endif;?>
				</p>
				<!-- Credits -->
				<p class="text-dark">
                <?php echo stripslashes($a); ?>
                <br>
                <?php echo stripslashes($c); ?></p>
			</div>
		</div>
	</section> 
<?php wp_footer(); ?>
</body>
</html>
