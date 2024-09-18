<?php
/**
 * Template Name: Front Page for Theme
 * Template Name: Fullwidth Page
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package home_services
 */

get_header();
?>
<?php
if ( home_services_set_pro_active() ) {
	$default_section_order = array( 'slider','services', 'promotions', 'about', 'wws', 'testimonial', 'teams','latestpost','newsletter','cta');

	$home_services_sections = get_theme_mod( 'home_services_sort_homepage', $default_section_order );
	if( !empty($home_services_sections) ):
		foreach($home_services_sections as $section){
			switch ( $section ) {
				case "slider":
					get_template_part( 'template-parts/sections/home-services-hero-slider' );
				break;
				case "services":
					get_template_part( 'template-parts/cta', 'blocksection' );
				break;
				case "promotions":
					get_template_part( 'template-parts/sections/home-services-promotions' );
				break;
				case "about":
					get_template_part( 'template-parts/sections/home-services-about' );
				break;
				case "wws":
					get_template_part( 'template-parts/sections/home-services-wws' );
				break;
				case "testimonial":
					get_template_part( 'template-parts/sections/home-services-testimonial' );
				break;
				case "teams":
					get_template_part( 'template-parts/sections/home-services-team' );
				break;
				case "latestpost":
					get_template_part( 'template-parts/sections/home-services-recentposts' );
				break;
				case "newsletter":
					get_template_part( 'template-parts/sections/home-services-newsletter' );
				break;
				case "cta":
					get_template_part( 'template-parts/sections/home-services-cta' );
				break;
			}
		}
	endif; ?>

<?php } else{
	get_template_part( 'template-parts/sections/home-services-hero-slider' );
	get_template_part( 'template-parts/sections/home-services-about' );
	get_template_part( 'template-parts/sections/home-services-wws' );
	get_template_part( 'template-parts/sections/home-services-cta' );

}
get_footer();