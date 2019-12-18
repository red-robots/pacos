<?php
$post = get_post_by_slug('menus');
if ( $post ) { 
$post_id = $post->ID;
$content = apply_filters( 'the_content', $post->post_content ); ?>

<section id="menus" class="section text-center menus clear">

	<div class="wrapper">
		<div class="maintext clear"><?php echo $content; ?></div>
		<?php
			$content_image = get_field('content_image',$post_id);
			$menus = get_field('menus',$post_id);
		?>

		<?php if($content_image) { ?>
		<div class="content-image">
			<img src="<?php echo $content_image['url'];?>" alt="<?php echo $content_image['title'];?>" />
		</div>
		<?php } ?>	
	</div>
	
	<?php if($menus) { ?>
	<div class="food-menu clear">
		<ul class="menuInfo">
		<?php foreach($menus as $m) {
			$menu_name = $m['name'];
			$menu_link = ($m['link']) ? $m['link']['url'] : '#'; 
			?>
			<li><a class="btn-red-border" href="<?php echo $menu_link; ?>" target="_blank"><?php echo $menu_name; ?></a></li>
		<?php } ?>	
		</ul>
	</div>
	<?php } ?>	
	
</section>
<?php } ?>