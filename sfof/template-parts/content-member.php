<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sfof
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (is_front_page() == false) {
	?>
	<div class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div><!-- .entry-header -->
	<?php
		}
	?>
	<div class="flex-box has-sidebar space-between">
		<div class="entry-content">
			<?php
			the_content();

			/*wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sfof' ),
					'after'  => '</div>',
				)
			);*/
			
			if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'sfof' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div><!-- .entry-content -->
		<aside class="sidebar">
		   <?php
		   if ( has_post_thumbnail() ) {
			   /* Member Thumbnail */
			   echo '<div class="member-image full-width margin-bottom-large">';
				   echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" class="full-width" />';
				   if ( get_the_post_thumbnail_caption() ) {
					   echo '<em class="txt-right d-block margin-top">';
					       echo get_the_post_thumbnail_caption();
					   echo '</em>';
				   }
			   echo '</div>';

			   /* Credentials Box */
			   echo '<div class="member-creds padded-top-large padded-bottom-large padded-left padded-right">';
			   	   if ( get_field('sfof_position') ) {
			   	       echo '<strong class="txt-center d-block margin-bottom-small has-light-blue-color">SFOF Position</strong>';
			   	       echo '<strong class="txt-center d-block">'.get_field('sfof_position').'</strong>';
			   	   }
			   	   if ( get_field('sfof_party') ) {
			   	       echo '<strong class="txt-center d-block margin-top-large margin-bottom-small has-light-blue-color">Party</strong>';
			   	       echo '<strong class="txt-center d-block">'.get_field('sfof_party').'</strong>';
			   	   }
			   	   if ( get_field('sfof_office') ) {
			   	       echo '<strong class="txt-center d-block margin-top-large margin-bottom-small has-light-blue-color">Office</strong>';
			   	       echo '<strong class="txt-center d-block">'.get_field('sfof_office').'</strong>';
			   	   }
			   	   if ( get_field('sfof_term_ends') ) {
			   	       echo '<strong class="txt-center d-block margin-top-large margin-bottom-small has-light-blue-color">Term Ends</strong>';
			   	       echo '<strong class="txt-center d-block">'.get_field('sfof_term_ends').'</strong>';
			   	   }
			   echo '</div>';
		   }
		   ?>
		</aside>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
