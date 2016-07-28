<form id="post-submission-form">

	<div>
		<label for="post-submission-title">
			<?php _e( 'Title', 'your-text-domain' ); ?>
		</label>
		<input type="text" name="post-submission-title" id="post-submission-title" required
		       aria-required="true">
	</div>

	<div>
		<label for="post-submission-excerpt">
			<?php _e( 'Excerpt', 'your-text-domain' ); ?>
		</label>
		<textarea rows="2" cols="20" name="post-submission-excerpt" id="post-submission-excerpt"
		          required aria-required="true"></textarea>
	</div>

	<div>
		<label for="post-submission-content">
			<?php _e( 'Content', 'your-text-domain' ); ?>
		</label>
		<textarea rows="10" cols="20" name="post-submission-content"
		          id="post-submission-content"></textarea>
	</div>

	<input type="submit" value="<?php esc_attr_e( 'Submit', 'your-text-domain' ); ?>">
</form>