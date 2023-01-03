<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sfof
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sfof' ); ?></a>
	
	<section class="sub-header bg-blue">
		<div class="inner p-relative full-height">
			<a href="https://www.exposedbycmd.org/" target="_blank" rel="noreferrer noopener external" data-wpel-link="external" class="flex-box full-height flex-center">
				<img src="<?php echo get_template_directory_uri() . '/assets/cms-icon.svg';?>" alt="The Center for Media and Democracy" class="cms-icon" />
			</a>
		</div>
	</section>
	
	<header id="masthead" class="site-header bg-gray border-bottom thick b-red">
		<div class="inner p-relative padded-top-large padded-bottom-large">
			<div class="flex-box stay-flex two-column space-between">
				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation p-relative">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'sfof' ); ?></button>
					<?php
					/* Nav Menu */
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'	=> 'no-list flex-box flex-end',
						)
					);
					
					/* Search Form */
					get_search_form();
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->
