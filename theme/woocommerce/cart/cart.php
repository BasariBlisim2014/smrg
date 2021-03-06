<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if (get_option('catalog_mode') == 'on') return;

wc_print_notices();

?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<div class="product-cart-wrap">

	<form class="row-fluid" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

	<div class="span9">

	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table cart" cellspacing="0">
		<thead>
			<tr>
				<th class="product-name"><?php _e( 'Ürün Tanımı', 'woocommerce' ); ?></th>
				<th class="product-price"><?php _e( 'Fiyat', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php _e( 'Adet', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php _e( 'ara toplam', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			if ( sizeof(  WC()->cart->get_cart() ) > 0 ) {
				foreach (  WC()->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
					
					if ( $_product->exists() && $values['quantity'] > 0 ) {
						?>
						<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
							
							<!-- Item Description -->
							<td class="item-description">

								<div class="product-details">

									<?php
										
										if(isset($values['fpd_data']['fpd_product_image'])){
											
											echo '<div class="thumb-wrapper">';
											echo '<a href="#">';
										    echo '<img class="woocommerce-placeholder wp-post-image" width="200" height="220" alt="Placeholder" src="'.get_site_url().'/frame_images/'.$values['fpd_data']['fpd_product_image'].'.png">';
											echo "</a>";
											echo '</div>';
										}
										else
										{
										$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

										if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) ) {
											echo '<div class="thumb-wrapper">';
											echo $thumbnail;
											echo '</div>'; }
										else {
											echo '<div class="thumb-wrapper">';
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
											echo '</div>'; }
										}
										
									?>
								
									<div class="title-wrap">

									<?php
										if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

		                   				// Backorder notification
		                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
		                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
									?>

									<?php // Meta data
									echo WC()->cart->get_item_data( $values );
									?>

									</div>

									<?php
										echo '<div class="remove-wrap">';
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon"></span>kaldır</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
										echo '</div>';
									?>
								
								</div>

							</td>

							<!-- Product price -->
							<td class="product-price">
								<?php
									$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

									echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
								?>
							</td>

							<!-- Quantity inputs -->
							<td class="product-quantity">

								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {

										$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
										$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
										$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

										$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
								?>

							</td>

							<!-- Product subtotal -->
							<td class="product-subtotal">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
								?>
							</td>

						</tr>
						<?php
					}
				}
			}

			do_action( 'woocommerce_cart_contents' );
			?>
			<tr>
				<td colspan="6" class="actions">

					<?php if ( WC()->cart->coupons_enabled() ) { ?>
						<div class="coupon">

							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'kupon kodu', 'woocommerce' ); ?>" /> <input type="submit" class="button coupon-submit" name="apply_coupon" value="<?php _e( 'kuponu kullan', 'woocommerce' ); ?>" />

							<?php do_action('woocommerce_cart_coupon'); ?>

							<?php 
							$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
							if ($shop_page_url) {
								echo '<a class="pt-light-button go-shop" rel="bookmark" href="' . $shop_page_url . '">' . __('alışverişe devam et', 'plumtree') . '</a>';
							}?>

						</div>
					<?php } ?>
					
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>

	</div>

	<div class="cart-totals span3">
		<?php woocommerce_cart_totals(); ?>
		<input type="submit" class="button update" name="update_cart" value="<?php _e( 'sepeti güncelle', 'woocommerce' ); ?>" />
		<input type="submit" class="checkout-button wc-forward button alt" name="proceed" value="<?php _e( 'alışverişi tamamla', 'woocommerce' ); ?>" />
		<?php  do_action('woocommerce_proceed_to_checkout'); ?>
	</div>
	
	<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	
	</form>

	<div class="row-fluid">
		<div class="cart-collaterals span6">
			<?php do_action('woocommerce_cart_collaterals'); ?>
			<?php woocommerce_shipping_calculator(); ?>
		</div>

		<?php if ( is_active_sidebar( 'cart-widgets' ) ) : ?>
			<div id="sidebar-cart" class="widget-area cart-sidebar span6" role="complementary">
				<div class="row-fluid">
				<?php dynamic_sidebar( 'cart-widgets' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
