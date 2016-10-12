<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php';
?>

<div id="getting_started" class="newsmag-tab-pane active">
	<div class="newsmag-tab-pane-thirds">
		<h4><?php esc_html_e( 'Step 1 - Fix recommended actions.', 'newsmag' ); ?></h4>
		<p><?php esc_html_e( 'We\'ve compiled a list of steps for you, to take make sure the experience you\'ll have using one of our products is very easy to follow.', 'newsmag' ); ?></p>

		<?php
		$nr_actions_required = 0;
		/* get number of required actions */
		if ( get_option( 'newsmag_show_required_actions' ) ):
			$newsmag_show_required_actions = get_option( 'newsmag_show_required_actions' );
		else:
			$newsmag_show_required_actions = array();
		endif;

		if ( ! empty( $newsmag_required_actions ) ):
			foreach ( $newsmag_required_actions as $newsmag_required_action_value ):
				if ( ( ! isset( $newsmag_required_action_value['check'] ) || ( isset( $newsmag_required_action_value['check'] ) && ( $newsmag_required_action_value['check'] == false ) ) ) && ( ( isset( $newsmag_show_required_actions[ $newsmag_required_action_value['id'] ] ) && ( $newsmag_show_required_actions[ $newsmag_required_action_value['id'] ] == true ) ) || ! isset( $newsmag_show_required_actions[ $newsmag_required_action_value['id'] ] ) ) ) :
					$nr_actions_required ++;
				endif;
			endforeach;
		endif;

		if ( $nr_actions_required == 0 ) { ?>
			<p><a class="newsmag-delegate" href="#actions_required" aria-controls="actions_required" role="tab"
			      data-toggle="tab"><?php esc_html_e( 'No recommended actions left to perform.', 'newsmag' ); ?></a></p>
		<?php } else { ?>
			<p><a class="newsmag-delegate" href="#actions_required" aria-controls="actions_required" role="tab"
			      data-toggle="tab"><?php esc_html_e( 'Check recommended actions.', 'newsmag' ); ?></a></p> <?php
		};
		?>
	</div>

	<div class="newsmag-tab-pane-thirds">
		<h4><?php esc_html_e( 'Step 2 - Check our documentation.', 'newsmag' ); ?></h4>
		<p><?php esc_html_e( 'Even if you\'re a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'newsmag' ) ?></p>
		<p><a href="https://docs.machothemes.com/"><?php esc_html_e( 'Full documentation.', 'newsmag' ); ?></a></p>
	</div>

	<div class="newsmag-tab-pane-thirds">
		<h4><?php esc_html_e( 'Step 3 - Customize everything.', 'newsmag' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'newsmag' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>"
		      class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'newsmag' ); ?></a></p>
	</div>

</div>
