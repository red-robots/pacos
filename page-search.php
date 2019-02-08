<?php 
get_header(); 
$string = ( isset($_GET['q']) && $_GET['q'] ) ? $_GET['q'] : '';
$page = ( isset($_GET['pg']) && $_GET['pg'] ) ? $_GET['pg'] : 1;
$limit = 2;
$x = $page*$limit;
$x = $x-$limit;
$offset = $x;
$result = custom_search_items($string,$offset,$limit);
$output = results_html($result,$page,true);
?>
<input type="hidden" name="page" id="pagenum" value="1" />
<input type="hidden" name="limit" id="limitnum" value="<?php echo $limit?>" />
<div id="primary" class="full-content-area clear default-temp">
	<main id="main" class="site-main wrapper" role="main">
		<div class="search-form-wrapper clear">
			<div id="spinner" class="spinner-wrapper"><div class="spinner"></div></div>
			<span class="search-icon"><i class="far fa-search"></i></span>
			<form method="get" action="<?php echo get_site_url()?>/search" class="search-item">
				<input id="search_input" placeholder="Type to search…" name="q" type="text" spellcheck="false" value="<?php echo $string; ?>" />
			</form>
		</div>

		<div id="search_results" class="search-result-list clear">
			<?php echo $output; ?>
		</div>

	</main>
</div>
<?php
get_footer();
