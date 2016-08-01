<form id="newOrder" method="post" action="">
	<fieldset class="form-group">
		<input class="form-control" placeholder="Company" name="post_title" type="text" required/>
	</fieldset>
	<fieldset class="form-group">
		<input class="form-control" placeholder="Email" name="client_email" type="text" required/>
	</fieldset>
	<fieldset class="form-group">
		<div class='input-group date' id='datetimepicker1'>
			<input class="form-control" placeholder="Time & Date" type='text' name="datetime" required/>
			<span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
		</div>
	</fieldset>
	<fieldset class="form-group">
		<label for="hours">Hours</label>
		<div class="input-group spinner">
			<input id="hours" type="number" step="any" class="form-control" name="hours" value="2" required>
			<div class="input-group-btn-vertical">
				<button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
				<button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
			</div>
		</div>
	</fieldset>
	<fieldset class="form-group">
		<label for="sessions">Each session is 15 mins ($20 per)</label>
		<input id="sessions" class="sessions form-control" type="number" name="sessions" readonly>
	</fieldset>
	<fieldset class="form-group">
		<input id="total" class="form-control" placeholder="Total" name="total" type="number" value="0.00" step="any" readonly>
	</fieldset>
	<fieldset class="form-group">
		<input class="form-control" type="hidden" name="new_post" value="1"/>
	</fieldset>
	<fieldset class="form-group">
		<button id="newOrderButton" class="btn btn-primary" type="submit" name="submit" value="Post">
		Submit</button>
	</fieldset>
</form>

<?php

//function add_session_intervals( $date_time, $minutes_to_add ) {
//	$minutes_to_add = 15;
//	$date_time      = new DateTime( $date_time );
//	$date_time->add( new DateInterval( 'PT' . $minutes_to_add . 'M' ) );
//	$date_time = $date_time->format( 'm/d/Y h:i A' );
//
//	return $date_time;
//}

if ( isset( $_POST['new_post'] ) == '1' ) {

	$value = $_REQUEST['sessions'];

	$i            = 0;
	$times_to_run = $value;
	$m            = 0;

	while ( $i ++ < $times_to_run ) {


		// Create New User - START
		/*
		$nicename = strtolower($_POST['client_email']);

		$userdata = array(
			'user_login'   => $_POST['client_email'],
			'user_email'   => $_POST['client_email'],
			'display_name' => $_POST[''],
			'role'         => 'customer',
			'user_nicename' => $nicename,
			'user_pass'    => null  // When creating an user, `user_pass` is expected.
		);

		wp_insert_user( $userdata );
		*/
		// Create New User - END


		// Create New Products - START
		if ( isset( $_POST['new_post'] ) == '1' ) {

			if ( $m <= 0 ) {
				$minutes_to_add = 0;
			} else {
				$minutes_to_add += 15;
			}
			$m ++;

			$company_name     = $_POST['post_title'];
			$request_datetime = $_POST['datetime'];
			$request_datetime = new DateTime( $request_datetime );
			$request_datetime->add( new DateInterval( 'PT' . $minutes_to_add . 'M' ) );
			$request_datetime = $request_datetime->format( 'm/d/Y h:i A' );
			$request_title    = $company_name . " - " . $request_datetime;

			$new_post = [
				'ID'          => '',
				'post_type'   => 'product',
				'post_status' => 'publish',
				'post_author' => get_current_user_id(),
				'post_title'  => $request_title,
				'meta_input'  => [
					//'individual'     => $_POST['staff'],
					'date_&_time'    => $request_datetime,
					'_regular_price' => '20',
					'_price'         => '20',
					'_visibility'    => 'visible',

				],
			];

			$post_id = wp_insert_post( $new_post );
			$post    = get_post( $post_id );
		}
		// Create New Products - END


	}

}


/*


// http://wordpress.stackexchange.com/questions/137501/how-to-add-product-in-woocommerce-with-php-code
$post = array(
	'post_author' => $user_id,
	'post_content' => '',
	'post_status' => "publish",
	'post_title' => $product->part_num,
	'post_parent' => '',
	'post_type' => "product",
);

//Create post
$post_id = wp_insert_post( $post, $wp_error );
if($post_id){
	$attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
	add_post_meta($post_id, '_thumbnail_id', $attach_id);
}
wp_set_object_terms( $post_id, 'Races', 'product_cat' );
wp_set_object_terms($post_id, 'simple', 'product_type');



update_post_meta( $post_id, '_visibility', 'visible' );
update_post_meta( $post_id, '_stock_status', 'instock');
update_post_meta( $post_id, 'total_sales', '0');
update_post_meta( $post_id, '_downloadable', 'yes');
update_post_meta( $post_id, '_virtual', 'yes');
update_post_meta( $post_id, '_regular_price', "1" );
update_post_meta( $post_id, '_sale_price', "1" );
update_post_meta( $post_id, '_purchase_note', "" );
update_post_meta( $post_id, '_featured', "no" );
update_post_meta( $post_id, '_weight', "" );
update_post_meta( $post_id, '_length', "" );
update_post_meta( $post_id, '_width', "" );
update_post_meta( $post_id, '_height', "" );
update_post_meta($post_id, '_sku', "");
update_post_meta( $post_id, '_product_attributes', array());
update_post_meta( $post_id, '_sale_price_dates_from', "" );
update_post_meta( $post_id, '_sale_price_dates_to', "" );
update_post_meta( $post_id, '_price', "1" );
update_post_meta( $post_id, '_sold_individually', "" );
update_post_meta( $post_id, '_manage_stock', "no" );
update_post_meta( $post_id, '_backorders', "no" );
update_post_meta( $post_id, '_stock', "" );

// file paths will be stored in an array keyed off md5(file path)
$downdloadArray =array('name'=>"Test", 'file' => $uploadDIR['baseurl']."/video/".$video);

$file_path =md5($uploadDIR['baseurl']."/video/".$video);


$_file_paths[  $file_path  ] = $downdloadArray;
// grant permission to any newly added files on any existing orders for this product
//do_action( 'woocommerce_process_product_file_download_paths', $post_id, 0, $downdloadArray );
update_post_meta( $post_id, '_downloadable_files ', $_file_paths);
update_post_meta( $post_id, '_download_limit', '');
update_post_meta( $post_id, '_download_expiry', '');
update_post_meta( $post_id, '_download_type', '');
update_post_meta( $post_id, '_product_image_gallery', '');

*/