<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arc10
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="page-wrapper">
	<div class="sidebar-container">
		<div class="menu-push">
			<div class="main-sidebar">
				<header id="masthead">
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
						$arc10_description = get_bloginfo( 'description', 'display' );
						if ( $arc10_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $arc10_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'arc10' ); ?></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</header><!-- #masthead -->
				<div class="header-footer site-footer">
					<div class="site-info">
						<div class="header-address">
							<p>Arc-10 Studio</p>
							<p>Unit 1</p>
							<p>An industrial Park</p>
							<p>Manchester</p>
							<p>M1 1JG</p>
						</div>
						<div class="header-email">
							<i class="fas fa-envelope-square"></i> <a href="mailto:info@arc-10studio.com">info@arc-10studio.com</a>
						</div>
						<div class="header-phone">
							<i class="fas fa-phone-square-alt"></i> <a href="tel:01611234567">01611234567</a>
						</div>
						<div class="header-socials">
							<i class="fab fa-linkedin"></i> <i class="fab fa-instagram-square"></i> <i class="fab fa-facebook-square"></i> <i class="fab fa-twitter-square"></i>
						</div>
					</div><!-- .site-info -->
				</div>
			</div>
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'arc10' ); ?></a>

		</div>
	</div>

	<div id="page" class="site page-container">


