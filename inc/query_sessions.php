<?php
function the_scheduler_query_the_sessions() {
	$args      = [
		'post_type'      => 'product',
		'posts_per_page' => - 1,
	];
	$the_query = new WP_Query( $args ); ?>
	<ul class="order-list">
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$date_time = get_field( 'date_&_time' );
		?>
		<li class="order" style="border: 1px solid; padding: 10px; margin: 10px;">
			<input type="text" placeholder="<?php the_title();?>" readonly>
			<input type="text" placeholder="<?php the_author(); ?>" readonly>
			<input type="text" placeholder="<?php the_field( 'individual' ); ?>">
			<input type="datetime" placeholder="<?php echo $date_time; ?>">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Update">
		</li>
	<?php endwhile; ?>
		</ul>
		<?php
	wp_reset_postdata();
}