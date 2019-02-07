<?php 
get_header(); 
$string = ( isset($_GET['q']) && $_GET['q'] ) ? $_GET['q'] : '';
$result = custom_search_items($string,0,5);
?>

	<div id="primary" class="full-content-area clear default-temp">
		<main id="main" class="site-main wrapper" role="main">

			<div class="search-form-wrapper clear">
				<div class="spinner-wrapper"><div class="spinner"></div></div>
				<span class="search-icon"><i class="far fa-search"></i></span>
				<form method="get" action="<?php echo get_site_url()?>/search" class="search-item">
					<input id="search_input" placeholder="Type to search…" name="q" type="text" spellcheck="false" value="<?php echo $string; ?>" />
				</form>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
