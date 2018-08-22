<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://www.studiopress.com/
 */

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register( $wp_customize ) {

	$images = apply_filters( 'monochrome_images', array( '1', '4' ) );

	$wp_customize->add_section( 'monochrome-settings', array(
		'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 800 pixels tall</strong>.', 'monochrome-pro' ),
		'title'       => __( 'Front Page Background Images', 'monochrome-pro' ),
		'priority'    => 35,
	) );

	foreach( $images as $image ) {

		// Add setting for front page background images.
		$wp_customize->add_setting( $image .'-monochrome-image', array(
			'default'           => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
			'sanitize_callback' => 'esc_url_raw',
			'type'              => 'option',
		) );

		// Add control for front page background images.
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $image .'-monochrome-image', array(
			'label'    => sprintf( __( 'Featured Section %s Image:', 'monochrome-pro' ), $image ),
			'section'  => 'monochrome-settings',
			'settings' => $image .'-monochrome-image',
			'priority' => $image+1,
		) ) );

	}

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		array(
			'default'           => genesis_sample_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'genesis-sample' ),
				'label'       => __( 'Link Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		array(
			'default'           => genesis_sample_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'genesis-sample' ),
				'label'       => __( 'Accent Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_accent_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_logo_width',
		array(
			'default'           => 350,
			'sanitize_callback' => 'absint',
		)
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'genesis_sample_logo_width',
		array(
			'label'       => __( 'Logo Width', 'genesis-sample' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'genesis-sample' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'genesis_sample_logo_width',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 100,
			),

		)
	);

}
