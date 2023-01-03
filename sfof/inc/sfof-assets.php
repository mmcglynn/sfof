<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



class SFOF_Theme_Assets_Loader {	
	
	/*--------------------------------------------------------------------------------------
    *
    * Add Actions
    *
    *--------------------------------------------------------------------------------------*/
	
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );
		//add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
	}
	
	/*--------------------------------------------------------------------------------------
    *
    * Styles
    *
    *--------------------------------------------------------------------------------------*/

	public static function enqueue_styles() {

		// Theme CSS
		wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/index.css', array(), wp_rand( 1, 10000 ), 'all' );		
		
	}
	
	/*--------------------------------------------------------------------------------------
    *
    * Scripts
    *
    *--------------------------------------------------------------------------------------*/
	
	public static function enqueue_scripts() {

		// register the script
		wp_register_script( 'theme-compiled', get_template_directory_uri() . '/core/assets/js/index.compiled.js', array('wc-polyfill'), wp_rand( 1, 10000 ), true );
		
	}

}

