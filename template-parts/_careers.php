<?php 
$post = get_post_by_slug('careers');
if ( $post ) { 
$post_id = $post->ID;
$content = apply_filters( 'the_content', $post->post_content ); ?>
<section id="careers" class="section careers clear">
	<div class="wrapper">
		<?php 
			$content_title = get_field('content_title',$post_id);
			$text_content = get_field('text_content',$post_id);
			$feat_image = get_field('bottom_featured_image',$post_id);
			$button_name = get_field('button_name',$post_id);
			$button_link = get_field('button_link',$post_id);
			$powered_by_logo = get_field('powered_by_logo',$post_id);
		?>

		<div class="maintext<?php echo ($feat_image) ? ' has-image':'';?>">

			<div class="col one">
				<h2 class="section-title"><?php echo $content_title; ?></h2>
				<?php echo $text_content; ?>

				<?php if($button_name && $button_link) { ?>
				<div class="button text-center">
					<a class="btn-red-border" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_name; ?></a>
				</div>
				<?php } ?>	

				<?php if($powered_by_logo) { ?>
				<div class="poweredby text-center">
					<img src="<?php echo $powered_by_logo['url'];?>" alt="<?php echo $powered_by_logo['title'];?>" /> 
				</div>
				<?php } ?>	

			</div>

			<?php if($feat_image) { ?>
			<div class="col two">
				<img src="<?php echo $feat_image['url'];?>" alt="<?php echo $feat_image['title'];?>" /> 
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>

