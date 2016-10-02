<?php
if ( $posts->have_posts() ):

	$i = 0; ?>
	<div class="col-md-4">
	<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php $category = get_the_category();
			if ( $i == 0 ) {
				$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/images/picture_placeholder.jpg" />';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
				}
				$new_image = $image;
				?>
				<div class="newsmag-post-box-a">
					<?php if ( ! empty( $instance['title'] ) ) { ?>
						<h2 class="colored"><?php echo $instance['title']; ?></h2>
					<?php } else { ?>
						<h2 class="colored"><a href="<?php $category[0]->link ?>"><?php echo $category[0]->name ?></a>
						</h2>
					<?php } ?>
					<a class="newsmag-post-box-image" href="<?php echo get_the_permalink(); ?>">
						<?php echo $new_image ?>
						<span class="newsmag-post-box-a-category"><?php echo $category[0]->name ?></span>
					</a>
					<h3>
						<a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<span class="colored fa fa-clock-o"></span> <?php echo get_the_date(); ?>
					<p><?php echo wp_trim_words( get_the_content(), 20, ' <a href="' . get_the_permalink() . '">…</a>' ) ?></p>
				</div>
				<?php
			} else {
				$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/images/picture_placeholder_list.jpg" />';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
				}
				$new_image = $image;
				?>
				<div class="newsmag-blog-post-layout-b">
					<div class="row">
						<div class="col-sm-3 col-xs-4">
							<div class="newsmag-image">
								<a href="<?php echo get_the_permalink(); ?>">
									<?php echo $new_image ?>
								</a>
							</div>
						</div>
						<div class="col-sm-9 col-xs-8">
							<div class="newsmag-title">
								<h3>
									<a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
								</h3>
								<span class="colored fa fa-clock-o"></span> <?php echo get_the_date(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			$i ++; ?>
	<?php endwhile; ?>
	</div>
<?php endif; ?>