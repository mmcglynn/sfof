<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sfof
 */

get_header();
while ( have_posts() ) :
	$posttags = get_the_tags();
	$posttag = '';
	if ($posttags) {
		$posttag .= $posttags[0]->name;
		if( $posttag == 'Non-member person' ) {
            $posttag = 'Operative';
		}
	}
?>
	<div class="type-title">
		<div class="inner">
            <?php echo $posttag;?>
		</div>
	</div>
<p class="template-identifier">single.php</p>
	<main id="primary" class="site-main padded-top-large padded-bottom-large">
		<div class="inner">
			<?php
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				/*the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'sfof' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'sfof' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;*/
			?>
		</div>
		</div>
	</main><!-- #main -->

<?php
endwhile; // End of the loop.
get_footer();
