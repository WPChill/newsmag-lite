<?php
/**
 * Recommended Plugins
 */
global $newsmag_required_actions, $newsmag_recommended_plugins;
?>

<div class="feature-section recommended-plugins three-col">
	<?php foreach ( $newsmag_recommended_plugins as $plugin => $prop ) { ?>
		<?php
		$info   = $this->call_plugin_api( $plugin );
		$icon   = $this->check_for_icon( $info->icons );
		$active = $this->check_active( $plugin );
		$url    = $this->create_action_link( $active['needs'], $plugin );

		$label = '';

		switch ( $active['needs'] ) {
			case 'install':
				$label = __( 'Install', 'newsmag' );
				break;
			case 'activate':
				$label = __( 'Activate', 'newsmag' );
				break;
			case 'deactivate':
				$label = __( 'Deactivate', 'newsmag' );
				break;
		}

		?>
		<div class="col plugin_box">
			<img src="<?php echo esc_attr( $icon ) ?>" alt="plugin box image">
			<span class="version"><?php echo __( 'Version:', 'newsmag' ); ?><?php echo $info->version ?></span> <span
				class="separator">|</span> <?php echo wp_kses_post( $info->author ) ?>
			<div
				class="action_bar <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
				<span
					class="plugin_name"><?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'Active: ' : '' ?><?php echo $info->name; ?></span>
			</div>
			<span
				class="action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
				<a class="button button-primary" href="<?php echo esc_url( $url ) ?>"> <?php echo $label ?> </a>
			</span>
		</div>
	<?php } ?>
</div>