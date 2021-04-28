<?php

class DV_Person_Contact_Widget extends \Elementor\Widget_Base {
    public function get_name(){
        return 'dv_person_contact';
    }

    public function get_title(){
        return __( 'DV Person Contact', 'dv' );
    }

    public function get_icon(){
        return 'fa fa-code';
    }

    public function get_categories(){
        return ['general'];
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'content_section',
            [
                'label'     => __( 'Content', 'dv' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'name',
            [
                'label'         => __( 'Name', 'dv' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'placeholder' 	=> __( 'Enter name', 'dv' )
            ]
        );

        $this->add_control(
            'information',
            [
                'label'         => __( 'Information', 'dv' ),
                'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' 	=> __( 'Enter information', 'dv' )
            ]
        );

        $this->add_control(
            'photo',
            [
                'label'         => __( 'Photo', 'dv' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'default'       => [
                    'url'           => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => __( 'Background color', 'plugin-domain' ),
                'type'      => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        if( $settings['photo'] ){
            $image = wp_get_attachment_image( $settings['photo']['id'], 'full' );
        }

        if( $settings['bg_color'] ){
            $style = "background-color: {$settings['bg_color']};";
        }

        echo "
            <div class='person-contact' style='{$style}'>
                <div class='person-contact__content'>
                    <div class='contact-person__name'>{$settings['name']}</div>
                    <div class='contact-person__information'>{$settings['information']}</div>
                </div>
                {$image}
            </div>
        ";
    }

    protected function _content_template(){

    }
}