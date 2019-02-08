<?php
$urlParam = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<script type="text/javascript">
	var siteURL = '<?php echo get_site_url(); ?>';
	var currentPage = '<?php echo ( is_front_page() ) ? 'home':'subpage'; ?>';
	var full_URL = '<?php echo $urlParam?>';
	var currentURL = '<?php echo get_permalink()?>';
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>
	<a id="toggleMenu"><span></span></a>
	<div id="mobile-navigation" class="mobile-navigation" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-mobile-menu', 'container_class'=>'mobile-menu-wrap') ); ?>
	</div><!-- #site-navigation -->

	<div id="home"></div>
	<header id="masthead" class="site-header" role="banner">
		<div class="inner clear">
			<?php if( get_custom_logo() ) { ?>
	            <div class="logo clear">
	            	<?php the_custom_logo(); ?>
	            </div>
	        <?php } else { ?>
	            <h1 class="logo">
		            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
	            </h1>
	        <?php } ?>
			<nav id="site-navigation" class="main-navigation clear" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div><!-- wrapper -->
	</header><!-- #masthead -->


	<?php if( is_front_page() ) { ?>
		<?php get_template_part('template-parts/home-banner'); ?>
	<?php } ?>

	<div id="content" class="site-content clear">
