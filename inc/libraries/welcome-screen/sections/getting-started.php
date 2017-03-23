<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Getting started template
 */
$customizer_url = admin_url() . 'customize.php';
$count          = $this->count_actions();
?>

<div class="feature-section three-col">
	<div class="col">
		<h3><?php esc_html_e( 'Step 1 - Implement recommended actions', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'We\'ve compiled a list of steps for you, to take make sure the experience you\'ll have using one of our products is very easy to follow.', 'newsmag' ); ?></p>
		<?php if ( $count == 0 ) { ?>
			<p><span class="dashicons dashicons-yes"></span>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions' ) ); ?>"><?php esc_html_e( 'No recommended actions left to perform', 'newsmag' ); ?></a>
			</p>
		<?php } else { ?>
			<p><span class="dashicons dashicons-no-alt"></span> <a
					href="<?php echo esc_url( admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions' ) ); ?>"><?php esc_html_e( 'Check recommended actions', 'newsmag' ); ?></a>
			</p> <?php
		}; ?>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 2 - Check our documentation', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'Even if you\'re a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'newsmag' ) ?></p>
		<p>
			<a target="_blank"
			   href="<?php echo esc_url( 'http://docs.machothemes.com/' ); ?>"><?php esc_html_e( 'Full documentation', 'newsmag' ); ?></a>
		</p>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 3 - Customize everything', 'newsmag' ); ?></h3>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'newsmag' ); ?></p>
		<p><a target="_blank" href="<?php echo esc_url( $customizer_url ); ?>"
		      class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'newsmag' ); ?></a>
		</p>
	</div><!--/.col-->
</div><!--/.feature-section-->