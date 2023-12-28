<?php
function enqueue_theme_styles() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    wp_enqueue_style('tiny-slider', get_template_directory_uri() . '/css/tiny-slider.css');
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css');
    
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');
?>

