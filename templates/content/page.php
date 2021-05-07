<?php if( !is_front_page() ) : ?>
    <header class="page-header">
        <div class="container">
            <?php the_title( '<h1>', '</h1>' ); ?>
        </div>
    </header>
<?php endif; ?>

<main class="page-content">
    <div class="container">
        <?php the_content(); ?>
    </div>
</main>