<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
global $post; 
$post_name = $post->post_name; 

/* post_name => template name */
$parts['careers'] = '_careers';
$parts['drinks'] = '_drinks';
$parts['gift-cards'] = '_gift_cards';
$parts['menus'] = '_menus';
$parts['order-delivery'] = '_order_delivery';
$parts['private-dining'] = '_private_dining';
$parts['reservations'] = '_reservations';

?>

	<div id="primary" class="full-content-area clear default-temp">
		<main id="main" class="site-main wrapper" role="main">

			<?php if( array_key_exists($post_name, $parts) ) { ?>
				<?php get_template_part('template-parts/' . $parts[$post_name]); ?>
			<?php } else { ?>
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
				?>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
