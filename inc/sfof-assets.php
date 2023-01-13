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
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		// editor styles
		add_action( 'enqueue_block_editor_assets', array(__CLASS__, 'block_editor_styles' ) );
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
	
	public static function block_editor_styles( ){
		wp_enqueue_style( 'block-editor-styles', get_template_directory_uri() . '/css/editor.css', array(), wp_rand( 1, 10000 ), 'all' );		
	}
	
	/*--------------------------------------------------------------------------------------
    *
    * Scripts
    *
    *--------------------------------------------------------------------------------------*/
	
	public static function enqueue_scripts() {

		// register the script
		wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/index.js', array(), wp_rand( 1, 10000 ), true );
		
	}

}

