<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<?php
$price = number_format(get_post_meta( get_the_ID(), '_regular_price', true), 2, '.', '');
$ida = get_post_thumbnail_id( get_the_ID() );
if(has_post_thumbnail())
{
	$thumgSmallr = get_the_post_thumbnail(get_the_ID(), 'product_related');
}
else
{
	$thumgSmallr = '<img alt="" src="http://placehold.it/360x260" alt="ThemeOnLab"/>';
}
?>

	<li <?php post_class( $classes ); ?> style="margin-right: 8px; width: auto;">

		<div class="four columns places" style="margin-left: 0px;">
			<div class="portfolio-thumb">
				<a class="popup" href="<?php echo wp_get_attachment_url($ida); ?>">
					<div>
						<?php echo $thumgSmallr; ?>
						<div class="overlay">
							<p><img src="<?php echo get_template_directory_uri(); ?>/images/quick-view.png" alt="" /><span>quick view</span></p>
						</div>
					</div>
					<b><?php the_title(); ?></b>
					<p class="price"><?php echo get_woocommerce_currency_symbol(); ?><?php echo $price; ?></p>
				</a>
				<span  class="add-to-cart"><?php echo do_shortcode('[add_to_cart id="'.get_the_ID().'"]'); ?></span>
			</div>
		</div>
	</li>