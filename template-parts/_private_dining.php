<?php 
$post = get_post_by_slug('private-dining');
if ( $post ) { 
$post_id = $post->ID;
$post_title = $post->post_title;
$content = apply_filters( 'the_content', $post->post_content ); ?>
<section id="private_dining" class="section dining clear">
	<div class="wrapper">
		<h2 class="section-title"><?php echo $post_title; ?></h2>
		<div class="maintext clear"><?php echo $content; ?></div>
	
		<?php
		$args = array(
			'posts_per_page'    => -1,
		    'post_type'         => 'rooms',
		    'post_status'       => 'publish'   
	    );
		$items = new WP_Query($args);
		if ( $items->have_posts() ) { ?>
		<div class="entries-wrapper clear">
			<?php while ( $items->have_posts() ) : $items->the_post();  
			$id = get_the_ID();
			$thumbnail_id = get_post_thumbnail_id($id);
			$largeImage = wp_get_attachment_image_src($thumbnail_id,'large');
			$has_image = get_the_post_thumbnail($id); 
			$button_name = get_field('button_name',$id);
			$button_link = get_field('button_link',$id);
			$powered = get_field('powered_by_image',$id); ?>
			<div class="room-info clear<?php echo ($has_image) ? ' has-image':''?>">
				<div class="col one">
					<h3 class="roomname"><?php the_title(); ?></h3>
					<?php if($button_name && $button_link) { ?>
					<div class="button">
						<a class="btn-red-border" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_name; ?></a>
					</div>
					<?php } ?>	
					<?php if($powered) { ?>
					<div class="poweredby"><img src="<?php echo $powered['url'];?>" alt="<?php echo $powered['title'];?>" /></div>
					<?php } ?>	
				</div>
				<div class="col two">
					<?php the_content(); ?>
				</div>
				<?php if($has_image) { ?>
				<div class="col three imagecol">
					<a class="colorboxNoSlide" title="<?php the_title(); ?>" href="<?php echo $largeImage[0]?>"><?php echo get_the_post_thumbnail($id,'medium_large'); ?></a>
				</div>
				<?php } ?>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php } ?>
	</div>
</section>
<?php } ?>
