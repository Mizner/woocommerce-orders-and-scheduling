<?php

function the_scheduler_query_the_orders() {
		$args = [
		'post_type'   => 'shop_order',
		'post_status' => array_keys( wc_get_order_statuses() ),
		'posts_per_page' => - 1,
	];
	$the_query = new WP_Query( $args ); ?>
	<ul class="order-list">

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li class="order">
			<?php the_field('date_&_time') ?>
			<?php the_field('individual'); ?>
			<?php the_field('staff'); ?>
		</li>
		<?php
	endwhile;
	wp_reset_postdata();
}
