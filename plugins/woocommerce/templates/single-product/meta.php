<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

$post_meta=get_post_meta(get_the_ID());

$delivery_days=(isset($post_meta['_delivery_days']) && !empty($post_meta['_delivery_days']))?$post_meta['_delivery_days'][0]:'5';
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'Product Code:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>
	<!-- for image size-->
	<!--<span class="size_wrapper"><b><?php _e( 'Image Size:', 'woocommerce' ); ?> <span class="size"><?php echo $img_width.'cm X '.$img_height.'cm'?></span>.</b></span>-->

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Categories:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

	<span class="sku_wrapper" style="color:#4C4C53;"><b><?php _e("your order will be delivered in approximately","woocommerce");?> <?php echo $delivery_days;?> <?php _e('days','woocommerce');?>.</b></span>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
	
</div>