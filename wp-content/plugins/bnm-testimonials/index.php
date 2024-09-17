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


function wpbnm_shortcode($atts = [], $content = "")
{
    debug_to_console("instance bnm_shortcode");
    $args = array(
        'post_type' => 'bnm_testimonial',
        'posts_per_page' => 10,
    );
    $loop = new WP_Query($args);
    $content = '<div>';
    while ($loop->have_posts()) {
        $loop->the_post();
        $content .= '<div class="entry-content">';
        $content .= get_the_title();
        $content .= get_the_content(); 
        $content .= '</div>';
    }
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



