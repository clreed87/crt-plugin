<?php
/*
Plugin Name: CRT Site Specific Plugin
Description: Site specific code changes for Chris Reed Tech project sites
*/
/* Start Adding Functions Below this Line */

//* Create portfolio custom post type
add_action( 'init', 'crt_portfolio_post_type' );
function crt_portfolio_post_type() {

	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'          => __( 'Portfolio', 'crt' ),
				'singular_name' => __( 'Portfolio', 'crt' ),
			),
			'has_archive'         => true,
			'hierarchical'        => true,
			'menu_icon'           => 'dashicons-portfolio',
			'public'              => true,
			'rewrite'             => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes', 'genesis-seo', 'genesis-cpt-archives-settings' ),
			'taxonomies'    => array( 'project_type', 'project_feature' ),
		)
	);

}

//* Create project type custom taxonomy
add_action( 'init', 'crt_project_type_taxonomy' );
function crt_project_type_taxonomy() {

	$labels = array(
		'name' => _x( 'Project Types', 'crt' ),
		'singular_name' => _x( 'Project Type', 'crt' ),
		'search_items' => _x( 'Search Project Types', 'crt' ),
		'popular_items' => _x( 'Popular Project Types', 'crt' ),
		'all_items' => _x( 'All Project Types', 'crt' ),
		'parent_item' => _x( 'Parent Project Type', 'crt' ),
		'parent_item_colon' => _x( 'Parent Project Type:', 'crt' ),
		'edit_item' => _x( 'Edit Project Type', 'crt' ),
		'update_item' => _x( 'Update Project Type', 'crt' ),
		'add_new_item' => _x( 'Add New Project Type', 'crt' ),
		'new_item_name' => _x( 'New Project Type', 'crt' ),
		'separate_items_with_commas' => _x( 'Separate project types with commas', 'crt' ),
		'add_or_remove_items' => _x( 'Add or remove project types', 'crt' ),
		'choose_from_most_used' => _x( 'Choose from the most used project types', 'crt' ),
		'menu_name' => _x( 'Project Types', 'crt' ),
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'show_admin_column' => true,
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'project-type', 'with_front' => false ),
		'query_var' => true
	);

	register_taxonomy( 'project_type', array('portfolio'), $args );
}

//* Create project feature custom taxonomy
add_action( 'init', 'crt_project_feature_taxonomy' );
function crt_project_feature_taxonomy() {

	$labels = array(
		'name' => _x( 'Project Features', 'crt' ),
		'singular_name' => _x( 'Project Feature', 'crt' ),
		'search_items' => _x( 'Search Project Features', 'crt' ),
		'popular_items' => _x( 'Popular Project Features', 'crt' ),
		'all_items' => _x( 'All Project Features', 'crt' ),
		'parent_item' => _x( 'Parent Project Feature', 'crt' ),
		'parent_item_colon' => _x( 'Parent Project Feature:', 'crt' ),
		'edit_item' => _x( 'Edit Project Feature', 'crt' ),
		'update_item' => _x( 'Update Project Feature', 'crt' ),
		'add_new_item' => _x( 'Add New Project Feature', 'crt' ),
		'new_item_name' => _x( 'New Project Feature', 'crt' ),
		'separate_items_with_commas' => _x( 'Separate project features with commas', 'crt' ),
		'add_or_remove_items' => _x( 'Add or remove project features', 'crt' ),
		'choose_from_most_used' => _x( 'Choose from most used project features', 'crt' ),
		'menu_name' => _x( 'Project Features', 'crt' ),
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'show_admin_column' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'project-feature', 'with_front' => false ),
		'query_var' => true
	);

	register_taxonomy( 'project_feature', array('portfolio'), $args );
}

//* Add portfolio taxonomies to columns
add_filter( 'manage_taxonomies_for_portfolio_columns', 'crt_portfolio_columns' );
function crt_portfolio_columns( $taxonomies ) {

	$taxonomies[] = 'project_type';
	$taxonomies[] = 'project_technology';
	return $taxonomies;

}

//* Only support featured images on post and portfolio post types
add_action( 'after_setup_theme', 'crt_remove_featured_images', 11 );
function crt_remove_featured_images() {

	// This will remove support for post thumbnails on ALL Post Types
	remove_theme_support( 'post-thumbnails' );

	// Add this line in to re-enable support for just Posts and Portfolio
	add_theme_support( 'post-thumbnails', array( 'portfolio' ) );
}

//* Limit number of post revisions to keep
add_filter( 'wp_revisions_to_keep', 'crt_limit_revisions', 10, 2 );
function crt_limit_revisions( $num, $post ) {
	$num = 5;
	return $num;
}

//* Add support for link post format
add_theme_support( 'post-formats', array(
		'link',
	) );

//* Change post titles in RSS feed for link and sponsored posts
add_filter( 'the_title_rss', 'crt_change_feed_post_title' );
function crt_change_feed_post_title( $title ) {
	$link_url = get_field( 'link_url' );
	$sponsored_post = get_field( 'sponsored_post' );
	if ( has_post_format( 'link' )  && ( $sponsored_post == true ) && !empty( $link_url ) ) {
		$title = get_the_title().' [Sponsor] →';
		return $title;
	}
	else if ( has_post_format( 'link' )  && !empty( $link_url ) ) {
		$title = get_the_title().' →';
		return $title;
	}
	else {
		return $title;
	}
}

//* Changle permalink to external URL in RSS feed for link posts
add_filter( 'the_permalink_rss', 'crt_change_feed_permalink' );
function crt_change_feed_permalink( $permalink ) {
	$link_url = get_field( 'link_url' );
	if ( has_post_format( 'link' )  && !empty( $link_url ) ) {
		$permalink = $link_url;
		return $permalink;
	}
	else {
		return $permalink;
	}
}

//* Add link to post permalink and source in RSS feed for link posts
add_filter( 'the_content_feed', 'crt_feed_permalink' );
function crt_feed_permalink( $content ) {
	$link_url = get_field( 'link_url' );
	if ( has_post_format( 'link' )  && !empty( $link_url ) ) {
		$link_source = get_field( 'link_source' );
		if ( !empty( $link_source ) ) {
			$content .= 'Source: <a href="'.$link_url.'">'.$link_source.'</a><br>';
		}
		$content .= '<a href="'.get_permalink().'">☍ Permalink</a>';
		return $content;
	}
	else {
		return $content;
	}
}

/**
 * An array of Jetpack modules which will be whitelisted.
 *
 * This whitelist contains a list of all Jetpack modules which we would like users
 * to have access to. Anything not listed here will be programmatically disabled.
 */
function crt_jetpack_whitelist() {
	$whitelist = array(
		'carousel',
		'enhanced-distribution',
		'json-api',
		'markdown',
		'monitor',
		'notes',
		'photon',
		'publicize',
		'shortlinks',
		'stats',
		'tiled-gallery',
	);

	return $whitelist;
}

add_filter( 'jetpack_get_available_modules', 'crt_make_non_whitelisted_unavailable' );
/**
 * Make all non-whitelisted Jetpack modules unavailable.
 *
 * This will prevent all non-whitelisted Jetpack modules from displaying.
 * As long as this is in use only whitelisted modules can be seen by the user.
 *
 */
function crt_make_non_whitelisted_unavailable( $modules ) {

	$whitelist = crt_jetpack_whitelist();

	$modules = array_intersect_key( $modules, array_flip( $whitelist ) );

	return $modules;
}


add_action( 'init', 'crt_force_deactivate_non_whitelisted' );
/**
 * Force disable all non-whitelisted Jetpack modules.
 *
 * This will force all non-whitelisted Jetpack modules to be disabled.
 * As long as this is in use, only whitelisted modules can be activated.
 *
 */
function crt_force_deactivate_non_whitelisted() {
	if ( ! class_exists( 'Jetpack_Options' ) ) {
		return;
	}

	$whitelist = crt_jetpack_whitelist();

	Jetpack_Options::update_option( 'active_modules', array_unique( $whitelist ) );
}

//* Ignore updates for Advanced Custom Fields
add_filter( 'site_transient_update_plugins', 'crt_filter_plugin_updates' );
function crt_filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}

/* Stop Adding Functions Below this Line */
?>