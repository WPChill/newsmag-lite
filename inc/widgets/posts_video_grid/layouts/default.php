<div class="col-md-4">
	<?php
	if ( ! empty( $instance['title'] ) ) { ?>
        <h2><span><?php echo esc_html( $instance['title'] ); ?></span></h2>
	<?php } ?>
    <div class="row">
		<?php
		$i = 0;
		while ( $new_query->have_posts() ) : $new_query->the_post();
			$i ++;
			if ( ! newsmag_get_first_media( get_the_ID() ) ) {
				continue;
			}
			?>
            <div class="col-md-6 col-xs-12">
                <div class="newsmag-post-format-video"><?php echo newsmag_get_first_media( get_the_ID() ) ?>
                    <div class="meta">
                        <span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date('M d, Y') ); ?>
		                <?php if ( current_user_can( 'manage_options' ) ) { ?>
                            <a class="newsmag-comments-link " target="_blank"
                               href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit' ?>">
                                <span class="fa fa-edit"></span> <?php echo __( 'Edit', 'newsmag' ) ?>
                            </a>
		                <?php } ?>
                    </div>
                    <h3>
                        <a href="<?php echo get_the_permalink( get_the_ID() ) ?>"><?php echo esc_html( get_the_title() ) ?></a>
                    </h3>
                </div>
            </div>

			<?php
			if ( fmod( $i, 2 ) == 0 && $i != (int) $new_query->post_count ) {
				echo '</div><div class="row">';
			} elseif ( $i == (int) $new_query->post_count ) {
				continue;
			}
			?>

		<?php endwhile; ?>
    </div>
</div>