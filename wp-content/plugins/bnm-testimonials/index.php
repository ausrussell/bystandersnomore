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
    // if (is_array($output))
    //     $output = implode(',', $output);

    echo "<script>console.log('debug:: " . $data . "');</script>";
}

add_shortcode('bnmtestimonials', 'wpbnm_shortcode');

add_action('wp_enqueue_scripts', 'bnm_testimonial_assets');

add_action('admin_enqueue_scripts', 'bnm_testimonial_assets_admin');

function bnm_testimonial_assets_admin()
{
    wp_register_style('bnm-swiper', plugins_url('/css/bnm-swiper.css', __FILE__));
    wp_enqueue_style('bnm-swiper');
}
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
    $args = array(
        'post_type' => 'bnm_testimonial',
        'posts_per_page' => 10,
    );
    $loop = new WP_Query($args);


    $content = '<div class="bnm-testimonials">';
    $content .= '<div class="bnm-testimonials-title">Testimonials</div>';
    $content .= '<div class="bnm-testimonials-flex-wrapper">';
    $content .= '<div class="swiper"><div class="swiper-wrapper bnm-swiper">';

    while ($loop->have_posts()) {
        $loop->the_post();
        $descriptor_value = get_post_meta(get_the_ID(), '_bnm_person_descriptor_meta_key', true);
        $source_value = get_post_meta(get_the_ID(), '_bnm_person_source_meta_key', true);
        $url_value = get_post_meta(get_the_ID(), '_bnm_person_source_url_meta_key', true);
        $content .= '<div class="swiper-slide">';
        $content .= '<div class="bnm-content-holder">';
        $content .= '<div class="bnm-testimonial_content">' . get_the_content() . '</div>';
        $content .= '<div class="bnm-testimonial-descriptors">';
        $content .= '<div class="bnm-testimonial_name">' . get_the_title() . '</div>';
        $content .= '<div class="bnm-testimonial_descriptor">' . $descriptor_value . '</div>';
        $content .= '<div class="bnm-testimonial_source">Source&mdash; <a href="' . $url_value . ' target="_blank"">' . $source_value . '</a></div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
    }
    $content .= '</div>';

    $content .= '<div class="swiper-button-prev"></div>';
    $content .= '<div class="swiper-button-next"></div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
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
            'has_archive' => 'testimonials',
            'rewrite' => array('slug' => 'testimonial'),
        )
    );

    flush_rewrite_rules(false);
}
add_action('init', 'bnm_custom_testimonial_post');

function bnm_testimonial_add_custom_box()
{
    $screens = ['bnm_testimonial'];
    foreach ($screens as $screen) {
        add_meta_box(
            'bnm_person_descriptor_id',                 // Unique ID
            'Person descriptor',      // Box title
            'bnm_person_descriptor_html',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}
add_action('add_meta_boxes', 'bnm_testimonial_add_custom_box');

function bnm_person_descriptor_html($post)
{
    $descriptor_value = get_post_meta($post->ID, '_bnm_person_descriptor_meta_key', true);
    $source_value = get_post_meta($post->ID, '_bnm_person_source_meta_key', true);
    $source_url_value = get_post_meta($post->ID, '_bnm_person_source_url_meta_key', true);
    ?>
    <form>
        <label for="bnm_person_descriptor">Job title or other description</label>
        <textarea class="bnm_textarea" id="bnm_person_descriptor"
            name="_bnm_person_descriptor_meta_key"><?php echo $descriptor_value ?></textarea>
        <label for="bnm_source">Source of Testimonial, e.g. LinkedIn</label>
        <input class="bnm-input" id="bnm_source" name="_bnm_person_source_meta_key" value="<?php echo $source_value ?>">
        <label for="bnm_source_url">Url for source of Testimonial, e.g.
            https://www.linkedin.com/posts/mpho-tutu-van-furth-74094899_bystanders-no-more-activity-7211818525982687232-1Nut</label>
        <input class="bnm-input" id="bnm_source_url" name="_bnm_person_source_url_meta_key"
            value="<?php echo $source_url_value ?>">
    </form>
    <?php
}



function bnm_save_postdata($post_id)
{
    if (array_key_exists('_bnm_person_descriptor_meta_key', $_POST)) {
        update_post_meta(
            $post_id,
            '_bnm_person_descriptor_meta_key',
            $_POST['_bnm_person_descriptor_meta_key']
        );
    }
    if (array_key_exists('_bnm_person_source_meta_key', $_POST)) {
        update_post_meta(
            $post_id,
            '_bnm_person_source_meta_key',
            $_POST['_bnm_person_source_meta_key']
        );
    }
    if (array_key_exists('_bnm_person_source_url_meta_key', $_POST)) {
        update_post_meta(
            $post_id,
            '_bnm_person_source_url_meta_key',
            $_POST['_bnm_person_source_url_meta_key']
        );
    }
}
;

add_action('save_post_bnm_testimonial', 'bnm_save_postdata', 999, 3);
