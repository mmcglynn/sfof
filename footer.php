<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sfof
 */


if( is_active_sidebar( 'sidebar-subfooter' ) ):
?>
	<section class="subfooter full-width padded-top-large-double padded-bottom-large p-relative bg-dark-gray">
		<div class="inner flex-box space-between p-relative bring-to-front">
			<?php dynamic_sidebar('sidebar-subfooter'); ?>
		</div>
	</section>
<?php
endif;
?>


	<footer class="full-width padded-bottom-large p-relative bg-dark-gray">
		<div class="inner border-top padded-top-large">
			<p class="padded-vert no-margin txt-center smaller txt-white">
				<span class="copyright">Copyright &copy;<?php echo date( 'Y', current_time( 'timestamp', 1 ) ); ?>.</span>
				<a class="txt-body" href="<?php echo home_url();?>" target="_blank" style="color: #fff"><?php echo get_bloginfo('name');?></a>
			</p>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
