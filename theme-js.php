<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'wp_enqueue_scripts', 'mycustom_add_javascript' );

if ( ! function_exists( 'mycustom_add_javascript' ) ) {
	function mycustom_add_javascript() {
		wp_register_script( 'general', get_stylesheet_directory_uri() . '/js/general.js', array( 'jquery' ) );
		wp_register_script( 'css3-mediaqueries', get_stylesheet_directory_uri() . '/js/css3-mediaqueries.js', array( 'jquery' ) );
		wp_register_script( 'slider-hover', get_stylesheet_directory_uri() . '/js/slider-hover.js', array( 'jquery' ) );
		do_action( 'mycustom_add_javascript' );
	} // End mycustom_add_javascript()
}

add_action( 'mycustom_add_javascript' , 'mycustom_load_the_js' );

function mycustom_load_the_js() {
	wp_enqueue_script( 'general' );
	wp_enqueue_script( 'css3-mediaqueries' );
	wp_enqueue_script( 'slider-hover' );
}