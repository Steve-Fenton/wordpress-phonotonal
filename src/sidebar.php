<?php 
/**
 * 	This is the sidebar!
 *
 *	This file will render the sidebar, as defined by the user in the admin area
 *
*/
?>
<!-- *sb* -->
<?php if (!dynamic_sidebar('sidebar')) : ?>
	<div>
		<h3><?php _e( 'Archives', 'fenton' ); ?></h3>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</div>

	<div>
		<h3><?php _e( 'Meta', 'fenton' ); ?></h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</div>
<?php endif; ?>