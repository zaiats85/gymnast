<?php
/**
 * Post Type Functions
 *
 * @package     MDLWP_Portfolio
 * @subpackage  Functions
 * @copyright   Copyright (c) 2015,
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registers and sets up the Portfolios custom post type
 *
 * @since 1.0
 * @return void
 */
function mdlwp_portfolio_setup_post_types() {

	$archives = defined( 'MDLWP_PORTFOLIO_DISABLE_ARCHIVE' ) && MDLWP_PORTFOLIO_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'MDLWP_PORTFOLIO_SLUG' ) ? MDLWP_PORTFOLIO_SLUG : 'portfolio';
	$rewrite  = defined( 'MDLWP_PORTFOLIO_DISABLE_REWRITE' ) && MDLWP_PORTFOLIO_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

	$portfolio_labels =  apply_filters( 'mdlwp_portfolio_portfolio_labels', array(
		'name'               => _x( '%2$s', 'portfolio post type name', 'mdlwp-portfolio' ),
		'singular_name'      => _x( '%1$s', 'singular portfolio post type name', 'mdlwp-portfolio' ),
		'add_new'            => __( 'Add New', 'mdlwp-portfolio' ),
		'add_new_item'       => __( 'Add New %1$s', 'mdlwp-portfolio' ),
		'edit_item'          => __( 'Edit %1$s', 'mdlwp-portfolio' ),
		'new_item'           => __( 'New %1$s', 'mdlwp-portfolio' ),
		'all_items'          => __( '%2$s Items', 'mdlwp-portfolio' ),
		'view_item'          => __( 'View %1$s', 'mdlwp-portfolio' ),
		'search_items'       => __( 'Search %2$s', 'mdlwp-portfolio' ),
		'not_found'          => __( 'No %2$s found', 'mdlwp-portfolio' ),
		'not_found_in_trash' => __( 'No %2$s found in Trash', 'mdlwp-portfolio' ),
		'parent_item_colon'  => '',
		'menu_name'          => _x( '%2$s', 'portfolio post type menu name', 'mdlwp-portfolio' )
	) );

	foreach ( $portfolio_labels as $key => $value ) {
	   $portfolio_labels[ $key ] = sprintf( $value, mdlwp_portfolio_get_label_singular(), mdlwp_portfolio_get_label_plural() );
	}

	$portfolio_args = array(
		'labels'             => $portfolio_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => $rewrite,
		'map_meta_cap'       => true,
		'has_archive'        => $archives,
		'hierarchical'       => false,
		'supports'           => apply_filters( 'mdlwp_portfolio_portfolio_supports', array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author' ) ),
	);
	register_post_type( 'portfolio', apply_filters( 'mdlwp_portfolio_portfolio_post_type_args', $portfolio_args ) );

}
add_action( 'init', 'mdlwp_portfolio_setup_post_types', 1 );

/**
 * Get Default Labels
 *
 * @since 1.0.8.3
 * @return array $defaults Default labels
 */
function mdlwp_portfolio_get_default_labels() {
	$defaults = array(
	   'singular' => __( 'Portfolio', 'mdlwp-portfolio' ),
	   'plural'   => __( 'Portfolio', 'mdlwp-portfolio')
	);
	return apply_filters( 'mdlwp_portfolio_default_portfolios_name', $defaults );
}

/**
 * Get Singular Label
 *
 * @since 1.0.8.3
 *
 * @param bool $lowercase
 * @return string $defaults['singular'] Singular label
 */
function mdlwp_portfolio_get_label_singular( $lowercase = false ) {
	$defaults = mdlwp_portfolio_get_default_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

/**
 * Get Plural Label
 *
 * @since 1.0.8.3
 * @return string $defaults['plural'] Plural label
 */
function mdlwp_portfolio_get_label_plural( $lowercase = false ) {
	$defaults = mdlwp_portfolio_get_default_labels();
	return ( $lowercase ) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

/**
 * Change default "Enter title here" input
 *
 * @since 1.4.0.2
 * @param string $title Default title placeholder text
 * @return string $title New placeholder text
 */
function mdlwp_portfolio_change_default_title( $title ) {
	 // If a frontend plugin uses this filter (check extensions before changing this function)
	 if ( !is_admin() ) {
		$label = mdlwp_portfolio_get_label_singular();
		$title = sprintf( __( 'Enter %s name here', 'mdlwp-portfolio' ), $label );
		return $title;
	 }

	 $screen = get_current_screen();

	 if ( 'portfolio' == $screen->post_type ) {
		$label = mdlwp_portfolio_get_label_singular();
		$title = sprintf( __( 'Enter %s name here', 'mdlwp-portfolio' ), $label );
	 }

	 return $title;
}
add_filter( 'enter_title_here', 'mdlwp_portfolio_change_default_title' );

/**
 * Registers the custom taxonomies for the portfolios custom post type
 *
 * @since 1.0
 * @return void
*/
function mdlwp_portfolio_setup_taxonomies() {

	$slug     = defined( 'MDLWP_PORTFOLIO_SLUG' ) ? MDLWP_PORTFOLIO_SLUG : 'portfolio';

	/** Categories */
	$category_labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'mdlwp-portfolio' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'mdlwp-portfolio' ),
		'search_items'      => __( 'Search Categories', 'mdlwp-portfolio'  ),
		'all_items'         => __( 'All Categories', 'mdlwp-portfolio'  ),
		'parent_item'       => __( 'Parent Category', 'mdlwp-portfolio'  ),
		'parent_item_colon' => __( 'Parent Category:', 'mdlwp-portfolio'  ),
		'edit_item'         => __( 'Edit Category', 'mdlwp-portfolio'  ),
		'update_item'       => __( 'Update Category', 'mdlwp-portfolio'  ),
		'add_new_item'      => sprintf( __( 'Add New %s Category', 'mdlwp-portfolio'  ), mdlwp_portfolio_get_label_singular() ),
		'new_item_name'     => __( 'New Category Name', 'mdlwp-portfolio'  ),
		'menu_name'         => __( 'Categories', 'mdlwp-portfolio'  ),
	);

	$category_args = apply_filters( 'mdlwp_portfolio_portfolio_category_args', array(
			'hierarchical' => true,
			'labels'       => apply_filters('mdlwp_portfolio_portfolio_category_labels', $category_labels),
			'show_ui'      => true,
			'query_var'    => 'portfolio_category',
			'rewrite'      => array('slug' => $slug . '/category', 'with_front' => false, 'hierarchical' => true )
		)
	);
	register_taxonomy( 'portfolio_category', array('portfolio'), $category_args );
	register_taxonomy_for_object_type( 'portfolio_category', 'portfolio' );

	/** Tags */
	$tag_labels = array(
		'name'                  => _x( 'Tags', 'taxonomy general name', 'mdlwp-portfolio' ),
		'singular_name'         => _x( 'Tag', 'taxonomy singular name', 'mdlwp-portfolio' ),
		'search_items'          => __( 'Search Tags', 'mdlwp-portfolio'  ),
		'all_items'             => __( 'All Tags', 'mdlwp-portfolio'  ),
		'parent_item'           => __( 'Parent Tag', 'mdlwp-portfolio'  ),
		'parent_item_colon'     => __( 'Parent Tag:', 'mdlwp-portfolio'  ),
		'edit_item'             => __( 'Edit Tag', 'mdlwp-portfolio'  ),
		'update_item'           => __( 'Update Tag', 'mdlwp-portfolio'  ),
		'add_new_item'          => __( 'Add New Tag', 'mdlwp-portfolio'  ),
		'new_item_name'         => __( 'New Tag Name', 'mdlwp-portfolio'  ),
		'menu_name'             => __( 'Tags', 'mdlwp-portfolio'  ),
		'choose_from_most_used' => sprintf( __( 'Choose from most used %s tags', 'mdlwp-portfolio'  ), mdlwp_portfolio_get_label_singular() ),
	);

	$tag_args = apply_filters( 'mdlwp_portfolio_portfolio_tag_args', array(
			'hierarchical' => false,
			'labels'       => apply_filters( 'mdlwp_portfolio_portfolio_tag_labels', $tag_labels ),
			'show_ui'      => true,
			'query_var'    => 'portfolio_tag',
			'rewrite'      => array( 'slug' => $slug . '/tag', 'with_front' => false, 'hierarchical' => true  )
		)
	);
	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $tag_args );
	register_taxonomy_for_object_type( 'portfolio_tag', 'portfolio' );
}
add_action( 'init', 'mdlwp_portfolio_setup_taxonomies', 0 );

/**
 * Get the singular and plural labels for a portfolio taxonomy
 *
 * @since  2.4
 * @param  string $taxonomy The Taxonomy to get labels for
 * @return array            Associative array of labels (name = plural)
 */
function mdlwp_portfolio_get_taxonomy_labels( $taxonomy = 'portfolio_category' ) {

	$allowed_taxonomies = apply_filters( 'mdlwp_portfolio_allowed_portfolio_taxonomies', array( 'portfolio_category', 'portfolio_tag' ) );

	if ( ! in_array( $taxonomy, $allowed_taxonomies ) ) {
		return false;
	}

	$labels   = array();
	$taxonomy = get_taxonomy( $taxonomy );

	if ( false !== $taxonomy ) {
		$singular = $taxonomy->labels->singular_name;
		$name     = $taxonomy->labels->name;

		$labels = array(
			'name'          => $name,
			'singular_name' => $singular,
		);
	}

	return apply_filters( 'mdlwp_portfolio_get_taxonomy_labels', $labels, $taxonomy );

}

/**
 * Updated Messages
 *
 * Returns an array of with all updated messages.
 *
 * @since 1.0
 * @param array $messages Post updated message
 * @return array $messages New post updated messages
 */
function mdlwp_portfolio_updated_messages( $messages ) {
	global $post, $post_ID;

	$url1 = '<a href="' . get_permalink( $post_ID ) . '">';
	$url2 = mdlwp_portfolio_get_label_singular();
	$url3 = '</a>';

	$messages['portfolio'] = array(
		1 => sprintf( __( '%2$s updated. %1$sView %2$s%3$s.', 'mdlwp-portfolio' ), $url1, $url2, $url3 ),
		4 => sprintf( __( '%2$s updated. %1$sView %2$s%3$s.', 'mdlwp-portfolio' ), $url1, $url2, $url3 ),
		6 => sprintf( __( '%2$s published. %1$sView %2$s%3$s.', 'mdlwp-portfolio' ), $url1, $url2, $url3 ),
		7 => sprintf( __( '%2$s saved. %1$sView %2$s%3$s.', 'mdlwp-portfolio' ), $url1, $url2, $url3 ),
		8 => sprintf( __( '%2$s submitted. %1$sView %2$s%3$s.', 'mdlwp-portfolio' ), $url1, $url2, $url3 )
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'mdlwp_portfolio_updated_messages' );

/**
 * Updated bulk messages
 *
 * @since 2.3
 * @param array $bulk_messages Post updated messages
 * @param array $bulk_counts Post counts
 * @return array $bulk_messages New post updated messages
 */
function mdlwp_portfolio_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	$singular = mdlwp_portfolio_get_label_singular();
	$plural   = mdlwp_portfolio_get_label_plural();

	$bulk_messages['portfolio'] = array(
		'updated'   => sprintf( _n( '%1$s %2$s updated.', '%1$s %3$s updated.', $bulk_counts['updated'], 'mdlwp-portfolio' ), $bulk_counts['updated'], $singular, $plural ),
		'locked'    => sprintf( _n( '%1$s %2$s not updated, somebody is editing it.', '%1$s %3$s not updated, somebody is editing them.', $bulk_counts['locked'], 'mdlwp-portfolio' ), $bulk_counts['locked'], $singular, $plural ),
		'deleted'   => sprintf( _n( '%1$s %2$s permanently deleted.', '%1$s %3$s permanently deleted.', $bulk_counts['deleted'], 'mdlwp-portfolio' ), $bulk_counts['deleted'], $singular, $plural ),
		'trashed'   => sprintf( _n( '%1$s %2$s moved to the Trash.', '%1$s %3$s moved to the Trash.', $bulk_counts['trashed'], 'mdlwp-portfolio' ), $bulk_counts['trashed'], $singular, $plural ),
		'untrashed' => sprintf( _n( '%1$s %2$s restored from the Trash.', '%1$s %3$s restored from the Trash.', $bulk_counts['untrashed'], 'mdlwp-portfolio' ), $bulk_counts['untrashed'], $singular, $plural )
	);

	return $bulk_messages;
}
add_filter( 'bulk_post_updated_messages', 'mdlwp_portfolio_bulk_updated_messages', 10, 2 );
