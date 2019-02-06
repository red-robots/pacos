<?php get_header(); ?>
	<div id="primary" class="full-content-area clear">
		<?php while ( have_posts() ) : the_post(); ?>	
		<?php endwhile; ?>

		<?php 
			/* RESERVATIONS */
			get_template_part('template-parts/_reservations'); 

			/* ORDER & DELIVERY */
			get_template_part('template-parts/_order_delivery'); 

			/* MENUS */
			get_template_part('template-parts/_menus'); 

			/* DRINKS */
			get_template_part('template-parts/_drinks'); 

		?>
	</div><!-- #primary -->
<?php
get_footer();
