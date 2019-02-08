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
			<?php
				$page_content = get_field('page_404_content','option');
				echo $page_content;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
