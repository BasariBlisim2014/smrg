<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
 global $post,$product;
 

$tabs = apply_filters( 'woocommerce_product_tabs', array() );
//echo do_shortcode('[wonderplugin_carousel id="1"]'); 
?>

    <!-- use jssor.slider.mini.js (40KB) or jssor.sliderc.mini.js (32KB, with caption, no slideshow) or jssor.sliders.mini.js (28KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jssor.core.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jssor.utils.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jssor.slider.js"></script>
    <!--<script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,
                $AutoPlaySteps: 4,
                $AutoPlayInterval: 4000,
				$PauseOnHover: 1,
				$ArrowKeyNavigation: true,
                $SlideDuration: 160,
                $MinDragOffsetToSlide: 20,
                $SlideWidth: 200,
				$SlideSpacing: 3,
                $DisplayPieces: 4,
				$UISearchMode: 1,
                $PlayOrientation: 1,
				 $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 0,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 0, 
					$Steps: 1,
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 0,
					$SpacingY: 0,
                    $Orientation: 1 
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2, 
					$Steps: 4 
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(bodyWidth, 809));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }

        });
    </script>-->
	<?php 
	global $post;
	$term=get_term_by('name', 'Wall Images', 'fpd_design_category');

	$args = array(
					'posts_per_page' => -1,
					'post_type' => 'attachment',
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'fpd_design_category' => 'wall-images'
				);
	
	$designs= get_posts( $args );
							
?>
<style type="text/css">
.img_background{
background: none repeat scroll 0 0 hsl(0, 0%, 100%);
    border-radius: 5px;
}
</style>
	<!--<h2 style="padding: 8px 0px"><?php _e('TABLOYU ODADA GÖR','woocommerce');?></h2>
	<div style="display:block; padding:21px 11px;background-color: #acabab;">
	
	
	</div>
	<script language="javascript">
		jQuery(function($){	
			
			
			$(".open_popup").click(function(){
				var variation_slug=$("#pa_frame-options").val();
				$.fancybox.open({
					padding : 0,
					href:'<?php echo get_template_directory_uri(); ?>/wallgalary.php?post_id=<?php echo $post->ID;?>&variation_id='+variation_slug,
					type: 'iframe',
					height: 600,
					width:1200
				});
			});
});
	</script>-->
	<?php 
if ( ! empty( $tabs ) ) : ?>

	<style type="text/css">
	.new_class{clear: both;
margin: 4rem 0;
margin: 40px 0;
padding: 4rem 0;
padding: 10px 0;
border-top: 2px solid #f1f1f1;
border-bottom: 2px solid #f1f1f1;
	}
	</style>
	<div class="new_class">
		<!--<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
		</ul>-->
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<?php if($key=='additional_information'){?>
			<div class="panel entry-content" id="<?php echo $key ?>" style="width:70%;">
					<?php if(isset($tab['callback'])){?>
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				<?php }?>
			</div>
			<?php }?>
		<?php endforeach; ?>
	</div>

<?php endif; ?>