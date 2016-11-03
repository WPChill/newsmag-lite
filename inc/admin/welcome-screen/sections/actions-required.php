<?php
/**
 * Actions required
 */
?>

<div class="feature-section action-required">

	<?php
	global $newsmag_required_actions;

	if ( ! empty( $newsmag_required_actions ) ):

		/* newsmag_show_required_actions is an array of true/false for each required action that was dismissed */
		$newsmag_show_required_actions = get_option( "newsmag_show_required_actions" );

		foreach ( $newsmag_required_actions as $newsmag_required_action_key => $newsmag_required_action_value ):
			if ( @$newsmag_show_required_actions[ $newsmag_required_action_value['id'] ] === false ) {
				continue;
			}
			if ( @$newsmag_required_action_value['check'] ) {
				continue;
			}
			?>
			<div class="newsmag-action-required-box">
				<span class="dashicons dashicons-no-alt newsmag-dismiss-required-action"
				      id="<?php echo $newsmag_required_action_value['id']; ?>"></span>
				<h3><?php if ( ! empty( $newsmag_required_action_value['title'] ) ): echo $newsmag_required_action_value['title']; endif; ?></h3>
				<p>
					<?php if ( ! empty( $newsmag_required_action_value['description'] ) ): echo $newsmag_required_action_value['description']; endif; ?>
					<?php if ( ! empty( $newsmag_required_action_value['help'] ) ): echo '<br/>' . $newsmag_required_action_value['help']; endif; ?>
				</p>
				<?php
				$installed = false;
				$url       = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $newsmag_required_action_value['plugin_slug'] ), 'install-plugin_' . $newsmag_required_action_value['plugin_slug'] );

				if ( file_exists( ABSPATH . 'wp-content/plugins/' . $newsmag_required_action_value['plugin_slug'] . '/' . $newsmag_required_action_value['plugin_slug'] . '.php' ) ) {
					$installed = true;
					$url       = wp_nonce_url( self_admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions&action=activate_plugin&plugin=' . $newsmag_required_action_value['plugin_slug'] . '/' . $newsmag_required_action_value['plugin_slug'] . '.php' ), 'activate_plugin_' . $newsmag_required_action_value['plugin_slug'] );
				}
				if ( ! empty( $newsmag_required_action_value['plugin_slug'] ) ): ?>
					<p>
						<a href="<?php echo esc_url( $url ); ?>"
						   class="button button-primary"><?php if ( ! empty( $newsmag_required_action_value['title'] ) ): echo $newsmag_required_action_value['title']; endif; ?></a>
					</p>
					<?php
				endif;
				?>
			</div>
			<?php
		endforeach;
	endif;

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

	if ( $nr_actions_required == 0 ):
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'newsmag' ) . '</span>';
	endif;
	?>

</div>
