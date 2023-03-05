<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sfof
 */

get_header();

$term = get_queried_object();
$layout = get_field( "archive_page_layout", $term );
$filters = get_field( "archive_page_filter", $term );
$class = '';
$filter = '';
$plural = '';

if ($layout !== 'one-column') {
	$class = 'flex-box o-hidden border border-radius box-shadow p-relative margin-bottom full-width';
}

if ($filters) {
	$filter = '<div class="flex-box flex-end full-width">';
		$filter .= '<div class="border border-radius-small b-red d-inline-flex padded margin-bottom-large">';
			$filter .= '<span class="text-uppercase txt-red padded-left padded-right">Filter by:</span>';
			foreach( $filters as $f ):
				$filter .= '<a href="'.esc_url( get_term_link( $f ) ).'" class="text-uppercase txt-red text-bold padded-left padded-right no-text-decoration">'.esc_html( $f->name ).'s</a>';
			endforeach;
		$filter .= '</div>';
	$filter .= '</div>';
	$plural = 's';
}
?>
<div class="bg-red padded-top padded-bottom">
	<div class="inner">DD
		<span class="txt-white type-title text-uppercase"><?php echo $term->name;?></span> gg
	</div>
</div>
<main id="primary" class="site-main padded-top-large padded-bottom-large">
	<div class="inner">FF
		<?php 
		echo '<div class="entry-header">';
		the_title( '<h1 class="entry-title">', '</h1>' ); 
		echo '</div>';
		?>
		<div class="flex-box space-between <?php echo get_field( "archive_page_layout", $term );?> p-relative">
			<?php
			while ( have_posts() ) :
				the_post();
				
				
				/*if ($layout == 'one-column' || $layout == 'list' || $layout == '') {
					$thumb = '';
					$class = '';
					if ( has_post_thumbnail() ) {
						$class="has-thumbnail";
						$alt = "Thumbnail for ".$term->name."";
						$thumb .= '<div>';
							$thumb .= '<a href="'.get_the_permalink().'" class="post-thumbnail">';
								$thumb .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" alt="'.$alt.'" class="full-width" />';
							$thumb .= '</a>';
						$thumb .= '</div>';
					}
					echo '<article id="post-'.get_the_ID().'" class="full-width">';
						echo '<div class="flex-box post-flex p-relative padded '.$class.'">';
							echo $thumb;
							echo '<div>';
								echo '<h2 class="entry-title"><a href="'.get_the_permalink().'" rel="bookmark">'.get_the_title().'</a></h2>'; 
								echo get_the_excerpt();
							echo '</div>';	
						echo '</div>';
					echo '</article>';
				} else {
					echo '<div class="'.$class.'">';
						echo '<a href="'.get_the_permalink().'" class="no-text-decoration full-width">';
							echo '<div class="post-image full-width margin-bottom-large bg-cover bg-center full-width" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(),'large').')" >';
								echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" class="full-width transparent" />';
							echo '</div>';
							echo '<h5 style="text-align:center" class="full-width padded no-margin-bottom">'.get_the_title().'</h5>';
						echo '</a>';
					echo '</div>';
				}*/
				get_template_part( 'template-parts/content', get_post_type() );
				
			endwhile; // End of the loop.
			?>
		</div>
	</div>
</main>
<?php
get_footer();
