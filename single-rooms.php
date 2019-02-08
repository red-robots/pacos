<?php
get_header(); ?>
	<div id="primary" class="full-content-area default-temp single-room-page clear">
		<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); 
			$post_id = get_the_ID();
			$thumbnail_id = get_post_thumbnail_id($post_id);
			$has_feat_image = get_the_post_thumbnail($post_id,'medium_large'); 
			$large_image = wp_get_attachment_image_src($thumbnail_id,'large'); 
			?>

			<div class="text-wrapper<?php echo ($has_feat_image) ? ' has-image':''; ?>">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content"><?php the_content(); ?></div>
			</div>

			<?php if($has_feat_image) { ?>
			<div class="featured-image"><a class="colorboxNoSlide" title="<?php echo get_the_title(); ?>" href="<?php echo $large_image[0]; ?>"><?php echo $has_feat_image; ?></a></div>
			<?php } ?>

		<?php endwhile;  ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
