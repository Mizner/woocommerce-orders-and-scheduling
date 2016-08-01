<?php
add_action( 'admin_menu', 'the_scheduler_add_admin_menu' );
add_action( 'admin_init', 'the_scheduler_settings_init' );




function the_scheduler_add_admin_menu(  ) {
	add_menu_page( 'The Scheduler', 'The Scheduler', 'manage_options', 'the_scheduler', 'the_scheduler_options_page' );
}

function the_scheduler_settings_init(  ) {
	register_setting( 'pluginPage', 'the_scheduler_settings' );
}




function the_scheduler_settings_section_callback(  ) {
	echo __( 'This section description', 'wordpress' );
}


function the_scheduler_options_page(  ) { ?>
	<form>
		<h2>The Scheduler</h2>
		<?php
		the_scheduler_query_the_sessions();
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}
