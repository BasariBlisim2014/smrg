<?php

/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="tab-pane active" id="authorization">

<?php

if ( ! is_user_logged_in() ) :

?>


	<h3 class="pt-content-title"><?php _e( 'Login', 'plumtree' ); ?></h3>

	<form method="post" class="login-in" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

		<?php do_action( 'woocommerce_login_form_start' ); ?>
		<input type="hidden" name="only_quote" value="<?php echo $_SESSION['only_quote'];?>" />
		<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

		<p class="form-row form-row-first">
			<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="username" id="username" />
		</p>

		<p class="form-row form-row-last">
			<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="input-text" type="password" name="password" id="password" />
		</p>

		<div class="clear"></div>

		<p class="required_fields"><?php _e('* Required Fields', 'plumtree');?></p>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			<label for="rememberme" class="inline">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
			</label>
		</p>

		<p class="lost_password">
			<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	</form>

    <?php endif; ?>

	<p class="form-row form-row-last step-nav">
		<span class="pt-dark-button step-checkout" data-toggle="tab" data-show="billing"><?php _e('Continue to Billing Address', 'plumtree');?>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></span>
	</p>

</div>

