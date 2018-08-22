<?php

add_action( 'genesis_meta', 'masa_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function masa_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' )) {

		// Enqueue scripts and styles.
		add_action( 'wp_enqueue_scripts', 'masa_enqueue_front_script_styles', 1 );

		// Add front-page body class.
		add_filter( 'body_class', 'masa_body_class' );

		// Force full width content layout.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add front page widgets.
		add_action( 'genesis_before_loop', 'masa_front_page_widgets' );

	}

}

// Define scripts and styles.
function masa_enqueue_front_script_styles() {

	wp_enqueue_style( 'masa-front-styles', get_stylesheet_directory_uri() . '/style-front.css' );

}

// Add front-page body class.
function masa_body_class( $classes ) {

	$classes[] = 'front-page';

	return $classes;

}


// Add markup for front page widgets.
function masa_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', 'genesis-sample' ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div class="front-page-1"><div class="flexible-widgets widget-area' . masa_widget_area_class( 'front-page-1' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div class="front-page-2"><div class="flexible-widgets widget-area' . masa_widget_area_class( 'front-page-2' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div class="front-page-3"><div class="flexible-widgets widget-area' . masa_widget_area_class( 'front-page-3' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div class="front-page-4"><div class="flexible-widgets widget-area' . masa_widget_area_class( 'front-page-4' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-5', array(
		'before' => '<div class="front-page-5"><div class="flexible-widgets widget-area' . masa_widget_area_class( 'front-page-5' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

}

// Run the Genesis loop.
genesis();
