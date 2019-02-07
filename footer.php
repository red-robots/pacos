	</div><!-- #content -->

	<?php
		$address = get_field('address','option');
		$phone = get_field('phone','option');
		$facebook = get_field('facebook','option');
		$instagram = get_field('instagram','option');
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
					</div>
				<?php } ?>

				<?php if($footer_logos) { ?>
				<div class="footer-logo clear"><img src="<?php echo $footer_logos['url']?>" alt="<?php echo $footer_logos['title']?>" /></div>
				<?php } ?>
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

<?php wp_footer(); ?>

</body>
</html>
