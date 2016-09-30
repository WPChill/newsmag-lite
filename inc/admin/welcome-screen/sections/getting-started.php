<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="newsmag-tab-pane active">

	<div class="newsmag-tab-pane-center">

		<h1 class="newsmag-welcome-title"><?php _e('Welcome to Newsmag!', 'newsmag'); ?> <?php if( !empty($newsmag['Version']) ): ?> <sup id="newsmag-theme-version"><?php echo esc_attr( $newsmag['Version'] ); ?> </sup><?php endif; ?></h1>

		<p><?php esc_html_e( 'Our most popular free one page WordPress theme, Newsmag!','newsmag'); ?></p>
		<p><?php esc_html_e( 'We want to make sure you have the best experience using Newsmag and that is why we gathered here all the necessary information for you. We hope you will enjoy using Newsmag, as much as we enjoy creating great products.', 'newsmag' ); ?>

	</div>

	<hr />

	<div class="newsmag-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'newsmag' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'newsmag' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'newsmag' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'newsmag' ); ?></a></p>

	</div>

	<hr />

</div>
