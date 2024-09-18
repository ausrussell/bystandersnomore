<?php

/*
Plugin Name: BNM Testimonials
Description: Testimonials for Bystanders No More
Version: 1.0
Author: Russell Ward
License: GPL2
*/
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

add_shortcode('bnmtestimonials', 'wpbnm_shortcode');

add_action('wp_enqueue_scripts', 'bnm_testimonial_assets');
function bnm_testimonial_assets()
{
    wp_register_style('swiper', plugins_url('/css/swiper.css', __FILE__));
    wp_register_script(
        'swiper',
        plugins_url('/js/swiper.js', __FILE__),
        array(),
        '1.0.0',
        array(
            'strategy' => 'defer'
        )
    );

    wp_register_style('bnm-swiper', plugins_url('/css/bnm-swiper.css', __FILE__));
    wp_register_script(
        'bnm-swiper',
        plugins_url('/js/bnm-swiper.js', __FILE__),
        array(),
        '1.0.0',
        array(
            'strategy' => 'defer'
        )
    );

    wp_enqueue_style('swiper');
    wp_enqueue_script('swiper');

    wp_enqueue_style('bnm-swiper');
    wp_enqueue_script('bnm-swiper');
}

function wpbnm_shortcode($atts = [], $content = "")
{
    debug_to_console("instance bnm_shortcode");
    $args = array(
        'post_type' => 'bnm_testimonial',
        'posts_per_page' => 10,
    );
    $loop = new WP_Query($args);
    $content = '<div class="swiper"><div class="swiper-wrapper bnm-swiper">';
    while ($loop->have_posts()) {
        $loop->the_post();
        $content .= '<div class="swiper-slide">';
        $content .= '<div class="bnm-testimonial_content">'.get_the_content().'</div>';
        $content .= '<h5 class="bnm-testimonial_name">'.get_the_title().'</h5>';

        $content .= '</div>';
    }
    $content .= '</div>';

    $content .= '<div class="swiper-pagination"></div>';
    $content .= '<div class="swiper-button-prev"></div>';
    $content .= '<div class="swiper-button-next"></div>';
    $content .= '</div>';

    return $content;
}

function bnm_custom_testimonial_post()
{
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'menu_name' => 'Testimonial',
        'name_admin_bar' => 'Testimonial',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'new_item' => 'New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'view_item' => 'View Testimonial',
        'all_items' => 'All Testimonials',
        'search_items' => 'Search Testimonials',
        'parent_item_colon' => 'Parent Testimonials:',
        'not_found' => 'No Testimonials found.',
        'not_found_in_trash' => 'No Testimonials found in Trash.'
    );
    register_post_type(
        'bnm_testimonial',
        array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'testimonials'),
        )
    );
}
add_action('init', 'bnm_custom_testimonial_post');


