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
$card_class = strtolower($term->name);
$class = '';
$filter = '';
$plural = 'S';

//echo'$layout:<br />';
//var_dump($layout);
//
//echo '$filters: <br />';
//var_dump($filters);

//if ($layout !== 'one-column') {
	//$class = 'flex-box o-hidden border border-radius box-shadow p-relative margin-bottom full-width ' . $card_class;
//}

if ($filters) {
	$filter = '<div class="filter flex-box flex-end full-width">';
		$filter .= '<div>';
			$filter .= '<span>Filter by:</span>';
			foreach( $filters as $f ):
				$filter .= '<a href="'.esc_url( get_term_link( $f ) ).'">'.esc_html( $f->name ).'s</a>';
			endforeach;
		$filter .= '</div>';
	$filter .= '</div>';
	$plural = 's';
}
?>

<div class="type-title">
	<div class="inner">
		<?php echo $term->name.$plural;?>
	</div>
</div>
<main id="primary" class="site-main padded-top-large padded-bottom-large">
	<div class="inner">
		<!-- tag.php -->
		<?php
		echo term_description( $term,'post_tag' );
		echo $filter;
		?>
		<div class="card-holder <?php echo get_field( "archive_page_layout", $term );?>">
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
					//$class = '';
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
					echo '<div class="card ' . $card_class . '">';
						 echo '<a href="'.get_the_permalink().'">';
							 echo '<div style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(),'large').')" >';
								 //echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" class="full-width transparent" />';
							 echo '</div>';
							 echo '<h5>'.get_the_title().'</h5>';
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
