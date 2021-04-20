<?php

add_action( 'init', 'dv_load_elementor_widgets' );
function dv_load_elementor_widgets(){
    if( !class_exists( 'DV_Hero_Widget' ) ) :
        require TEMPLATEPATH . '/elementor/class-dv-hero-widget.php';
    endif;

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new DV_Hero_Widget() );
}