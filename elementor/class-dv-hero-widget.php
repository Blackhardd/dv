<?php

class DV_Hero_Widget extends \Elementor\Widget_Base {
	public function get_name(){
        return 'dv_hero';
    }

	public function get_title(){
        return __( 'DV Hero', 'dv' );
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
			'image',
			[
				'label'         => __( 'Choose hero image', 'dv' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
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
			'subtitle',
			[
				'label' 		=> __( 'Subtitle', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter subtitle', 'dv' ),
			]
		);

		$this->add_control(
			'btn_title',
			[
				'label' 		=> __( 'Button title', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter button title', 'dv' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' 		=> __( 'Button link', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter button link', 'dv' ),
			]
		);


		$this->end_controls_section();
    }

	protected function render(){
        $settings = $this->get_settings_for_display();

        $image = wp_get_attachment_image( $settings['image']['id'], 'full' );

        echo "
			<div class='hero'>
				{$image}
				<div class='hero__content'>
					<h1>{$settings['title']}</h1>
					<h2 class='hero__subtitle'>{$settings['subtitle']}</h2>
		";

		if( $settings['btn_title'] && $settings['btn_link'] ){
			echo "<a href='{$settings['btn_link']}' class='button hero__action'>{$settings['btn_title']}</a>";
		}

		echo "		
				</div>
			</div>
		";
    }

	protected function _content_template(){

    }
}