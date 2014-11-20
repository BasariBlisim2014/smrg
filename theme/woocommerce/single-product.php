<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( Fancy_Product_Designer::is_fancy_product($post->ID) ) { 
// get_header('shop');
  wp_head(); 
  
 ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/jquery-ui.css">
<script src="<?php bloginfo('template_directory');?>/js/jquery-1.10.2.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery-ui.js"></script>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css">
 
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
 <script>
$(document).ready(function() {
$( "#tabs" ).tabs();
$( "#canvas_subtabs" ).tabs();
$( "#innertabs" ).tabs();

$(".passpartoo_paper").click(function(){
	$(".pattern_stroke").hide();
});


$("#inline").click(function(){
	$(".check_cat").trigger("change");
});

$("#img_inline").click(function(){
	$(".check_cat_img").trigger("change");
});

$("#passpart_inline").click(function(){
	$(".check_cat_passpart").trigger("change");
});

$(".row-1").hover(function(){
		//$("#fp-aynas").animate({width: 'toggle'});
		$("#fp-aynas").show('slide', {direction: 'right'});
	},function(){
		$("#fp-aynas").hide('slide', {direction: 'right'});
});
$(".row-2").hover(function(){
		//$("#fp-aynas").animate({width: 'toggle'});
		$("#fp-digital").show('slide', {direction: 'right'});
	},function(){
		$("#fp-digital").hide('slide', {direction: 'right'});
});
});
		jQuery(document).ready(function(){
			jQuery('.option-inactive').click(function() {
					jQuery(".theme-option").animate({width: 'toggle'});
				});
				jQuery('.option-inactive_right').click(function() {
					jQuery(".theme-option_right").animate({width: 'toggle'});

				});
		});
		
</script>

 <?php
	
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action('woocommerce_before_main_content');
		
		global $woocommerce, $product;
	?>
<div  class="main_div">    
<div id="ajax_loading" style="display:none"><img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" /></div> 
<div class="theme-option">	
<div id="le_left">

<div id="tabs">

<ul>
<li class="current"><a href="#tabs-1" for='resim'><?php _e('Images','plumtree');?></a></li>
<li class="le_tabs"><a href="#tabs-2" for='çerçeve'><?php _e('Frames','plumtree');?></a></li>
<!--<li class="le_tabs passpartoo_paper" style="display:none;"><a href="#tabs-3">Paspartu</a></li>-->
<li class="le_tabs plastic_type"><a href="#tabs-4" style="font-size: 14px;padding: 4px 2px;"><?php _e('Paspartoo','plumtree');?></a></li>
</ul>
<div class="fpd-designs" id="tabs-1">
	<a id="img_inline" href="#img_data"><?php _e('View Images','plumtree');?></a>
	<ul class="fpd-clearfix" id="fp-images" style="overflow:scroll;height:600px;"></ul>
</div>
<div class="fpd-frames" id="tabs-2" style="height:710px;">
	<span style=" display: block;padding: 15px;text-align: center;"><a href="#" id="removeFrame"><?php _e('Remove Frames','plumtree');?></a></span>
	<!--Çerçeveleri Kaldır-->
	<a id="inline" href="#data"><?php _e('Select Frames','plumtree');?></a>
	<!--Çerçeveleri Seç-->
	<ul class="fpd-clearfix" id="fp-frame" style="overflow:scroll; height: 575px;"></ul>
</div>
<!-------------------------------------only for poster type------------------------------->
<div id="tabs-3">
<!--<div class="fpd-passepartout">
			<table>
				<tr><td><input type="radio" name="patern" class="pattern" value="canvas" checked="checked" tabval="canvas" id="paper"/>kağıt</td>
				<td><input type="radio" name="patern" class="pattern" value="pattern" tabval="pattern" id="plastic" style="margin-left:20px;"/>Plastik/Ahşap</td>
				</tr>
				<tr><td colspan="2"><span ><a href="#" id="removePasspart">Paspartuları Kaldır</a></span></td>
				</tr>
			</table>
			<hr  style="margin-top:15px;"/>
			<div id="innertabs" class="canvas_type">
			  <!--<ul id="subtabs">
				<li><a href="#intab-1">renk1</a></li>
				<li><a href="#intab-2">renk2</a></li>
			  </ul>-->
			  <!--<div id="intab-1">
				<table class="table" id="passpart_table">
				
				<tr>
					<td><input type="hidden" name="passpart_color_img" id="passpart_color_img" class="passpart_color" value="" readonly="readonly"/></td>
				</tr>
				<tr>
				
					<td style="vertical-align:top"> Paspartular Genişliği : <select id="width_selector_img">
							<?php for($i=1;$i<=15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
				
					<td style="vertical-align:top"> Paspartular Yüksekliği: <select id="height_selector_img">
							<?php for($i=1;$i<=15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
						<td>
						<input type="button" name="passpartadd" id="passpart_img_add"  value="ekle" />
						</td>	
				</tr>
			</table>
			<span id="passpart_msg" style="display:none;color:#FF0000;"> Inner Passpartoo can not be applied because your image size is more then 120 X 80 Cm</span>
				
			  </div>-->
			<!--</div>-->
			
			
			
		</div>

<!------------------------------------ only for canvas type------------------------------->
<div id="tabs-4">
	<div class="fpd-passpartoo">
		<ul class="fpd-clearfix" id="fp-paspartoo" style="overflow:scroll;"></ul>
	</div>
<div class="fpd-passepartout">
	<div class="pattern_list" style="display:block;">
			<span style=" display: block;padding: 15px;text-align: center;"><a href="#" id="removePasspart"><?php _e('Remove Paspartoo','plumtree');?></a></span>
		
			<div id="canvas_subtabs">
			<a id="patern_passpart_inline" class="passpart_inline" href="#patern_passpart_data"><?php _e('Select Paspartoo','plumtree');?></a>
			
			<div class="two_button_container" style="display:none;">
				<a id="patern_passpart_inline" class="button_left1" href="#patern_passpart_data"><?php _e('Wood/Plastic','plumtree');?></a>
				<a id="color_passpart_inline" class="button_right1" href="#color_passpart_data"><?php _e('Paper','plumtree');?></a>
			</div>
					
		
			<!--<div class="passpartoo_paper" style="display:none;">
			<ul id="subtabs_canvas">
				<li style="display:none;" class="passpartoo_paper"><a href="#subtabs-3">Paper</a></li>
			</ul>-->
					
			
			<!--<div id="subtabs-1" style=" height: auto;margin-top: 5px;">
				
				<div class="wooden_pattern_list">
					<a id="passpart_inline" href="#passpart_data">paspartu seç</a>
					<ul class="fpd-clearfix" id="fp-patterns"></ul>
				</div>
			</div>
			
			<div id="subtabs-2" style=" height: auto;margin-top: 5px;">
				<div class="plastic_pattern_list">
					<ul class="fpd-clearfix" id="fp-patterns"></ul>
				</div>
			</div>-->
			<div class="passpartoo_paper" style="display:none;">
				<table class="table" id="passpart_table">
				
				<tr>
					<td><input type="hidden" name="passpart_color_img" id="passpart_color_img" value="" readonly="readonly"/></td>
				</tr>
				<tr>
				
					<td style="vertical-align:top"><?php _e('Paspartoo Width','plumtree');?> : <select id="width_selector_img">
							<?php for($i=1;$i<=15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
				
					<td style="vertical-align:top"><?php _e('Paspartoo Height','plumtree');?>: <select id="height_selector_img">
							<?php for($i=1;$i<=15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
						<td>
						<input type="button" name="passpartadd" id="passpart_img_add"  value="ekle" />
						</td>	
				</tr>
			</table>
			<span id="passpart_msg" style="display:none;color:#FF0000;"><?php _e('Inner Passpartoo can not be applied because your image size is more then 120 X 80 Cm','plumtree');?></span>
				
			  </div>
			<!--  </div>-->
			  
			<div class="pattern_stroke" style="display:none;">
			
					<?php _e('Model Width','plumtree');?> : <select id="width_pattern_stroke">
							<?php for($i=0;$i<=15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
							<?php }?>
						</select>
				</div>
			<div class="pattern_stroke" style="display:none;">
						<?php _e('Model Height','plumtree');?> : <select id="height_pattern_stroke">
								<?php for($i=0;$i<=15;$i++){?>
								<option value="<?php echo $i;?>"><?php echo $i;?> cm</option>
								<?php }?>
							</select>
					</div>
			</div>
			
			</div>
	</div>
</div>
</div>
</div>
</div>
<div class="option-toggle option-inactive"><i class="fa fa-cogs"></i></div>
</div>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. 
		
		?>
<style type="text/css">
.radio_option {
	border-collapse:separate !important;
	border-spacing:4px !important;
}
.radio_option tr td{
/*	background-color: #ccc;
    border: 2px solid #ccc;
    border-collapse: unset !important;
    border-radius: 6px;*/
    width: 20%;
	 box-shadow: 0 0 1px hsla(0, 0%, 0%, 0.23) inset, 4px 0 4px hsla(0, 0%, 0%, 0.39);
}
</style>
<div  class="main_div_right">     
<div class="theme-option_right">	
<div id="le_right">
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
<div class="about"><?php  _e('Price:', 'plumtree') ?>
<p class="price"><?php echo $product->get_price_html(); ?></p>
<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'stokta' : 'OutOfStock'; ?>" />
	</div>
	<!--<div class="row-2">
    <a href="#" class="digial_img"><img class="img-responsive" src="<?php bloginfo('template_directory');?>/img/dijital.jpg"/>
		<h4>Ditial Baski</h4>
		</a>
        <ul class="fpd-clearfix" id="fp-digital" style="display:none;">
        <li  class="pattern" tabval="canvas">
			<a href="#">
			<img class="img-responsive" src="<?php bloginfo('template_directory');?>/img/digita.jpg"/>
			
			<table class="radio_option">
				<tr><td><input type="radio" name="oil_paint" value="<?php echo get_option('fpd_product_tek_renk_price') ?>" class="canvas_options"/> Tek Renk</td></tr>
				<tr><td><input type="radio" name="oil_paint" value="<?php echo get_option('fpd_product_devamli_price') ?>" class="canvas_options"/> Devmali</td></tr>
			</table>
			</a>
		</li>
        <li  class="pattern" tabval="pattern">
			<a href="#">
			<img class="img-responsive" src="<?php bloginfo('template_directory');?>/img/digita.jpg"/>
			<table class="radio_option">
				<tr><td><input type="radio" name="canvas_paint" value="<?php echo get_option('fpd_product_parlak_cam_price') ?>" class="mat_options"/> Parlak Cam</td></tr>
				<tr><td><input type="radio" name="canvas_paint" value="<?php echo get_option('fpd_product_mat_cam_price') ?>" class="mat_options"/> Mat Cam</td></tr>
			</table>
			</a>
		</li>
        </ul>
	</div>
    <div style="clear:both;"></div>
	<div class="row-1">
		<a href="#" class="ayna_img"><img src="<?php bloginfo('template_directory');?>/img/ayna.png"/>
		<h4> Ayna</h4>
		</a>
		
		<ul class="fpd-clearfix" id="fp-aynas" style="display:none;"></ul>
	</div>-->
	 
   
	<div class="quantity fancy-product">
		<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	</div>
	
	
	</div> 
    </div>
<div class="option-toggle_right option-inactive_right"><i class="fa fa-cogs"></i></div>
</div>
<?php wp_footer();
}
else {
get_header('shop'); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

	</div>
</div>


<?php get_footer('shop'); }?>