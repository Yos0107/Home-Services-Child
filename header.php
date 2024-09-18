<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package home_services
 */

 

?>
<!doctype html>
<html <?php language_attributes(); ?>>

 

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo( 'description', 'display' )); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

 

    <?php wp_head(); ?>
</head>

 

<?php
    
    $contact_button = get_theme_mod( 'hide_show_contact_responsive');
    $cta_button1 = get_theme_mod( 'hide_show_header1_responsive' );
    $cta_button2 = get_theme_mod( 'hide_show_header2_responsive');
    if($contact_button || $cta_button1  || $cta_button2 ){
        $class = 'cta';
    }else{
        $class = '';
    }
    
    ?>
<body <?php body_class($class); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e( 'Skip to content', 'home-services' ); ?></a>

 

        <header id="masthead" class="site-header">
            <?php
            if ( home_services_set_pro_active() ) {
                $layout = get_theme_mod( 'home_services_header_layouts', 'two' );
                get_template_part( 'layouts/header/header-layout', $layout );
            } else {
                $layout = get_theme_mod( 'home_services_header_layouts', 'one' );
                get_template_part( 'layouts/header/header-layout', $layout );
            }
            
            ?>
        </header><!-- #masthead -->
    </div>

 

<?php
$classes = get_body_class();
if (in_array('home',$classes)) {
    $banner_display_in_homepage = get_theme_mod('banner_display_in_homepage', '0');
    if($banner_display_in_homepage == '1'){
        get_template_part( 'template-parts/banner' );
    }   
    
}
else{
    $classes = get_body_class();
    if (in_array('home',$classes) == false) {
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-holder">
            <?php breadcrumb_trail(); ?>
        </div>
    </div>
</div>
<?php }
    $banner_display_in_otherpage = get_theme_mod('banner_display_in_otherpage', '0');
    if($banner_display_in_otherpage == '1'){
        get_template_part( 'template-parts/banner' );
    }
}

if (! home_services_set_pro_active() ) {     
    $classes = get_body_class();
    if (in_array('home',$classes)) {
    $home_services_slider_show_hide = get_theme_mod('home_services_slider_show_hide', '0');
      if($home_services_slider_show_hide == '1'){
        get_template_part( 'template-parts/sections/home-services-hero-slider' );
        get_template_part( 'template-parts/cta', 'blocksection' );
      }{
        get_template_part( 'template-parts/cta', 'blocksection' );
      }
    }
}