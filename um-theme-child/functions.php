<?php

add_action( 'wp_enqueue_scripts', 'hps_enqueue_styles' );
function hps_enqueue_styles() {
    $parenthandle = 'umtheme-stylesheet'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );

    wp_enqueue_style( 'hps-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );

    wp_enqueue_style( 'hps-style', get_stylesheet_uri() . '/dist/main.css',
        array( $parenthandle ),
        1.0
    );
}