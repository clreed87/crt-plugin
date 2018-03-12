<?php
/*
Plugin Name: CRT Site Specific Plugin
Description: Site specific code changes for Chris Reed Tech project sites
*/
/* Start Adding Functions Below this Line */

//* Create portfolio custom post type
add_action( 'init', 'crt_portfolio_post_type', 0 );
function crt_portfolio_post_type() {

	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'crt' ),
		'singular_name'       => _x( 'Portfolio Project', 'Post Type Singular Name', 'crt' ),
		'menu_name'           => __( 'Portfolio', 'crt' ),
		'name_admin_bar'      => __( 'Portfolio Project', 'crt' ),
		'parent_item_colon'   => __( 'Parent Portfolio Project:', 'crt' ),
		'all_items'           => __( 'All Portfolio Projects', 'crt' ),
		'add_new_item'        => __( 'Add New Portfolio Project', 'crt' ),
		'add_new'             => __( 'Add New', 'crt' ),
		'new_item'            => __( 'New Portfolio Project', 'crt' ),
		'edit_item'           => __( 'Edit Portfolio Project', 'crt' ),
		'update_item'         => __( 'Update Portfolio Project', 'crt' ),
		'view_item'           => __( 'View Portfolio Project', 'crt' ),
		'search_items'        => __( 'Search Portfolio', 'crt' ),
		'not_found'           => __( 'Portfolio Project Not Found', 'crt' ),
		'not_found_in_trash'  => __( 'Portfolio Project Not Found in Trash', 'crt' ),
	);
	$args = array(
		'label'               => __( 'portfolio', 'crt' ),
		'description'         => __( 'Custom post type for portfolio items', 'crt' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'genesis-seo', 'genesis-cpt-archives-settings', 'publicize', 'shortlinks', 'wpcom-markdown'  ),
		'taxonomies'          => array( 'project_type', 'project_feature' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_rest'        => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfolio', $args );

}

//* Create project type custom taxonomy
add_action( 'init', 'crt_project_type_taxonomy', 0 );
function crt_project_type_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'crt' ),
		'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'crt' ),
		'menu_name'                  => __( 'Project Type', 'crt' ),
		'all_items'                  => __( 'All Project Types', 'crt' ),
		'parent_item'                => __( 'Parent Project Type', 'crt' ),
		'parent_item_colon'          => __( 'Parent Project Type:', 'crt' ),
		'new_item_name'              => __( 'New Project Type Name', 'crt' ),
		'add_new_item'               => __( 'Add New Project Type', 'crt' ),
		'edit_item'                  => __( 'Edit Project Type', 'crt' ),
		'update_item'                => __( 'Update Project Type', 'crt' ),
		'view_item'                  => __( 'View Project Type', 'crt' ),
		'separate_items_with_commas' => __( 'Separate project types with commas', 'crt' ),
		'add_or_remove_items'        => __( 'Add or remove project types', 'crt' ),
		'choose_from_most_used'      => __( 'Choose from the most used project types', 'crt' ),
		'popular_items'              => __( 'Popular Project Types', 'crt' ),
		'search_items'               => __( 'Search Project Types', 'crt' ),
		'not_found'                  => __( 'Project Type Not Found', 'crt' ),
	);
	$rewrite = array(
		'slug'                       => 'project-type',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'project_type', array( 'portfolio' ), $args );

}

//* Create project feature custom taxonomy
add_action( 'init', 'crt_project_feature_taxonomy', 0 );
function crt_project_feature_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Project Features', 'Taxonomy General Name', 'crt' ),
		'singular_name'              => _x( 'Project Feature', 'Taxonomy Singular Name', 'crt' ),
		'menu_name'                  => __( 'Project Feature', 'crt' ),
		'all_items'                  => __( 'All Project Features', 'crt' ),
		'parent_item'                => __( 'Parent Project Feature', 'crt' ),
		'parent_item_colon'          => __( 'Parent Project Feature:', 'crt' ),
		'new_item_name'              => __( 'New Project Feature Name', 'crt' ),
		'add_new_item'               => __( 'Add New Project Feature', 'crt' ),
		'edit_item'                  => __( 'Edit Project Feature', 'crt' ),
		'update_item'                => __( 'Update Project Feature', 'crt' ),
		'view_item'                  => __( 'View Project Feature', 'crt' ),
		'separate_items_with_commas' => __( 'Separate project features with commas', 'crt' ),
		'add_or_remove_items'        => __( 'Add or remove project features', 'crt' ),
		'choose_from_most_used'      => __( 'Choose from the most used project features', 'crt' ),
		'popular_items'              => __( 'Popular Project Features', 'crt' ),
		'search_items'               => __( 'Search Project Features', 'crt' ),
		'not_found'                  => __( 'Project Feature Not Found', 'crt' ),
	);
	$rewrite = array(
		'slug'                       => 'project-feature',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'project_feature', array( 'portfolio' ), $args );

}

//* Only support featured images on portfolio post types
add_action( 'after_setup_theme', 'crt_remove_featured_images' );
function crt_remove_featured_images() {

	// Remove support for post thumbnails on all post types
	remove_theme_support( 'post-thumbnails' );

	// Re-enable support for just portfolio items
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

//* Change permalink to external URL in RSS feed for link posts
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
		'contact-form',
		'enhanced-distribution',
		'json-api',
		'manage',
		'markdown',
		'monitor',
		'notes',
		'photon',
		'protect',
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
    if ( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {
    	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    }
	return $value;
}

/* Stop Adding Functions Below this Line */
?>