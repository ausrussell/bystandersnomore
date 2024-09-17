/*
Plugin Name: BNM Testimonials
Description: Testimonials for Bystanders No More
Version: 1.0
Author: Russell Ward
License: GPL2
*/

<?php

function bnm_custom_testimonial_post()
{
    register_post_type(
        'bnm_testimonial',
        array(
            'labels' => array(
                'name' => __('Testimonials', 'textdomain'),
                'singular_name' => __('Testimonial', 'textdomain'),
            ),
            'public' => true,
            'has_archive' => true

            ,
    ,
            'rewrite' => array('slug' => 'testimonials'),
        )
    );
}
add_action('init', 'bnm_custom_testimonial_post');


add_shortcode('bnmtestimonials', 'bnm_shortcode');
function bnm_shortcode( $atts = [], $content = null) {
    $args = array(
        'post_type'      => 'bnm_testimonial',
        'posts_per_page' => 10,
    );
    $loop = new WP_Query($args);
    $content = '<div>';
    while ( $loop->have_posts() ) {
        $loop->the_post();
        
        $content .= '<div class="entry-content">';
        $content .= the_title();
        $content .= the_content(); 
        $content .= '</div>';
    }
    return $content;
}
