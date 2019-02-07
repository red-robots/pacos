<?php 
$post = get_post_by_slug('gift-cards');
if ( $post ) { 
$post_id = $post->ID;
$content = apply_filters( 'the_content', $post->post_content ); ?>

<?php 
	$background_image = get_field('background_image',$post_id);
	$section_title = get_field('section_title',$post_id);
	$image_icon = get_field('image_icon',$post_id);
	$button_name = get_field('button_name',$post_id);
	$button_link = get_field('button_link',$post_id);
	$style = '';
	if($background_image) {
		$style = ' style="background-image:url('.$background_image['url'].')"';
	}
?>
<section id="gift_cards" class="section giftcards clear"<?php echo $style;?>>
	<div class="overlay"></div>
	<div class="wrapper">
		<?php if($section_title) { ?>
			<h2 class="section-title text-center"><?php echo $section_title; ?></h2>
		<?php } ?>

		<?php if($image_icon) { ?>
		<div class="imagediv text-center">
			<img src="<?php echo $image_icon['url'];?>" alt="<?php echo $image_icon['title'];?>" /> 
		</div>
		<?php } ?>	

		<?php if($button_name && $button_link) { ?>
		<div class="button text-center">
			<a class="btn-white-border" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_name; ?></a>
		</div>
		<?php } ?>	

	</div>
</section>
<?php } ?>

