<?php
$banner = get_field('banner_image');
$title1 = get_field('banner_title_1');
$title2 = get_field('banner_title_2');
if($banner) {  ?>
<div class="banner" style="background-image:url('<?php echo $banner['url'];?>');">
	<div class="overlay"></div>
	<div class="caption">
		<div class="inside clear">
		<?php if($title1) { ?>
			<h2 class="title"><?php echo $title1;?></h2>
		<?php } ?>
		<?php if($title2) { ?>
			<h3 class="subtitle"><?php echo $title2;?></h3>
		<?php } ?>
		</div>
	</div>
	<img src="<?php echo $banner['url'];?>" alt="<?php echo $banner['title'];?>" />
</div>
<?php } ?>