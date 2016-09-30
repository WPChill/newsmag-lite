<?php
/**
 * Import Demo
 */
$button_text = __( 'Import Demo Data', 'newsmag' );
?>

<div id="import_demo" class="newsmag-tab-pane">

	<h1><?php esc_html_e( 'Demo Import.', 'newsmag' ); ?></h1>

	<!-- NEWS -->

	<hr/>
	<?php
	$x = new MT_Theme_Importer();
	$x->demo_installer();
	?>
</div>
