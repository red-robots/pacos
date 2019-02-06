<?php
$wp_query = new WP_Query(array('pagename'=>'reservations'));
if ( have_posts() ) : the_post(); ?>
<section id="reservations" class="section text-center reservations clear">
	<div class="wrapper">
		<div class="maintext clear"><?php the_content(); ?></div>
		<?php
			$content_2_title = get_field('content_2_title');
			$powered_by_text = get_field('powered_by_text');
			$powered_by_logo = get_field('powered_by_logo');
			$button_name = get_field('button_name');
			$button_link = get_field('button_link');
			$bottom_title = get_field('bottom_title');
			$bottom_text = get_field('bottom_text');
		?>
		<?php if($content_2_title) { ?>
			<h2 class="title2"><?php echo $content_2_title; ?></h2>
		<?php } ?>
		<?php if($powered_by_text) { ?>
			<small class="smalltxt"><?php echo $powered_by_text; ?></small>
		<?php } ?>
		<?php if($button_name && $button_link) { ?>
			<div class="button"><a class="btn" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_name; ?></a></div>
		<?php } ?>
		<?php if($powered_by_logo) { ?>
			<div class="poweredlogo"><img src="<?php echo $powered_by_logo['url']; ?>" alt="" /></div>
		<?php } ?>

		<?php if($bottom_title || $bottom_text) { ?>
			<div class="bottom-text">
				<?php if($bottom_title) { ?>
				<h3 class="title3"><?php echo $bottom_title;?></h3>
				<?php } ?>
				<?php if($bottom_text) { ?>
				<div class="bottom-text"><?php echo $bottom_text;?></div>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>
<?php endif; ?>