<?php

/**
 * Welcome Screen Class
 */
class Newsmag_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'newsmag_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'newsmag_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'newsmag_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'newsmag_welcome_scripts_for_customizer' ) );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_newsmag_dismiss_required_action', array(
			$this,
			'newsmag_dismiss_required_action_callback'
		) );
		add_action( 'wp_ajax_nopriv_newsmag_dismiss_required_action', array(
			$this,
			'newsmag_dismiss_required_action_callback'
		) );
	}

	/**
	 * Creates the dashboard page
	 *
	 * @see   add_theme_page()
	 * @since 1.8.2.4
	 */
	public function newsmag_welcome_register_menu() {
		$action_count = $this->count_actions();
		$title        = $action_count > 0 ? 'About Newsmag <span class="badge-action-count">' . esc_html( $action_count ) . '</span>' : 'About Newsmag';

		add_theme_page( 'About Newsmag', $title, 'edit_theme_options', 'newsmag-welcome', array(
			$this,
			'newsmag_welcome_screen'
		) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @since 1.8.2.4
	 */
	public function newsmag_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'newsmag_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @since 1.8.2.4
	 */
	public function newsmag_welcome_admin_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Newsmag! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'newsmag' ), '<a href="' . esc_url( admin_url( 'themes.php?page=newsmag-welcome' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=newsmag-welcome' ) ); ?>" class="button"
			      style="text-decoration: none;"><?php _e( 'Get started with Newsmag', 'newsmag' ); ?></a></p>
		</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 *
	 * @since  1.8.2.4
	 */
	public function newsmag_welcome_style_and_scripts( $hook_suffix ) {

		wp_enqueue_style( 'newsmag-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
		wp_enqueue_script( 'newsmag-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array( 'jquery' ) );

		wp_localize_script( 'newsmag-welcome-screen-js', 'newsmagWelcomeScreenObject', array(
			'nr_actions_required'      => $this->count_actions(),
			'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
			'template_directory'       => get_template_directory_uri(),
			'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.', 'newsmag' )
		) );

	}

	/**
	 * Load scripts for customizer page
	 *
	 * @since  1.8.2.4
	 */
	public function newsmag_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'newsmag-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'newsmag-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array( 'jquery' ), '20120206', true );

		wp_localize_script( 'newsmag-welcome-screen-customizer-js', 'newsmagWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $this->count_actions(),
			'aboutpage'           => esc_url( admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions' ) ),
			'customizerpage'      => esc_url( admin_url( 'customize.php#recommended_actions' ) ),
			'themeinfo'           => __( 'View Theme Info', 'newsmag' ),
		) );
	}

	/**
	 * Dismiss required actions
	 *
	 * @since 1.8.2.4
	 */
	public function newsmag_dismiss_required_action_callback() {

		global $newsmag_required_actions;

		$newsmag_dismiss_id = ( isset( $_GET['dismiss_id'] ) ) ? $_GET['dismiss_id'] : 0;

		echo $newsmag_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $newsmag_dismiss_id ) ):

			/* if the option exists, update the record for the specified id */
			if ( get_option( 'newsmag_show_required_actions' ) ):

				$newsmag_show_required_actions = get_option( 'newsmag_show_required_actions' );

				$newsmag_show_required_actions[ $newsmag_dismiss_id ] = false;

				update_option( 'newsmag_show_required_actions', $newsmag_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$newsmag_show_required_actions_new = array();

				if ( ! empty( $newsmag_required_actions ) ):

					foreach ( $newsmag_required_actions as $newsmag_required_action ):

						if ( $newsmag_required_action['id'] == $newsmag_dismiss_id ):
							$newsmag_show_required_actions_new[ $newsmag_required_action['id'] ] = false;
						else:
							$newsmag_show_required_actions_new[ $newsmag_required_action['id'] ] = true;
						endif;

					endforeach;

					update_option( 'newsmag_show_required_actions', $newsmag_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}

	/**
	 *
	 */
	public function count_actions() {
		global $newsmag_required_actions;

		$newsmag_show_required_actions = get_option( 'newsmag_show_required_actions' );
		if ( ! $newsmag_show_required_actions ) {
			$newsmag_show_required_actions = array();
		}

		$i = 0;
		foreach ( $newsmag_required_actions as $action ) {
			$true      = false;
			$dismissed = false;

			if ( ! $action['check'] ) {
				$true = true;
			}

			if ( ! empty( $newsmag_show_required_actions ) && isset( $newsmag_show_required_actions[ $action['id'] ] ) && ! $newsmag_show_required_actions[ $action['id'] ] ) {
				$true = false;
			}

			if ( $true ) {
				$i ++;
			}
		}


		return $i;
	}

	/**
	 * Welcome screen content
	 *
	 * @since 1.8.2.4
	 */
	public function newsmag_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );

		$newsmag      = wp_get_theme();
		$active_tab   = isset( $_GET['tab'] ) ? $_GET['tab'] : 'getting_started';
		$action_count = $this->count_actions();

		?>

		<div class="wrap about-wrap epsilon-wrap">

			<h1><?php echo __( 'Welcome to Newsmag! - Version ', 'newsmag') . $newsmag['Version']; ?></h1>

			<div
				class="about-text"><?php echo esc_html__( 'Newsmag is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it! We want to make sure you have the best experience using Newsmag and that is why we gathered here all the necessary information for you. We hope you will enjoy using Newsmag, as much as we enjoy creating great products.', 'newsmag' ); ?></div>

			<div class="wp-badge epsilon-welcome-logo"></div>


			<h2 class="nav-tab-wrapper wp-clearfix">
				<a href="<?php echo admin_url( 'themes.php?page=newsmag-welcome&tab=getting_started' ); ?>"
				   class="nav-tab <?php echo $active_tab == 'getting_started' ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__( 'Getting Started', 'newsmag' ); ?></a>
				<a href="<?php echo admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions' ); ?>"
				   class="nav-tab <?php echo $active_tab == 'recommended_actions' ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Recommended Actions', 'newsmag' ); ?>
					<?php echo $action_count > 0 ? '<span class="badge-action-count">' . esc_html( $action_count ) . '</span>' : '' ?></a>
				<a href="<?php echo admin_url( 'themes.php?page=newsmag-welcome&tab=support' ); ?>"
				   class="nav-tab <?php echo $active_tab == 'support' ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Support', 'newsmag' ); ?></a>
				<a href="<?php echo admin_url( 'themes.php?page=newsmag-welcome&tab=changelog' ); ?>"
				   class="nav-tab <?php echo $active_tab == 'changelog' ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Changelog', 'newsmag' ); ?></a>
			</h2>

			<?php
			switch ( $active_tab ) {
				case 'getting_started':
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php';
					break;
				case 'recommended_actions':
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/actions-required.php';
					break;
				case 'support':
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/support.php';
					break;
				case 'changelog':
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/changelog.php';
					break;
				default:
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php';
					break;
			}
			?>


		</div><!--/.wrap.about-wrap-->

		<?php
	}
}

new Newsmag_Welcome();
