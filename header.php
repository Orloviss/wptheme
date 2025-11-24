<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wptheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/css/style.css" as="style">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="header" class="site-header">
			<div class="container flex-row">
				<a href="/" class="logo">
					<img src="" />
				</a>
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>

				</nav>

				<div class="btn_row popup__btn">
					<div class="burger"><img src="" /></div>
				</div>

			</div>
		</header>
		<section class="burger-menu">
			<div class="container flex-col">
				<button class="close-icon">
					<img src="" />
				</button>
				<nav id="mobile-navigation" class="mobile-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>

				</nav>
			</div>
		</section>