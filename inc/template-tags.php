<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Newsmag
 */

if ( ! function_exists( 'newsmag_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function newsmag_posted_on( $element = 'default' ) {
		$cat       = get_the_category();
		$comments  = wp_count_comments( get_the_ID() );
		$date      = get_the_date();
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'newsmag' ) );

		$html = '<ul>';
		if ( ! empty( $cat ) ) {
			$html .= '<li class="post-category"><icon class="fa fa-folder"></icon> <a href="' . esc_url( get_category_link( $cat[0]->term_id ) ) . '">' . get_the_category_by_ID( $cat[0]->term_id ) . '</a></li>';
		}
		$html .= '<li class="post-comments"><icon class="fa fa-comments"></icon> ' . esc_html( $comments->approved ) . ' </li>';
		$html .= '<li class="post-date">' . $date . ' </li>';
		if ( $tags_list ) {
			$html .= '<li class="post-tags"><icon class="fa fa-tags"></icon> ' . esc_html( $tags_list ) . '</li>';
		}
		$html .= '</ul>';

		switch ( $element ) {
			case 'category':
				echo '<a href="' . esc_url( get_category_link( $cat[0]->term_id ) ) . '">' . get_the_category_by_ID( $cat[0]->term_id ) . '</a>';
				break;
			case 'comments':
				echo '<a class="newsmag-comments-link" href="' . get_the_permalink( get_the_ID() ) . '/#comments"><span class=" fa fa-comment-o"></span> ' . esc_html( $comments->approved ) . '</a>';
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
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function newsmag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'newsmag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			                                     'fields'     => 'ids',
			                                     'hide_empty' => 1,
			                                     // We only need to know if there is more than one category.
			                                     'number'     => 2,
		                                     ) );

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
 * Flush out the transients used in newsmag_categorized_blog.
 */
function newsmag_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'newsmag_categories' );
}

add_action( 'edit_category', 'newsmag_category_transient_flusher' );
add_action( 'save_post', 'newsmag_category_transient_flusher' );


function newsmag_the_posts_navigation( $args = array() ) {
	echo get_the_posts_navigation( $args );
}

function newsmag_remove_from_archive_title( $title ) {
	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>';

	}

	return $title;
}

add_filter( 'get_the_archive_title', 'newsmag_remove_from_archive_title' );

/**
 * Filter the categories widget to add a <span> element before the count
 *
 * @param $links
 *
 * @return mixed
 */
function newsmag_add_span_cat_count( $links ) {
	$links = str_replace( '</a> (', '</a> <span class="newsmag-cat-count">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}

add_filter( 'wp_list_categories', 'newsmag_add_span_cat_count' );

function newsmag_add_span_archive_count( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a> <span class="newsmag-cat-count">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}

add_filter( 'get_archives_link', 'newsmag_add_span_archive_count' );