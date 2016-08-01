<?php
/*
Plugin Name: The Scheduler
Plugin URI:  https://github.com/Mizner/woocommerce-orders-and-scheduling.git
Description: Split payment of a product up between multiple users/dates
Version:     0.0.1
Author:     Michael Mizner <michaelmizner@gmail.com>
Author URI:  https://github.com/Mizner
License:     MIT
License URI: https://opensource.org/licenses/MIT

Consumer Key: ck_dcd144684854cf1debf3ada4adb9c7f7e30bbf03
Consumer Secret: cs_67d11ffc5895470154badd160b5f3ecb52d35716

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// Props to https://wordpress.org/plugins/woo-change-product-author/
require ('plugins/woo-change-product-author/woo-change-product-author.php');




function the_scheduler_enqueue_scripts() { // Load Scripts
	if ( wp_script_is( 'jquery' ) ): // if jQuery is already loaded do nothing
	else :
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		wp_enqueue_script( 'jquery' );
	endif;
	wp_enqueue_style( 'the_scheduler_CSS', plugins_url( './dist/knead.min.css', __FILE__ ) );
	wp_enqueue_script( 'the_scheduler_JS', plugins_url( './dist/knead.min.js', __FILE__ ), ['jquery', 'understrap-scripts'], 0.1, true  );
	wp_localize_script( 'the_scheduler_JS', 'POST_SUBMITTER', [
			'root'            => esc_url_raw( rest_url() ),
			'nonce'           => wp_create_nonce( 'wp_rest' ),
			'success'         => __( 'Thanks for your submission!', 'your-text-domain' ),
			'failure'         => __( 'Your submission could not be processed.', 'your-text-domain' ),
			'current_user_id' => get_current_user_id()
		]
	);
}

add_action( 'wp_enqueue_scripts', 'the_scheduler_enqueue_scripts' );


/*
 * Query Sessions (Products)
*/
require_once( 'inc/query_sessions.php' );
add_shortcode( 'show_customer_sessions', 'the_scheduler_show_customer_sessions' );
function the_scheduler_show_customer_sessions() {
	the_scheduler_query_the_sessions(); // lives in query_orders.php
}



/*
 * Query Orders

require_once( 'inc/query_orders.php' );
add_shortcode( 'show_customer_orders', 'the_scheduler_show_customer_orders' );
function the_scheduler_show_customer_orders() {
	the_scheduler_query_the_orders(); // lives in query_orders.php
}
*/


/*
 * Create Products
 */
add_shortcode( 'create_products', 'the_scheduler_create_products' );
function the_scheduler_create_products() {
	ob_start();
	//require_once( 'inc/forms/front-end-create-product.php' );
	require_once( 'inc/forms/wp_insert_post_front_end_form.php' );

	return ob_get_clean();
}

/*
 * Add info to Single Product

add_action( 'woocommerce_single_product_summary', 'the_scheduler_after_the_meta' );
function the_scheduler_after_the_meta() { ?>
	<?php acf_form_head(); ?>
	<li class="order"><?php acf_form(); ?></li>
	<?php
}

 */


/*
 * Admin Page
 */
require_once("inc/dashboard_options_page.php");
