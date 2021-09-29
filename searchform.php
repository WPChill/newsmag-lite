<?php $search_query = get_search_query(); ?>
<form role="search" method="get" id="searchform_topbar" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
	<label><span class="screen-reader-text"><?php echo __( 'Search for:', 'newsmag' ); ?></span>
		<input class="search-field-top-bar <?php echo '' === $search_query ? '' : 'opened'; ?>" id="search-field-top-bar" placeholder="<?php echo __( 'Type the search term', 'newsmag' ); ?>" value="<?php echo esc_attr( $search_query ); ?>" name="s" type="search">
	</label>
	<button id="search-top-bar-submit" type="button" class="search-top-bar-submit <?php echo '' === $search_query ? '' : 'submit-button'; ?>"><span class="first-bar"></span><span class="second-bar"></span></button>
</form>
