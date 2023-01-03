<?php
/**
 * sfof functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sfof
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sfof_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on sfof, use a find and replace
		* to change 'sfof' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'sfof', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'sfof' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'sfof_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sfof_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sfof_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sfof_content_width', 640 );
}
add_action( 'after_setup_theme', 'sfof_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sfof_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sfof' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sfof' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( array(
		'name'          => esc_html__( 'SubFooter Sidebar', 'sfof' ),
		'id'            => 'sidebar-subfooter',
		'description'   => esc_html__( 'Add widgets here. This will globally throughout the site in the sub footer.', 'sfof' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'sfof_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sfof_scripts() {
	wp_enqueue_style( 'sfof-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'sfof-style', 'rtl', 'replace' );

	wp_enqueue_script( 'sfof-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sfof_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Unset the user endpoints of the REST API
add_filter('rest_endpoints', function ($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

// SFOF assets
include_once get_template_directory() . '/inc/sfof-assets.php';
SFOF_Theme_Assets_Loader::init();

// SFOF Custom Post Types
include_once get_template_directory() . '/inc/sfof-post-types.php';

/* PC Colors */

function pc_custom_colors() {
	$colors = array(
			array(
				'name'  => 'Black',
				'slug' => 'black',
				'color' => '#000',
			),
			array(
				'name'  => 'Blue',
				'slug' => 'blue',
				'color' => '#0a659c',
			),
			array(
				'name'  => 'Light Blue',
				'slug' => 'light-blue',
				'color' => '#017bba',
			),
			array(
				'name'  => 'Red',
				'slug' => 'red',
				'color' => '#af2525',
			),
			array(
				'name'  => 'Light Gray',
				'slug' => 'light-gray',
				'color' => '#efefef',
			),
			array(
				'name'  => 'Gray',
				'slug' => 'gray',
				'color' => '#8c8c8c',
			),
			array(
				'name'  => 'Dark Gray',
				'slug' => 'dark-gray',
				'color' => '#333333',
			),
			array(
				'name'  => 'White',
				'slug' => 'white',
				'color' => '#FFF',
			)
		);
		
	return $colors;
}

/* Add PC Branding Colors to Swatches */
function pc_color_palette() {

	$colors = pc_custom_colors();
	
	// Default Colors
	add_theme_support( 'editor-color-palette', $colors );
	
	// Classes
	add_theme_support( 'wp-block-styles');
	
}

add_action( 'after_setup_theme', 'pc_color_palette' );

/* Add CSS Styles to header FRONTEND */
function front_pc_add_custom_colors() {
	// get custom colors 
	$get_colors = pc_custom_colors();
	$styles = '';
	if($get_colors) {
		foreach($get_colors as $color) {
			if ($color['name'] != '') {
				$styles .= '.has-'.str_replace(" ", "-", strtolower($color['slug'])).'-color{color:'.$color['color'].' !important}.has-'.str_replace(" ", "-", strtolower($color['slug'])).'-color-border,.has-'.str_replace(" ", "-", strtolower($color['slug'])).'-color-border:after,.has-'.str_replace(" ", "-", strtolower($color['slug'])).'-color-border:before{border-color:'.$color['color'].' !important}.has-'.str_replace(" ", "-", strtolower($color['slug'])).'-background-color{background-color:'.$color['color'].' !important}.border-'.str_replace(" ", "-", strtolower($color['slug'])).':after{background: '.$color['color'].';}';
			}
		}
	}
	?>
	<style>
		<?php echo $styles;?>
	</style>
	<?php
}

//add frontend styles
add_action( 'wp_head', 'front_pc_add_custom_colors');

// Filter Players
function sfof_filter_players() {
  $catSlug = $_POST['category'];

  $ajaxposts = new WP_Query([
    'post_type' => 'player',
    'posts_per_page' => -1,
    'category_name' => $catSlug,
    'orderby' => 'menu_order', 
    'order' => 'desc',
  ]);
  $response = '';

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= get_template_part('templates/_components/project-list-item');
    endwhile;
  } else {
    $response = 'empty';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_sfof_filter_players', 'sfof_filter_players');
add_action('wp_ajax_nopriv_sfof_filter_players', 'sfof_filter_players');
