<?php 
if ( ! function_exists( 'esc_html_e') ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
} ?>
<div id="passwd-actions" class="passwd-actions">
	<a id="passwd-reset" href="#"><?php esc_html_e( 'Reset your password', 'acf-wp-show-password' ); ?></a>
	<label for="show-password" class="checkbox-label show-password">
	    <input id="show-password" type="checkbox" />
	    <span>
	        <?php esc_html_e( 'Show text', 'acf-wp-show-password' ); ?>
	    </span>
	</label>
</div>