<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
class Newsmag_Helper {
	/**
	 * Get an attachment ID given a URL.
	 *
	 * @param string $url
	 *
	 * @return int Attachment ID on success, 0 on failure
	 */
	public static function get_attachment_id( $url ) {
		$attachment_id = 0;
		$dir           = wp_upload_dir();
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file       = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				),
			);
			$query      = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta                = wp_get_attachment_metadata( $post_id );
					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
			}
		}

		return (int) $attachment_id;
	}

	public static function check_archive() {

		$return = array(
			'type' => null,
			'id'   => null,
		);

		if ( is_category() ) {
			$return['type'] = 'category';
			$category       = get_category( get_query_var( 'cat' ) );
			$return['id']   = $category->cat_ID;
		}

		if ( is_tag() ) {
			$return['type'] = 'tags';
			$tags           = get_tags();
			$return['id']   = $tags[0]->term_id;
		}

		if ( is_day() ) {
			$return['type'] = 'day';
			$day            = get_query_var( 'day' );
			$return['id']   = $day;
		}

		if ( is_month() ) {
			$return['type'] = 'month';
			$month          = get_query_var( 'monthnum' );
			$return['id']   = $month;
		}

		if ( is_year() ) {
			$return['type'] = 'year';
			$year           = get_query_var( 'year' );
			$return['id']   = $year;
		}

		return $return;
	}

	/**
	 * @param string $format
	 *
	 * @return bool|mixed
	 */
	public static function format_icon( $format = 'standard' ) {
		if ( 'standard' === $format ) {
			return false;
		}

		$icons = array(
			'aside'   => 'nmicon-hashtag',
			'image'   => 'nmicon-picture-o',
			'quote'   => 'nmicon-quote-left',
			'link'    => 'nmicon-link',
			'gallery' => 'nmicon-th-large',
			'video'   => 'nmicon-video-camera',
			'status'  => 'nmicon-heartbeat',
			'audio'   => 'nmicon-headphones',
			'chat'    => 'nmicon-comment-o',
		);

		return $icons[ $format ];
	}

	/**
	 * Render the breadcrumbs with help of class-breadcrumbs.php
	 *
	 * @return void
	 */
	public static function add_breadcrumbs() {
		$breadcrumbs = new Newsmag_Breadcrumbs();
		$breadcrumbs->get_breadcrumbs();
	}

	/**
	 * @param $image_object
	 *
	 * @return array
	 */
	public static function get_lazy_image( $image_object ) {

		$lazy = get_theme_mod( 'newsmag_enable_blazy', '' );
		$img  = $image_object['image'];

		if ( $lazy ) {
			$img = apply_filters( 'newsmag_widget_image', $image_object );
		}

		$allowed_tags = array(
			'img'      => array(
				'data-srcset' => true,
				'data-src'    => true,
				'srcset'      => true,
				'sizes'       => true,
				'src'         => true,
				'class'       => true,
				'alt'         => true,
				'width'       => true,
				'height'      => true,
			),
			'noscript' => array(),
		);

		return array(
			'image' => $img,
			'tags'  => $allowed_tags,
		);
	}

	public static function get_first_media( $post_id ) {
		$post    = get_post( $post_id );
		$content = do_shortcode( apply_filters( 'the_content', $post->post_content, 1 ) );
		$embeds  = get_media_embedded_in_content( $content );
		$href    = '';
		$type    = '';
		$html    = '';

		if ( empty( $embeds ) ) {
			return false;
		}

		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'youtube' ) ) {
				preg_match( '/src="([^"]+)"/', $embed, $match );
				$href = $match[1];

				$type = 'youtube';
			} elseif ( strpos( $embed, 'vimeo' ) ) {
				preg_match( '/src="([^"]+)"/', $embed, $match );
				$href = $match[1];

				$type = 'vimeo';
			} else {
				$element = new SimpleXMLElement( $embeds[0] );
				$href    = '';
				if ( ! empty( $element->a ) ) {
					$href = (string) $element->a->attributes()->href;
				}
				$type = 'local';
			}
		}

		if ( ! empty( $href ) ) {
			switch ( $type ) {
				case 'local':
					$html  = '<div>';
					$html .= '<video class="plyr">';
					$html .= '<source src=' . $href . '>';
					$html .= '</video>';
					$html .= '</div>';
					break;
				default:
					$html  = '<div class="plyr" data-type="' . $type . '" data-video-id="' . $href . '">';
					$html .= '</div>';
					break;
			}

			return $html;
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public static function on_iis() {
		$s_software = strtolower( $_SERVER['SERVER_SOFTWARE'] );
		if ( strpos( $s_software, 'microsoft-iis' ) !== false ) {
			return true;
		}

		return false;
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	public static function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'newsmag_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'newsmag_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so newsmag_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so newsmag_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * @param array $args
	 */
	public static function the_posts_navigation( $args = array() ) {
		echo get_the_posts_navigation( $args );
	}

	/**
	 * @param $hex
	 * @param $steps
	 *
	 * @return string
	 */
	public static function adjust_brightness( $hex, $steps ) {
		$steps = max( - 255, min( 255, $steps ) );
		$hex   = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		$color_parts = str_split( $hex, 2 );
		$return      = '#';
		foreach ( $color_parts as $color ) {
			$color   = hexdec( $color ); // Convert to decimal
			$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}

	/**
	 * @param string $element
	 */
	public static function posted_on( $element = 'default' ) {
		$cat       = get_the_category();
		$comments  = wp_count_comments( get_the_ID() );
		$date      = get_the_date();
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'newsmag' ) );

		$html = '<ul>';
		if ( ! empty( $cat ) ) {
			$html .= '<li class="post-category"><icon class="nmicon-folder"></icon> <a href="' . esc_url( get_category_link( $cat[0]->term_id ) ) . '">' . get_the_category_by_ID( $cat[0]->term_id ) . '</a></li>';
		}
		$html .= '<li class="post-comments"><icon class="nmicon-comments"></icon> ' . esc_html( $comments->approved ) . ' </li>';
		$html .= '<li class="post-date">' . $date . ' </li>';
		if ( $tags_list ) {
			$html .= '<li class="post-tags"><icon class="nmicon-tags"></icon> ' . esc_html( $tags_list ) . '</li>';
		}
		$html .= '</ul>';

		switch ( $element ) {
			case 'category':
				echo '<a href="' . esc_url( get_category_link( $cat[0]->term_id ) ) . '">' . get_the_category_by_ID( $cat[0]->term_id ) . '</a>';
				break;
			case 'comments':
				echo '<a class="newsmag-comments-link" href="' . get_the_permalink( get_the_ID() ) . '#comments"><span class=" nmicon-comment-o"></span> ' . esc_html( $comments->approved ) . '</a>';
				break;
			case 'date':
				echo '<div class="newsmag-date">' . esc_html( $date ) . '</div>';
				break;
			case 'tags':
				echo ! empty( $tags_list ) ? '<div class="newsmag-tags"><strong>' . __( 'TAGS: ', 'newsmag' ) . '</strong>' . $tags_list . '</div>' : '';
				break;
			default:
				echo $html;
				break;
		}
	}
}
