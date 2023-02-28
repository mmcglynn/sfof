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
	<div class="inner">
		<span class="txt-white type-title text-uppercase"><?php echo $term->name.$plural;?></span>
	</div>
</div>
<main id="primary" class="site-main padded-top-large padded-bottom-large">
	<div class="inner">
		<?php 
		echo term_description( $term,'post_tag' );
		echo $filter;
		?>
		<div class="flex-box space-between <?php echo get_field( "archive_page_layout", $term );?> p-relative">
			<?php
			if ( $term->name == 'Member' ) {
				query_posts(array('orderby'=>'meta_value','order'=>'ASC','meta_key'=>'last_name','numberposts' => -1, 'tag' => $term->name));
			} else {
				query_posts(array('orderby'=>'title','order'=>'ASC','numberposts' => -1, 'tag' => $term->name));
			}
			while ( have_posts() ) :
				the_post();
				if ($layout == 'one-column' || $layout == 'list' || $layout == '') {
					$thumb = '';
					$class = '';
					$alt = '';
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
							 echo '<div class="post-image full-width margin-bottom-large card_image full-width" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(),'large').')" >';
								 //echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" class="full-width transparent" />';
							 echo '</div>';
							 echo '<h5 style="text-align:center" class="full-width padded no-margin-bottom">'.get_the_title().'</h5>';
						 echo '</a>';
					 echo '</div>';
				}
				endwhile; // End of the loop.
			?>
		</div>
	</div>
</main>
<?php
get_footer();
