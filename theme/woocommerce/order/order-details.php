<?php
ob_flush();
ob_clean();
session_start();
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order( $order_id );
?>
			<?php 
			$only_quote=0;
			foreach( $order->get_items() as $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );
				
							if(isset($item_meta->meta['fpd_data']))
							{
								$fpd_data=unserialize($item_meta->meta['fpd_data'][0]);
							
								if(isset($fpd_data) && !empty($fpd_data))
								{	
									$product_img=$fpd_data['fpd_product_image'];
								}	
								if(isset($fpd_data) && !empty($fpd_data))
								{	
									$only_quote=$fpd_data['fpd_only_quote'];
								}	
							}
	}
	if($only_quote==1){?>
		<h2><?php _e( 'Thank You For Quote Request we will Contact you soon.', 'woocommerce' ); ?></h2>
		<a href="http://simurg.projetest.info/shop/uncategorized/new-fancy-product"><?php _e( 'Return back');?></a>
		
	<?php }else{
?>

<h2 class="pt-content-title"><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
<table class="shop_table order_details">
	
	<tbody>
		<?php
		if ( sizeof( $order->get_items() ) > 0 ) {

			foreach( $order->get_items() as $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="product-name">
					<?php
							$product_img="";
							$only_quote=0;
							
							if(isset($item_meta->meta['fpd_data']))
							{
								$fpd_data=unserialize($item_meta->meta['fpd_data'][0]);
							
								if(isset($fpd_data) && !empty($fpd_data))
								{	
									$product_img=$fpd_data['fpd_product_image'];
								}	
								if(isset($fpd_data) && !empty($fpd_data))
								{	
									$only_quote=$fpd_data['fpd_only_quote'];
								}	
							}
							
							?>
						<?php
							
							if ( $_product && ! $_product->is_visible() )
							{
								echo "test";
								echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
							}
							else if($product_img!="")
							{	
								echo "test12";
								echo '<a id="inline" href="#data_'.$_product->id.'">'.$item['name'].'</a>';
							}
							else
							{
								echo sprintf( '<a href="#" id="inline" href="#data_'.$_product->id.'">%s</a>', $item['name'] );
							}
							echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

							$item_meta->display();

							if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

								$download_files = $order->get_item_downloads( $item );
								$i              = 0;
								$links          = array();

								foreach ( $download_files as $download_id => $file ) {
									$i++;

									$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
								}

								echo '<br/>' . implode( '<br/>', $links );
							}
						?>
							<?php if(isset($product_img) && $product_img!=""){?>
						<div style="display:none"><div id="data_<?php echo $_product->id;?>"><img src="<?php echo get_site_url();?>/frame_images/<?php echo $product_img;?>.png" alt=""/></div></div>
						<?php }?>
					</td>
					<td class="product-total">
					<?php if($only_quote!=1){?>
						<?php echo $order->get_formatted_line_subtotal( $item ); ?>
					<?php }?>
					</td>
				</tr>
				<?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
					<tr class="product-purchase-note">
						<td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total">
			<?php if($only_quote!=1){?>
			<?php _e( 'Total', 'woocommerce' ); ?>
			<?php }?></th>
		</tr>
	</thead>
	<?php if($only_quote!=1){?>
	<tfoot>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?>
			<tr>
				<th scope="row"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tfoot>
	<?php }?>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<header>
	<h2 class="pt-content-title"><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
</header>
<dl class="customer_details">
<?php
	if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'woocommerce' ) . '</dt><dd>' . $order->billing_email . '</dd>';
	if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'woocommerce' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

	// Additional customer details hook
	do_action( 'woocommerce_order_details_after_customer_details', $order );
?>
</dl>

<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

<div class="col2-set addresses">

	<div class="col-1">

<?php endif; ?>

		<header class="title">
			<h3 class="pt-content-title"><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-2">

		<header class="title">
			<h3 class="pt-content-title"><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>
<?php }?>
<div class="clear"></div>
<script language="javascript">
jQuery(document).ready(function($){
$("a#inline").fancybox({
	'hideOnContentClick': true
});
					
});	
						
</script>
