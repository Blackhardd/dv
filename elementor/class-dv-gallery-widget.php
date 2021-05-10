<?php

class DV_Gallery extends \Elementor\Widget_Base {
    public function __construct( $data = [], $args = null ){
        parent::__construct( $data, $args );

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'widget_styles'] );
        wp_register_script( 'dv-gallery', get_template_directory_uri() . '/assets/js/elementor/gallery.js', [ 'elementor-frontend', 'fancybox' ], DV_THEME_VERSION, true );
    }

    public function get_name(){
        return 'dv_gallery';
    }

    public function get_title(){
        return __( 'DV Gallery', 'dv' );
    }

    public function get_icon(){
        return 'fa fa-code';
    }

    public function get_categories(){
        return ['general'];
    }

    public function widget_styles(){
        wp_enqueue_style( 'fancybox' );
    }

    public function get_script_depends(){
        return [ 'dv-gallery' ];
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'dv' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' 		=> __( 'Gallery', 'dv' ),
                'type' 			=> \Elementor\Controls_Manager::GALLERY,
                'default'       => []
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        echo "
            <div class='gallery'>
        ";

        foreach( $settings['gallery'] as $item ){
            $thumb = wp_get_attachment_image( $item['id'], 'gallery-thumb' );
            echo "
                <a href='{$item['url']}' data-fancybox>
                    {$thumb}
                </a>
            ";
        }

        echo "
            </div>
        ";
    }

    protected function _content_template(){

    }
}