<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sfof
 */

get_header();
?>
	<div class="bg-red padded-top padded-bottom">
		<div class="inner">
			<span class="txt-white type-title text-uppercase">Member</span>
		</div>
	</div>
	<main id="primary" class="site-main padded-top-large padded-bottom-large">
		<div class="inner">single-member.php
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'sfof' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'sfof' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
