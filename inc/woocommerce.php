<?php
//add_filter( 'the_title', 'get_wc_api_client', 10, 2 );
function get_wc_api_client() {
	// Include the client library
	require_once 'woo-api/woocommerce-api.php';

	$consumer_key = 'ck_dcd144684854cf1debf3ada4adb9c7f7e30bbf03';

	$consumer_secret = 'cs_67d11ffc5895470154badd160b5f3ecb52d35716';

	$store_url = 'http://knead.dev/'; // Add the home URL to the store you want to connect to here

	$options = array(
		'debug'           => true,
		'return_as_array' => false,
		'validate_url'    => false,
		'timeout'         => 30,
		'ssl_verify'      => false,
	);

	return new WC_API_Client( $store_url, $consumer_key, $consumer_secret, $options );
}