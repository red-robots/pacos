<?php
	$contact_text = get_field('contact_text','option');
	$contact_form_shortcode = get_field('contact_form_shortcode','option');
?>
<?php if($contact_form_shortcode && do_shortcode($contact_form_shortcode) ) { ?>
<div class="sticky-contact-form">
	<div class="wrapp clear">
		<div id="formTitleDiv" class="titlediv clear"><a id="contactFormPp" href="#"><span class="txt">Contact Us</span><span class="icon"><i class="fal fa-angle-up"></i></span></a></div>
		<div id="formContents" class="inside-wrap clear">
			<div class="inside clear">
				<?php if($contact_text) { ?><div class="note"><?php echo $contact_text; ?></div><?php } ?>
				<?php echo do_shortcode($contact_form_shortcode); ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>