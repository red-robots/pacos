	</div><!-- #content -->

	<?php
		$address = get_field('address','option');
		$phone = get_field('phone','option');
		$facebook = get_field('facebook','option');
		$instagram = get_field('instagram','option');
		$twitter = get_field('twitter','option');
		$footer_logos = get_field('footer_logos','option');
	?>

	<footer id="colophon" class="site-footer clear" role="contentinfo">

		<div class="footer-top clear text-center">
			<div class="wrapper">
				<?php if($facebook || $instagram) { ?>
					<div class="social-media clear">
						<?php if($facebook) { ?>
							<a class="facebook" href="<?php echo $facebook?>" target="_blank"><i class="fab fa-facebook-f icon"></i></a>
						<?php } ?>
						<?php if($instagram) { ?>
							<a class="instagram" href="<?php echo $instagram?>" target="_blank"><i class="fab fa-instagram icon"></i></a>
						<?php } ?>
						<?php if($twitter) { ?>
							<a class="twitter" href="<?php echo $twitter?>" target="_blank"><i class="fab fa-twitter icon"></i></a>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if(have_rows('restaurants_logos', 'option')) : ?>
					<div class="footer-logos clear">
						<?php while(have_rows('restaurants_logos', 'option')) :  the_row(); 
						$img = get_sub_field('logo', 'option');
						$link = get_sub_field('link', 'option');
					?>
						<div class="restaurant">
							<a href="<?php echo $link; ?>">
								<img src="<?php echo $img['url']?>" alt="<?php echo $img['alt']?>" />
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom clear text-center">
			<div class="wrapper">
				<?php if($address) { ?>
				<div class="address clear"><?php echo $address?></div>
				<?php } ?>
				<?php if($phone) { ?>
				<div class="phone clear"><?php echo $phone?></div>
				<?php } ?>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<a href="#" class="scrollTop"></a>
<?php if( is_front_page() ) { ?>
<?php get_template_part('template-parts/contact-form'); ?>
<?php } ?>

<script type="text/javascript">
	window.onload = function() {
		$.colorbox({inline:true, href:".ajax"});
	}
</script>


<?php wp_footer(); ?>

</body>
</html>
