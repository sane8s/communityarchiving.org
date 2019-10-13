<?php
/*
=== Load parent Styles ===
*/
function dc_enqueue_styles() {
	wp_enqueue_style( 'divi-parent', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'divi-parent' ) );
}
add_action( 'wp_enqueue_scripts', 'dc_enqueue_styles' );

function divi_module_loading() {
    if ( ! class_exists('ET_Builder_Module') ) {
        return;
    }
    
    get_template_part('custom-modules/cbm');
    $cbm = new Custom_ET_Builder_Module_Blog();
    
    remove_shortcode('et_pb_blog');
    
    add_shortcode('et_pb_blog', array($cbm, '_shortcode_callback'));
    
    get_template_part('custom-modules/SearchAndDisplay');
    $searchndisplay = new Custom_ET_Builder_Module_SearchAndDisplay();
    
    add_shortcode('et_pb_searchanddisplay', array($searchndisplay, '_shortcode_callback'));
    
}
add_action('wp', 'divi_child_theme_setup', 9999);
