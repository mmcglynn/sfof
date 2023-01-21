<?php
defined( 'ABSPATH' ) || exit;
// add the custom block category called SFOF Blocks to the *top* of the Block Selector
function sfof_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug' => 'SFOF-Blocks',
                'title' => __( 'SFOF Blocks', 'SFOF-Blocks' ),
            ),
        ),
        $categories
    );
}

add_filter( 'block_categories_all', 'sfof_block_category', 10, 2 );

// DECLARE YOUR BLOCKS HERE
function acf_register_sfof_acf_blocks() {
	
	// check function exists
	if( function_exists('acf_register_block_type') ) {
		
		// register the SFOF Bill Track block
		acf_register_block_type(array(
			'name'				=> 'sfof-billtrack',
			'title'				=> __('BillTrack50 - SFOF'),
			'description'		=> __('Shows BillTrack50'),
			'render_template'	=> '/acf-blocks/blocks/ACF-BillTrack/sfof-billtrack.php', // template parts is a folder in the theme folder
			'category'			=> 'SFOF-Blocks',
			'icon'				=> 'megaphone',
			'keywords'			=> array( 'sfof-billtrack' ),
			'enqueue_style'		=> '',
			'mode'          => 'preview',
		));
		
	}
}		



// DONE DECLARING BLOCKS, NOW REGISTER THEM
add_action('acf/init', 'acf_register_sfof_acf_blocks');



//Change ACF Local JSON save location to /acf folder inside this plugin
function sfof_plugin_acf_paths() {

	$args = array (
		'post_type' => 'acf-field-group'
	);

	$groups = get_posts($args);

	if($groups) {
		foreach($groups as $group) {
			
			// Append Path
			if(str_contains($group->post_excerpt, 'sfof-')) {
				return dirname(__FILE__) . '/acf-fields';
			} else {
				return get_stylesheet_directory() . '/acf-json';
			}
		}
	}
}

add_filter('acf/settings/save_json', 'sfof_plugin_acf_paths');

//Include the /acf-json folder in the places to look for ACF Local JSON files
add_filter('acf/settings/load_json', function($paths) {
    $paths[] = dirname(__FILE__) . '/acf-fields';
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});
