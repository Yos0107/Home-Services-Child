<?php
/**
 * home_services functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package home_services
 */

/**
* Enqueue Style
*/
add_action( 'wp_enqueue_scripts', 'home_services');
function home_services() {
	wp_enqueue_style( 'home-services-style', get_template_directory_uri(). '/style.css');
	wp_enqueue_style( 'home-services-child-style', get_stylesheet_directory_uri() . '/style.css' );
	// Enqueue Slick Slider CSS
	wp_enqueue_style('slick-slider-css', get_stylesheet_directory_uri() . '/css/slick.css', array(), HOME_SERVICES_VERSION );
	wp_enqueue_style('slick-slider-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', HOME_SERVICES_VERSION );
}

/**
* Enqueue JS
*/
function home_services_custom_js()
{
	wp_enqueue_script('slick-slider-js', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), null, true);
	wp_enqueue_script('custom-slick-slider-js', get_stylesheet_directory_uri() . '/js/custom-slick.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'home_services_custom_js');

require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
* Add New Slider Section In Homepage
*/

add_action( 'customize_register', 'home_services_frontpage_slider_options' );

function home_services_frontpage_slider_options( $wp_customize ) {
	//Slider Section
	$wp_customize->add_section( 'home_services_customize_slider_options', array(
			'title'          => esc_html__( 'Slider', 'home-services' ),
			'priority'       => 3,
			'capability'     => 'edit_theme_options',
			'panel'          =>'home_service_frontpage_settings',
	) );
// Enable/Disable Slider Section
	$wp_customize->add_setting( 'home_services_slider_show_hide', 
	array(
		'default'  =>  false,
		'sanitize_callback' => 'home_services_sanitize_checkbox',
	)
	);

	$wp_customize->add_control( new Home_Services_Toggle_Control( $wp_customize,  'home_services_slider_show_hide', 
	array(
		'label'   =>  esc_html__( 'Show Slider Section', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'home_services_slider_show_hide',
		'type'    => 'home-services-toggle',
	))
	);

	// Enable Autoplay Slider
	$wp_customize->add_setting( 'home_services_slider_autoplay', 
	array(
		'default'  =>  true,
		'sanitize_callback' => 'home_services_sanitize_checkbox',
	)
	);

	$wp_customize->add_control( new Home_Services_Toggle_Control( $wp_customize,  'home_services_slider_autoplay', 
	array(
		'label'   =>  esc_html__( 'Autoplay Slider', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'home_services_slider_autoplay',
		'type'    => 'home-services-toggle',
		'active_callback' => function(){
			return get_theme_mod( 'home_services_slider_show_hide', true );
	},
	))
	);

	// Change Slider Speed
	$wp_customize->add_setting( 'slider_speed', array(
		'default' => 6000,
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control(  'slider_speed', array(
			'label' => esc_html__( 'Slider Speed' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => 'slider_speed',
			'type' => 'number',
			'active_callback' => function() {
					return get_theme_mod('home_services_slider_autoplay', true) && get_theme_mod('home_services_slider_show_hide', true);
			},
	) );

	// First Slider Options
		$wp_customize->add_setting( '1st_slider', array(
			'default' => '',
			'type' => 'home-services-customtext',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Home_Services_Custom_Text( $wp_customize, '1st_slider', array(
			'label' => esc_html__( 'Slider One :', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => '1st_slider',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) ) );

		$wp_customize->add_setting('slider_1st_image', array(
			'transport'         => 'refresh',
			'capability' => 'edit_theme_options',
			'sanitize_callback'     =>  'home_services_sanitize_file',
			'type' => 'theme_mod',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_1st_image', array(
			'label'             => __('First Slider Image', 'home-services'),
			'section'           => 'home_services_customize_slider_options',
			'settings'          => 'slider_1st_image',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	)));   

	$wp_customize->add_setting( 'title_for_1st_slider', array(
			'sanitize_callback'     =>  'sanitize_text_field',
			'default'               =>  ''
	) );

	$wp_customize->add_control( 'title_for_1st_slider', array(
			'label' => esc_html__( 'First Slider Title', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => 'title_for_1st_slider',
			'type'=> 'text',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	$wp_customize->add_setting( 'content_for_1st_slider', array(
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport' => 'refresh',
			'default' => ''
	) );

	$wp_customize->add_control( 'content_for_1st_slider', array(
			'label' => esc_html__( 'First Slider Description', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => 'content_for_1st_slider',
			'type'=> 'textarea',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	$wp_customize->add_setting( '1st_slider_first_link_label', array(
			'sanitize_callback'     =>  'sanitize_text_field',
			'default'               =>  ''
	) );

	$wp_customize->add_control( '1st_slider_first_link_label', array(
			'label' => esc_html__( 'First Link Label', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => '1st_slider_first_link_label',
			'type'=> 'text',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	$wp_customize->add_setting( '1st_slider_link', array(
			'sanitize_callback'     =>  'esc_url_raw',
			'default'               =>  ''
	) );

	$wp_customize->add_control( '1st_slider_link', array(
			'label' => esc_html__( 'First Link Url', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => '1st_slider_link',
			'type'=> 'url',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	$wp_customize->add_setting( '1st_slider_second_link_label', array(
			'sanitize_callback'     =>  'sanitize_text_field',
			'default'               =>  ''
	) );

	$wp_customize->add_control( '1st_slider_second_link_label', array(
			'label' => esc_html__( 'Second Link Label', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => '1st_slider_second_link_label',
			'type'=> 'text',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	$wp_customize->add_setting( '1st_slider_second_link', array(
			'sanitize_callback'     =>  'esc_url_raw',
	) );

	$wp_customize->add_control( '1st_slider_second_link', array(
			'label' => esc_html__( 'Second Link Url', 'home-services' ),
			'section' => 'home_services_customize_slider_options',
			'settings' => '1st_slider_second_link',
			'type'=> 'url',
			'active_callback' => function(){
					return get_theme_mod( 'home_services_slider_show_hide', true );
			},
	) );

	// Second Slider Options
	$wp_customize->add_setting( '2nd_slider', array(
		'default' => '',
		'type' => 'home-services-customtext',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Home_Services_Custom_Text( $wp_customize, '2nd_slider', array(
		'label' => esc_html__( 'Slider Two :', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '2nd_slider',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) ) );

	$wp_customize->add_setting('slider_2nd_image', array(
		'transport'         => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback'     =>  'home_services_sanitize_file',
		'type' => 'theme_mod',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_2nd_image', array(
		'label'             => __('Second Slider Image', 'home-services'),
		'section'           => 'home_services_customize_slider_options',
		'settings'          => 'slider_2nd_image',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
)));   

$wp_customize->add_setting( 'title_for_2nd_slider', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( 'title_for_2nd_slider', array(
		'label' => esc_html__( 'Second Slider Title', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'title_for_2nd_slider',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( 'content_for_2nd_slider', array(
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport' => 'refresh',
) );

$wp_customize->add_control( 'content_for_2nd_slider', array(
		'label' => esc_html__( 'Second Slider Description', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'content_for_2nd_slider',
		'type'=> 'textarea',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '2nd_slider_first_link_label', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( '2nd_slider_first_link_label', array(
		'label' => esc_html__( 'First Link Label', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '2nd_slider_first_link_label',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '2nd_slider_link', array(
		'sanitize_callback'     =>  'esc_url_raw',
) );

$wp_customize->add_control( '2nd_slider_link', array(
		'label' => esc_html__( 'First Link Url', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '2nd_slider_link',
		'type'=> 'url',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '2nd_slider_second_link_label', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( '2nd_slider_second_link_label', array(
		'label' => esc_html__( 'Second Link Label', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '2nd_slider_second_link_label',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '2nd_slider_second_link', array(
		'sanitize_callback'     =>  'esc_url_raw',
) );

$wp_customize->add_control( '2nd_slider_second_link', array(
		'label' => esc_html__( 'Second Link Url', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '2nd_slider_second_link',
		'type'=> 'url',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

	// Third Slider Options
	$wp_customize->add_setting( '3rd_slider', array(
		'default' => '',
		'type' => 'home-services-customtext',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Home_Services_Custom_Text( $wp_customize, '3rd_slider', array(
		'label' => esc_html__( 'Slider Three :', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '3rd_slider',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) ) );

	$wp_customize->add_setting('slider_3rd_image', array(
		'transport'         => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback'     =>  'home_services_sanitize_file',
		'type' => 'theme_mod',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_3rd_image', array(
		'label'             => __('Third Slider Image', 'home-services'),
		'section'           => 'home_services_customize_slider_options',
		'settings'          => 'slider_3rd_image',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
)));   

$wp_customize->add_setting( 'title_for_3rd_slider', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( 'title_for_3rd_slider', array(
		'label' => esc_html__( 'Third Slider Title', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'title_for_3rd_slider',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( 'content_for_3rd_slider', array(
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport' => 'refresh',
) );

$wp_customize->add_control( 'content_for_3rd_slider', array(
		'label' => esc_html__( 'Third Slider Description', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => 'content_for_3rd_slider',
		'type'=> 'textarea',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '3rd_slider_first_link_label', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( '3rd_slider_first_link_label', array(
		'label' => esc_html__( 'First Link Label', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '3rd_slider_first_link_label',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '3rd_slider_link', array(
		'sanitize_callback'     =>  'esc_url_raw',
) );

$wp_customize->add_control( '3rd_slider_link', array(
		'label' => esc_html__( 'First Link Url', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '3rd_slider_link',
		'type'=> 'url',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '3rd_slider_second_link_label', array(
		'sanitize_callback'     =>  'sanitize_text_field',
		'default'               =>  ''
) );

$wp_customize->add_control( '3rd_slider_second_link_label', array(
		'label' => esc_html__( 'Second Link Label', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '3rd_slider_second_link_label',
		'type'=> 'text',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

$wp_customize->add_setting( '3rd_slider_second_link', array(
		'sanitize_callback'     =>  'esc_url_raw',
) );

$wp_customize->add_control( '3rd_slider_second_link', array(
		'label' => esc_html__( 'Second Link Url', 'home-services' ),
		'section' => 'home_services_customize_slider_options',
		'settings' => '3rd_slider_second_link',
		'type'=> 'url',
		'active_callback' => function(){
				return get_theme_mod( 'home_services_slider_show_hide', true );
		},
) );

}


/**
 * Remove the Sortable hook from the parent theme
*/
function remove_parent_home_services_sortable() {
	remove_action( 'customize_register', 'home_services_sections_sortable' );
}
add_action( 'after_setup_theme', 'remove_parent_home_services_sortable', 11 );

/**
 * Add the Slider in Sortable Section
*/
function child_home_services_sections_sortable( $wp_customize ) {
	if ( home_services_set_pro_active() ) {
		$wp_customize->add_section( 'home_services_sort_homepage_sections', array(
			'title'          => esc_html__( 'Re-order Sections', 'home-services' ),
			'panel'          => 'home_service_frontpage_settings',
			'priority'       => 1,
		) );

		$default = array('slider', 'services', 'promotions', 'about', 'wws', 'testimonial', 'teams', 'latestpost', 'newsletter', 'cta' );

		$choices = array(
			'slider' => esc_html__( 'Slider', 'home-services' ), // New slider option
			'services' => esc_html__( 'Services', 'home-services' ),
			'promotions' => esc_html__( 'Promotions', 'home-services' ),
			'about' => esc_html__( 'About Us', 'home-services' ),
			'wws' => esc_html__( 'Extra Services', 'home-services' ),
			'testimonial' => esc_html__( 'Testimonials', 'home-services' ),
			'teams' => esc_html__( 'Team', 'home-services' ),
			'latestpost' => esc_html__( 'Latest Post', 'home-services' ),
			'newsletter' => esc_html__( 'Newsletter', 'home-services' ),
			'cta' => esc_html__( 'CTA', 'home-services' ),
		);
		
		$wp_customize->add_setting( 'home_services_sort_homepage', array(
				'capability'  => 'edit_theme_options',
				'sanitize_callback'	=> 'home_services_sanitize_array',
				'default'     => $default
		) );

		$wp_customize->add_control( new Home_Services_Control_Sortable( $wp_customize, 'home_services_sort_homepage', array(
				'label' => esc_html__( 'Drag and Drop Sections to Rearrange.', 'home-services' ),
				'section' => 'home_services_sort_homepage_sections',
				'settings' => 'home_services_sort_homepage',
				'type'=> 'home-services-sortable',
				'choices'     => $choices
		) ) );
	}
}
add_action( 'customize_register', 'child_home_services_sections_sortable', 12 );
