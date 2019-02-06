<?php
$wp_query = new WP_Query(array('pagename'=>'order-delivery'));
if ( have_posts() ) : the_post(); ?>
<section id="order_delivery" class="section text-center delivery clear">
	<div class="wrapper">
		<div class="maintext clear"><?php the_content(); ?></div>
		<?php
			$button_name_1 = get_field('button_name_1');
			$button_link_1 = get_field('button_link_1');
			$image_1 = get_field('image_1');
			$button_name_2 = get_field('button_name_2');
			$button_link_2 = get_field('button_link_2');
			$image_2 = get_field('image_2');
			$bottom_text = get_field('bottom_text');
			$app_store_link = get_field('app_store_link');
			$google_play_link = get_field('google_play_link');
			$template_url = get_bloginfo('template_url');
		?>
		<?php if($button_name_1 && $button_link_1) { ?>
		<div class="button">
			<a class="btn-red-border" href="<?php echo $button_link_1; ?>"><?php echo $button_name_1; ?></a>
		</div>
		<?php } ?>	

		<?php if($image_1) { ?>
		<div class="imagediv">
			<img src="<?php echo $image_1['url']; ?>" alt="<?php echo $image_1['title']; ?>" />
		</div>
		<?php } ?>	

		<?php if($image_2) { ?>
		<div class="imagediv last">
			<img src="<?php echo $image_2['url']; ?>" alt="<?php echo $image_2['title']; ?>" />
		</div>
		<?php } ?>	

		<?php if($button_name_2 && $button_link_2) { ?>
		<div class="button">
			<a class="btn-red-border" href="<?php echo $button_link_2; ?>"><?php echo $button_name_2; ?></a>
		</div>
		<?php } ?>	

		<?php if($bottom_text) { ?>
		<div class="bottom_text">
			<?php echo $bottom_text; ?>
		</div>
		<?php } ?>	

		<div class="apps">
		<?php if($app_store_link) { ?>
			<a href="<?php echo $app_store_link?>" target="_blank"><img src="<?php echo $template_url?>/images/app_store.png" alt="" /></a>
		<?php } ?>	
		<?php if($google_play_link) { ?>
			<a href="<?php echo $google_play_link?>" target="_blank"><img src="<?php echo $template_url?>/images/google_play.png" alt="" /></a>
		<?php } ?>	
		</div>

	</div>
</section>
<?php endif; ?>