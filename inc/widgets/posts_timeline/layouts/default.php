<div class="col-md-4">
	<?php
	if ( ! empty( $instance['title'] ) ) { ?>
        <h2><span><?php echo esc_html( $instance['title'] ); ?></span></h2>
	<?php } ?>
    <div class="newsmag-posts-timeline">
        <ul>
			<?php while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
                <li>
                    <span class="meta"><?php echo esc_html( get_the_date( 'M d, Y' ) ); ?></span>
                    <h3>
                        <a href="<?php echo esc_html( get_the_permalink() ) ?>"><?php echo esc_html( get_the_title() ) ?></a>
                    </h3>
                </li>
			<?php endwhile; ?>
        </ul>
    </div>
</div>