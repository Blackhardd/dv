<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( array( 'header-transparent' ) ); ?>>
<?php wp_body_open(); ?>

<?php if( false ) : ?>
    <div class="site-top-bar">
        <div class="site-top-bar__inner">
            <div>
                <?=sprintf( __( '%s nebo %s. PO - PÁ 8.00 – 16.00', 'dv' ), '<a href="tel:+420255707027">255 707 027</a>', '<a href="tel:+420778528182">778 528 182</a>' ); ?>
            </div>
            <?=do_shortcode( '[social_icons facebook="https://www.facebook.com/" instagram="https://www.instagram.com/"]' ); ?>
        </div>
    </div>
<?php endif; ?>

<header class="site-header <?=( is_front_page() ) ? 'transparent' : ''; ?>">
    <div class="site-header__inner">
        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div>

        <nav class="site-nav">
            <button class="site-nav__toggler"><span></span><span></span><span></span></button>

            <?php
            if( is_front_page() ) :
                wp_nav_menu( array(
                    'theme_location' => 'homepage-menu',
                    'menu_id'        => 'main-menu',
                ) );
            else :
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'menu_id'        => 'main-menu',
                ) );
            endif;
            ?>
        </nav>
    </div>
</header>