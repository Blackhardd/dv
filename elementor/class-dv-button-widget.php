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

		$this->end_controls_section();
    }

	protected function render(){
        $settings = $this->get_settings_for_display();

        if( $settings['title'] && $settings['link'] ){
            echo "
                <div class='button-wrap' style='text-align: {$settings['alignment']};'>
                    <a href='{$settings['link']}' class='button'>{$settings['title']}</a>
                </div>
            ";
        }
    }

	protected function _content_template(){

    }
}