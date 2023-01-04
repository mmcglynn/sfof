<?php // Template Name: Players Filter ?>
<?php 
get_header();
?>
	<div class="bg-red padded-top padded-bottom">
		<div class="inner">
			<span class="txt-white type-title text-uppercase">Players</span>
		</div>
	</div>
	<main id="primary" class="site-main padded-top-large padded-bottom-large">
		<div class="inner">
			
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; // End of the loop.
			
			$categories = get_categories(); 
			?>
			<ul class="cat-list">
			  <li><a class="cat-list_item active" href="#!" data-slug="">All projects</a></li>

			  <?php foreach($categories as $category) : ?>
				<li>
				  <a class="cat-list_item" href="#!" data-slug="<?= $category->slug; ?>">
					<?= $category->name; ?>
				  </a>
				</li>
			  <?php endforeach; ?>
			</ul>
			
			<?php 
			  $projects = new WP_Query([
				'post_type' => 'player',
				'posts_per_page' => -1,
				'order_by' => 'date',
				'order' => 'desc',
			  ]);
			?>

			<?php if($projects->have_posts()): ?>
			  <ul class="project-tiles">
				<?php
				  while($projects->have_posts()) : $projects->the_post();
					include('_components/project-list-item.php');
				  endwhile;
				?>
			  </ul>
			  <?php 
			  wp_reset_postdata(); 
			  endif; ?>
			
		</div>
		</div>
	</main><!-- #main -->
	<script>
		jQuery('.cat-list_item').on('click', function() {
		jQuery('.cat-list_item').removeClass('active');
		jQuery(this).addClass('active');

		jQuery.ajax({
		  type: 'POST',
		  url: '/wp-admin/admin-ajax.php',
		  dataType: 'html',
		  data: {
			action: 'sfof_filter_players',
			category: jQuery(this).data('slug'),
		  },
		  success: function(res) {
			jQuery('.project-tiles').html(res);
		  }
		})
	  });
	</script>
<?php
get_footer();