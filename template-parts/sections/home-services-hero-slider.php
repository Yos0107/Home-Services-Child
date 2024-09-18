<?php
/**
 * Slider part for displaying Hero Slider
 * @package home_services
 */
?>
<?php
   // Get the slider speed from the customizer
    $slider_speed = get_theme_mod('slider_speed'); 
    $slider_autoplay = get_theme_mod('home_services_slider_autoplay'); 
?>

<?php if(get_theme_mod('home_services_slider_show_hide')): ?>
<div class="primary-hero-section">

<div class="hero-item-wrap" data-slick='{"autoplay": <?php echo $slider_autoplay; ?>, "autoplaySpeed": <?php echo $slider_speed; ?>}'>
    <?php
    $sliders = [
        [
            'image' => get_theme_mod('slider_1st_image'),
            'heading' => get_theme_mod('title_for_1st_slider'),
            'content' => get_theme_mod('content_for_1st_slider'),
            'cta_button1_label' => get_theme_mod('1st_slider_first_link_label'),
            'cta_button1_link' => get_theme_mod('1st_slider_link'),
            'cta_button2_label' => get_theme_mod('1st_slider_second_link_label'),
            'cta_button2_link' => get_theme_mod('1st_slider_second_link')
        ],
        [
            'image' => get_theme_mod('slider_2nd_image'),
            'heading' => get_theme_mod('title_for_2nd_slider'),
            'content' => get_theme_mod('content_for_2nd_slider'),
            'cta_button1_label' => get_theme_mod('2nd_slider_first_link_label'),
            'cta_button1_link' => get_theme_mod('2nd_slider_link'),
            'cta_button2_label' => get_theme_mod('2nd_slider_second_link_label'),
            'cta_button2_link' => get_theme_mod('2nd_slider_second_link')
        ],
        [
            'image' => get_theme_mod('slider_3rd_image'),
            'heading' => get_theme_mod('title_for_3rd_slider'),
            'content' => get_theme_mod('content_for_3rd_slider'),
            'cta_button1_label' => get_theme_mod('3rd_slider_first_link_label'),
            'cta_button1_link' => get_theme_mod('3rd_slider_link'),
            'cta_button2_label' => get_theme_mod('3rd_slider_second_link_label'),
            'cta_button2_link' => get_theme_mod('3rd_slider_second_link')
        ]
    ];
    ?>
        <?php foreach ($sliders as $slider): ?>
            <?php if ($slider['heading'] || $slider['content'] || $slider['cta_button1_label'] || $slider['cta_button2_label']) { ?>
        <div class="hero-item" >
            <div class="container">
                <div class="caption-holder-wrapper">
                    <div class="caption-holder">
                        <?php if ($slider['heading']) { ?>
                            <h1 class="main-title">
                                <?php echo esc_html($slider['heading'], 'home-services'); ?>
                            </h1>
                        <?php } ?>

                        <?php if ($slider['content']) { ?>
                            <p><?php echo esc_html($slider['content']); ?></p>
                        <?php } ?>

                        <div class="button-group">
                            <?php if ($slider['cta_button1_label'] && $slider['cta_button1_link']) { ?>
                                <a href="<?php echo esc_url($slider['cta_button1_link']); ?>" class="btn cta-1"><?php echo esc_attr($slider['cta_button1_label']); ?></a>
                            <?php } ?>

                            <?php if ($slider['cta_button2_label'] && $slider['cta_button2_link']) { ?>
                                <a href="<?php echo esc_url($slider['cta_button2_link']); ?>" class="btn cta-2"><?php echo esc_attr($slider['cta_button2_label']); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="img-holder-wrapper">
                    <div class="img-holder">
                        <img src="<?php echo esc_url($slider['image']); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
