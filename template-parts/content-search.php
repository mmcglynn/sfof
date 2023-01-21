<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sfof
 */
$thumb = '';
$class = '';
if ( has_post_thumbnail() ) {
	$class="has-thumbnail";
	$thumb .= '<div>';
		$thumb .= '<a href="'.get_the_permalink().'" class="post-thumbnail">';
			$thumb .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'large').'" alt="'.$alt.'" class="full-width" />';
		$thumb .= '</a>';
	$thumb .= '</div>';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="flex-box post-flex p-relative padded <?php echo $class;?>">
		<?php 
			echo $thumb;
			echo '<div>';
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
				the_excerpt();
			echo '</div>';		
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
