<?php // Template Name: Players Filter ?>
<?php 
get_header();
?>
	<div class="type-title">
		<div class="inner">Players</div>
	</div>
	<main id="primary" class="site-main padded-top-large padded-bottom-large">
		<div class="inner">
			<div class="filter flex-box flex-end full-width">
				<div>
					<span>Filter by:</span>
					<a href="/tag/funder/" data-wpel-link="internal">Funders</a>
					<a href="/tag/group/" data-wpel-link="internal">Groups</a>
					<a href="/tag/operative/" data-wpel-link="internal">Operatives</a>
				</div>
			</div>
			<div class="card-holder four-column">
                <?php
				$args = array(
						'tag' => 'funder,group,operative',
					'numberposts' => -1,
                    'orderby' => 'title',
					'order' => 'asc'
				);
                $filtered_posts = get_posts($args);

                foreach ( $filtered_posts as $filtered_post ){

					$tag = get_the_tags( $filtered_post->ID );
                    $slug = $tag[0]->slug;

					echo '<div class="card ' . $slug . '">';
					//var_dump(get_the_tags( $filtered_post->ID ));

//                    if (in_array("group", get_the_tags( $filtered_post->ID )))
//                    {
//                        echo "Match found";
//                    }
//                    else
//                    {
//                        echo "Match not found";
//                    }
                    echo '<a href="' . $filtered_post->guid . '" data-wpel-link="internal">';
                    echo '<div style="background-image: url(' . get_the_post_thumbnail_url($filtered_post->ID) . ')"></div>';
                    echo '<h5>' . $filtered_post->post_title . '</h5>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
			</div>
		</div>
	</main>

<?php
get_footer();