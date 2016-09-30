<?php
/**
 * Changelog
 */

$newsmag = wp_get_theme( 'newsmag' );

?>
<div class="newsmag-tab-pane" id="changelog">

	<div class="newsmag-tab-pane-center">
	
		<h1>Newsmag <?php if( !empty($newsmag['Version']) ): ?> <sup id="newsmag-theme-version"><?php echo esc_attr( $newsmag['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$newsmag_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
	$newsmag_changelog_lines = explode(PHP_EOL, $newsmag_changelog);
	foreach($newsmag_changelog_lines as $newsmag_changelog_line){
		if(substr( $newsmag_changelog_line, 0, 3 ) === "###"){
			echo '<hr /><h1>'.substr($newsmag_changelog_line,3).'</h1>';
		} else {
			echo $newsmag_changelog_line,'<br/>';
		}
	}

	?>
	
</div>