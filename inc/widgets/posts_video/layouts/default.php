<div class="col-md-4">
	<?php
	if ( ! empty( $instance['title'] ) ) { ?>
        <h2><span><?php echo esc_html( $instance['title'] ); ?></span></h2>
	<?php } ?>

	<?php
	while ( $new_query->have_posts() ) : $new_query->the_post();
		if ( ! newsmag_get_first_media( get_the_ID() ) ) {
			continue;
		}
		echo '<div class="newsmag-post-format-video">' . newsmag_get_first_media( get_the_ID() ) . '<h3><a href="' . get_the_permalink( get_the_ID() ) . '">' . esc_html( get_the_title() ) . '</a></h3></div>';
	endwhile;
	?>
</div>