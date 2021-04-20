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

<header class="site-header">
    <div class="site-header__inner">
        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div>

        <nav class="site-nav">
            <?php wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'main-menu',
			) ); ?>
        </nav>

        <?=do_shortcode( '[social_icons facebook="https://www.facebook.com/" instagram="https://www.instagram.com/"]' ); ?>
    </div>
</header>