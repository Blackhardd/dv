<?php

class DV_List_Widget extends \Elementor\Widget_Base {
    public function get_name(){
        return 'dv_list';
    }

    public function get_title(){
        return __( 'DV List', 'dv' );
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
                'label' => __( 'Content', 'dv' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label'         => __( 'Text', 'dv' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' 	=> __( 'Enter text', 'dv' )
            ]
        );

        $this->add_control(
            'list',
            [
                'label' 		=> __( 'List items', 'dv' ),
                'type' 			=> \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        echo "<div class='styled-list'>";

        if( $settings['list'] ){
            echo "<ul class='styled-list__items'>";
            foreach( $settings['list'] as $item ) :
                echo "
                    <li class='styled-list__item'><span class='styled-list__item-icon'></span><span class='styled-list__item-text'>{$item['text']}</span></li>
                ";
            endforeach;
            echo "</ul>";
        }

        echo "</div>";
    }

    protected function _content_template(){

    }
}