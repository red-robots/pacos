<?php 
$wp_query = new WP_Query(array('pagename'=>'private-dining'));
if ( have_posts() ) : the_post(); ?>
<section id="private_dining" class="section dining clear">
	<div class="wrapper">
		<h2 class="section-title"><?php the_title(); ?></h2>
		<div class="maintext clear"><?php the_content(); ?></div>
	</div>
</section>
<?php endif; ?>