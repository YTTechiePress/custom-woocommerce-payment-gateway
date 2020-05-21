<?php
/**
 * Plugin name: Query APIs
 * Plugin URI: https://omukiguy.com
 * Description: Exchange information with external APIs in WordPress
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com
 * text-domain: query-apis
 */

// If this file is access directly, abort!!!
defined( 'ABSPATH' ) or die( 'Unauthorized Access' );

function get_send_data() {

	$api_key     = '5384z9XT7';
	$widget_key  = '53525880bd675362d449b60185f82ddf';
	$phone       = '2578288658885555';
	$amount      = 500;
	$network_id  = '1'; // mtn
	$reason      = 'Test';

	$url = 'https://e.patasente.com/phantom-api/pay-with-patasente/' . $api_key . '/' . $widget_key . '?phone=' . $phone . '&amount=' . $amount . '&mobile_money_company_id=' . $network_id . '&reason=' . 'Test';

	var_dump($url);

	$response = wp_remote_post( $url, array( 'timeout' => 45 ) );

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		echo '<pre>';
		var_dump( wp_remote_retrieve_body( $response ) );
		echo '</pre>';
	}
}	

/**
 * Register a custom menu page
 */
function wpdocs_register_my_custom_menu_page() {
	add_menu_page(
		__( 'API Test Settings', 'textdomain' ),
		'API Test',
		'manage_options',
		'api-test.php',
		'get_send_data',
		'dashicons-testimonial',
		85
	);
}

add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
