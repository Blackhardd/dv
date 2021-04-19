<?php get_header(); ?>

<main class="site-main" id="content">
    <?php if( have_posts() ) :
        while( have_posts() ) :
			the_post();
			get_template_part( 'templates/content/' . get_post_type() );
		endwhile;
    endif; ?>
</main>

<?php get_footer(); ?>