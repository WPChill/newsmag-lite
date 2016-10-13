<?php
/**
 * Getting started template
 */
$customizer_url = admin_url() . 'customize.php';
?>

<div class="feature-section three-col">
	<div class="col">
		<h3><?php esc_html_e( 'Step 1 - Fix recommended actions.', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'We\'ve compiled a list of steps for you, to take make sure the experience you\'ll have using one of our products is very easy to follow.', 'newsmag' ); ?></p>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 2 - Check our documentation.', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'Even if you\'re a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'newsmag' ) ?></p>
		<p>
			<a href="<?php echo esc_url( 'https://docs.machothemes.com/' ); ?>"><?php esc_html_e( 'Full documentation.', 'newsmag' ); ?></a>
		</p>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 3 - Customize everything.', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'newsmag' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>"
		      class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'newsmag' ); ?></a>
		</p>
	</div><!--/.col-->
</div><!--/.feature-section-->