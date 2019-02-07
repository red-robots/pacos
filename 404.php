<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="full-content-area default-temp clear">
		<main id="main" class="site-main wrapper" role="main">

			<p>We couldn't find the page you were looking for. This is either because:</p>
			<ul>
			  <li>There is an error in the URL entered into your web browser. Please check the URL and try again.</li>
			  <li>The page you are looking for has been moved or deleted.</li>
			</ul>

			<p>
			  You can return to our homepage by <a href="<?php echo get_site_url();?>">clicking here</a>, or you can try searching for the
			  content you are seeking by <a href="<?php echo get_site_url();?>/search">clicking here</a>.
			</p>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
