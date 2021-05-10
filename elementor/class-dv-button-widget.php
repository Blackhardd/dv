<?php

class DV_Button_Widget extends \Elementor\Widget_Base {
	public function get_name(){
        return 'dv_button';
    }

	public function get_title(){
        return __( 'DV Button', 'dv' );
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

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'dv' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter title', 'dv' )
			]
		);

        $this->add_control(
            'icon_class',
            [
                'label'         => __( 'IcoFont icon classname', 'dv' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'placeholder' 	=> __( 'Enter icon classname', 'dv' )
            ]
        );

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter URL', 'dv' ),
			]
		);

        $this->add_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 	    => 'left',
                'options'       => [
                    'left'          => __( 'Left', 'dv' ),
                    'center'        => __( 'Center', 'dv' ),
                    'right'         => __( 'Right', 'dv' )
                ]
			]
		);

        $this->add_control(
            'mobile_centering',
            [
                'label'         => __( 'Center on mobile', 'dv' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'dv' ),
                'label_off'     => __( 'Off', 'dv' ),
                'return_value'  => 'yes',
                'default'       => 'yes'
            ]
        );

		$this->end_controls_section();
    }

	protected function render(){
        $settings = $this->get_settings_for_display();

        $icon = '';
        $classes = 'button-wrap ';

        if( $settings['mobile_centering'] == 'yes' ){
            $classes .= 'button-wrap--m-center';
        }

        if( $settings['icon_class'] ){
            $icon = "<i class='{$settings['icon_class']}'></i>";
        }

        if( $settings['title'] && $settings['link'] ){
            echo "
                <div class='{$classes}' style='text-align: {$settings['alignment']};'>
                    <a href='{$settings['link']}' class='button'>{$settings['title']}{$icon}</a>
                </div>
            ";
        }
    }

	protected function _content_template(){

    }
}