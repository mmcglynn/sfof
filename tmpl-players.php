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

				$combined_titles = array();

				$args = array(
						'tag' => 'funder,group,operative',
						'numberposts' => -1,
                    	'orderby' => 'title',
						'order' => 'asc'
				);
                $filtered_posts = get_posts($args);

				//var_dump($filtered_posts);

				// Create and array of sorted posts.
				// This array combines post titles and ADF field
                foreach ( $filtered_posts as $filtered_post ){

					// Populate the array for sorting
                    $lastname = get_post_meta( $filtered_post->ID, 'last_name', true);
                    $sortname = get_post_meta( $filtered_post->ID, 'sort_name', true);
                    if($lastname) {
                        //echo $lastname . '<br />';
                        array_push($combined_titles, array('postid'=>$filtered_post->ID,'sortname'=>$lastname));
                    } elseif ($sortname) {
                        //echo $sortname . '<br />';
                        array_push($combined_titles, array('postid'=>$filtered_post->ID,'sortname'=>$sortname));
					} else {
                        //echo $filtered_post->post_title . '<br />';
                        array_push($combined_titles, array('postid'=>$filtered_post->ID,'sortname'=>$filtered_post->post_title));
					}

                }

                //print_r($combined_titles);
                //echo '<hr />';

				// Sort the created array alphabetically by name
                function compareByName($a, $b) {
                    return strcmp($a["sortname"], $b["sortname"]);
                }
                usort($combined_titles, 'compareByName');

                // Create an array of just the IDs from the sorted list
				$sorted_ids = array();
                foreach($combined_titles as $combined_title) {
					array_push($sorted_ids, $combined_title['postid']);
				}

                //$sorted_posts = get_posts($args);
                //echo '<hr />';
				//var_dump($sorted_ids);

				// Finally, retrieve the sorted posts
                $sorted_posts = get_posts(array('post__in' => $sorted_ids, 'orderby' => 'post__in', 'numberposts' => -1));

				//var_dump($sorted_posts);

                // Build card
				foreach ($sorted_posts as $sorted_post) {
					$tag = get_the_tags( $sorted_post->ID );
                    $slug = $tag[0]->slug;

					echo '<div class="card ' . $slug . '">';
                    echo '<a href="' . get_site_url() . '/' .  $sorted_post->post_name . '" data-wpel-link="internal">';
                    echo '<div style="background-image: url(' . get_the_post_thumbnail_url($sorted_post->ID) . ')"></div>';
                    echo '<h5>' . $sorted_post->post_title . '</h5>';
                    echo '</a>';
                    echo '</div>';
				}

                ?>
			</div>
		</div>
	</main>

<?php

//var_dump($sorted_ids);


get_footer();