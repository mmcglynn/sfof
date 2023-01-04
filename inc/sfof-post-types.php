<?php

/**
	Each post type array should contain the following:
	
	array(
		"slug" => The slug of the post type - should always be singular
		"display_plural" => Plural version of display text
		"display_singular" => Singular version of display text
		"description" => A short description of what the post type is
		"supports" => An array of fields that this post type supports
		"taxonomies" => An array of taxonomies that are linked to this post type
	)
	
	Supports Values:
		title
		editor
		author
		thumbnail
		excerpt
		trackbacks
		custom-fields
		comments
		revisions
		page-attributes
		post-formats
*/

$post_types = array(
	
	array(
		'slug' => 'member',
		'display_plural' => 'Members',
		'display_singular' => 'Member',
		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
		'hierarchical' => false,
		'menu_icon' => 'dashicons-universal-access'
	),
	
	array(
		'slug' => 'player',
		'display_plural' => 'Players',
		'display_singular' => 'Player',
		'supports' => array('title', 'editor', 'categories', 'page-attributes', 'thumbnail'),
		'hierarchical' => false,
		'menu_icon' => 'dashicons-groups'
	),
	
	array(
		'slug' => 'state',
		'display_plural' => 'States',
		'display_singular' => 'State',
		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
		'hierarchical' => false,
		'menu_icon' => 'dashicons-admin-site'
	),

);

/*--------------------------------------------------------------------------------------
 *
 * Stop editing!
 *
 *--------------------------------------------------------------------------------------*/

foreach ( $post_types as $pt )
{
	$defaults = array(
		'labels' => array(
			'name' => ucwords($pt['display_plural']),
			'singular_name' => ucwords($pt['display_singular']),
			'add_new' => sprintf('Add %s', $pt['display_singular']),
			'add_new_item' => sprintf('Add %s', $pt['display_singular']),
			'edit_item' => sprintf('Edit %s', $pt['display_singular']),
			'new_item' => sprintf('New %s', $pt['display_singular']),
			'view_item' => sprintf('View %s', $pt['display_singular']),
			'search_items' => sprintf('Search %s', $pt['display_plural']),
			'not_found' => sprintf('No %s found', $pt['display_plural']),
			'not_found_in_trash' => sprintf('No %s in trash', $pt['display_plural']),
			'parent_item_colon' => sprintf('Parent %s:', $pt['display_singular']),
		),
		'description' => ! empty($pt['description']) ? $pt['description'] : '',
		'public' => true,
		'menu_position' => 5,
		'supports' => ! empty($pt['supports']) ? $pt['supports'] : array(),
		'has_archive' => true,
		'show_in_rest'=> true
	);
	
	
	register_post_type($pt['slug'], array_merge($defaults, $pt));
	
	$slug = $pt['slug'];
	
	
	/*Add Columns*/
	
	add_filter( 'manage_edit-'.$slug.'_columns', 'my_edit_custom_columns' );
	
	if(post_type_supports($slug, 'thumbnail')){
		add_filter( 'manage_edit-'.$slug.'_columns', 'my_edit_thumbnail_columns' );
	}
	
	/* Add Values */
	
	add_action( 'manage_'.$slug.'_posts_custom_column', 'my_manage_custom_columns', 10, 2 );
	
	if(post_type_supports($slug, 'thumbnail')){
		add_filter( 'manage_'.$slug.'_posts_custom_column', 'my_manage_thumbnail_columns', 10, 2  );
		add_action('admin_head', 'thumbnail_column_width');
	}

}
		
function my_edit_custom_columns( $columns ) {
	
	$columns = array(
		'title' => 'Title',
		'date' => 'Date',
		'order' => 'Order'
	);

	return $columns;
}

function my_edit_thumbnail_columns( $columns ) {
	
	$columns = array(
		'thumbnail' => 'Thumbnail',
		'title' => 'Title',
		'date' => 'Date',
		'order' =>'Order'
	);

	return $columns;

}

function my_manage_custom_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		
		/* If displaying the 'duration' column. */
		case 'order' :

			/* Get the post meta. */
			
			$order = $post->menu_order;

			/* If no duration is found, output a default message. */
			if ( empty( $order ) )
				echo __( '' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( __( '%s' ), $order );

			break;


		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

function my_manage_thumbnail_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'thumbnail' :

			/* Get the post meta. */
			
			$thumb = the_post_thumbnail(array(40,40));

			/* If no duration is found, output a default message. */
			if (!$thumb)
				echo __( '' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( __( '%s' ), $thumb );

			break;


		/* Just break out of the switch statement for everything else. */
		default :
			break;
	
	}
}

function thumbnail_column_width() {
    echo '<style type="text/css">';
    echo '.column-thumbnail { text-align: center; width:75px !important; overflow:hidden }';
    echo '</style>';
}

function contact_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'member' == $screen->post_type ) {
          $title = 'Enter Member Name';
     }
    
     if  ( 'player' == $screen->post_type ) {
          $title = 'Enter Player Name';
     }
     
     if  ( 'state' == $screen->post_type ) {
          $title = 'Enter State Name';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'contact_change_title_text' );