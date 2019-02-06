<?php
$wp_query = new WP_Query(array('pagename'=>'menus'));
if ( have_posts() ) : the_post(); ?>
<section id="menus" class="section text-center menus clear">
	<div class="wrapper">
		<div class="maintext clear"><?php the_content(); ?></div>
		<?php
			$content_image = get_field('content_image');
			$menus = get_field('menus');
		?>

		<?php if($content_image) { ?>
		<div class="content-image">
			<img src="<?php echo $content_image['url'];?>" alt="<?php echo $content_image['title'];?>" />
		</div>
		<?php } ?>	

		<?php if($menus) { ?>
		<div class="food-menu clear">
			<ul>
			<?php foreach($menus as $m) {
				$menu_name = $m['name'];
				$menu_link = ($m['link']) ? $m['link'] : '#'; ?>
				<li><a class="btn-red-border" href="<?php echo $menu_link; ?>"><?php echo $menu_name; ?></a></li>
			<?php } ?>	
			</ul>
		</div>
		<?php } ?>	

		
	</div>
</section>
<?php endif; ?>