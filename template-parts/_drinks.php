<?php 
$post = get_post_by_slug('drinks');
if ( $post ) { 
$post_id = $post->ID;
$content = apply_filters( 'the_content', $post->post_content ); ?>

<?php
	$background_image = get_field('background_image',$post_id);
	$overlay_logo = get_field('overlay_logo',$post_id);
	$style = '';
	if($background_image) {
		$style = ' style="background-image:url('.$background_image['url'].')"';
	}
?>

<section id="drinks" class="section text-center delivery drinks clear"<?php echo $style;?>>
	<div class="overlay"></div>
	<div class="wrapper">
		
		<?php if($overlay_logo) { ?>
			<div class="content-image">
				<img src="<?php echo $overlay_logo['url'];?>" alt="<?php echo $overlay_logo['title'];?>" />
			</div>
		<?php } ?>

		<?php
			$drinks = get_field('drinks',$post_id); 
			$column_1_title = get_field('column_1_title',$post_id); 
			$sample_drinks = get_field('sample_drinks',$post_id); 
			$column_2_title = get_field('column_2_title',$post_id); 
			$daily_features = get_field('daily_features',$post_id); 
		?>

		<?php if($drinks) { ?>
		<div class="food-menu clear">
			<ul>
			<?php foreach($drinks as $m) {
				$menu_name = $m['name'];
				$menu_link = ($m['link']) ? $m['link'] : '#'; ?>
				<li><a class="btn-white-border" href="<?php echo $menu_link; ?>"><?php echo $menu_name; ?></a></li>
			<?php } ?>	
			</ul>
		</div>
		<?php } ?>	

		<div class="columns-wrap clear">
			<div class="row clear">
			<?php if($column_1_title || $sample_drinks) { ?>
				<div class="column one">
					<?php if($column_1_title) { ?>
					<p class="col-title"><?php echo $column_1_title; ?></p>
					<?php } ?>

					<?php if($sample_drinks) { ?>
					<ul class="details">
						<?php foreach($sample_drinks as $sd) { 
						$name = $sd['name']; 
						$description = $sd['description']; 
						$price = $sd['price'];  ?>
						<li>
							<?php if($name) { ?>
							<p class="name"><?php echo $name; ?></p>
							<?php } ?>

							<?php if($description) { ?>
							<div class="description"><?php echo $description; ?></div>
							<?php } ?>

							<?php if($price) { ?>
							<div class="price"><?php echo $price; ?></div>
							<?php } ?>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if($column_2_title || $daily_features) { ?>
				<div class="column two">
					<?php if($column_2_title) { ?>
					<p class="col-title"><?php echo $column_2_title; ?></p>
					<?php } ?>

					<?php if($daily_features) { ?>
					<ul class="details features">
						<?php foreach($daily_features as $df) { 
						$day = $df['day']; 
						$description = $df['description'];  ?>
						<li>
							<?php if($day) { ?>
							<p class="name"><?php echo $day; ?></p>
							<?php } ?>

							<?php if($description) { ?>
							<div class="description"><?php echo $description; ?></div>
							<?php } ?>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
			<?php } ?>

			</div>
		</div>


	</div>
</section>

<?php } ?>