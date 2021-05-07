    <footer class="site-footer">
        <div class="site-footer__top">
            <div class="container">
                <div class="row row--space-between">
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>

                    <?=do_shortcode( '[mc4wp_form id="518"]' ); ?>
                </div>
            </div>
        </div>
        <div class="site-footer__bottom">
            <div class="container">
                <div class="copyright">
                    Tvorba webových stránek od <a href="https://topranker.cz/tvorba-web-stranek/">Topranker.cz</a>
                </div>
            </div>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>