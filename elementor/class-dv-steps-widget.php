<?php

class DV_Steps extends \Elementor\Widget_Base {
	public function get_name(){
        return 'dv_steps';
    }

	public function get_title(){
        return __( 'DV Steps', 'dv' );
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
			'steps_heading',
			[
				'label' 		=> __( 'Heading', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
                'placeholder'   => __( 'Enter heading', 'dv' )
			]
		);

        $this->add_control(
			'steps_subheading',
			[
				'label' 		=> __( 'Subheading', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
                'placeholder'   => __( 'Enter subheading', 'dv' )
			]
		);

        $this->add_control(
            'bg_color',
            [
                'label'     => __( 'Background color', 'dv' ),
                'type'      => \Elementor\Controls_Manager::COLOR
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'step_title',
            [
				'label'         => __( 'Title', 'dv' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Enter title', 'dv' )
			]
        );

        $repeater->add_control(
            'step_content',
            [
				'label'         => __( 'Content', 'dv' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Enter content', 'dv' )
			]
        );

		$this->add_control(
			'steps',
			[
				'label' 		=> __( 'Steps', 'dv' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
    }

	protected function render(){
        $settings = $this->get_settings_for_display();
        $style = '';

        if( $settings['bg_color'] ){
            $style .= "background-color: {$settings['bg_color']};";
            $style .= "border-radius: 0 32px;";
        }

        echo "<div class='steps' style='{$style}'>";

        if( $settings['steps_heading'] ){
            echo "
                <div class='steps__left'>
                    <div class='steps__title'>
                        <h2 class='steps__heading'>{$settings['steps_heading']}</h2>
                        <div class='steps__subheading'>{$settings['steps_subheading']}</div>
                    </div>
                </div>
            ";
        }

        if( $settings['steps'] ){
            echo "<div class='steps__right'>";

            foreach( $settings['steps'] as $key => $step ) :
                $number = $key + 1;

                echo "
                    <div class='step'>
                        <div class='step__number'>{$number}</div>
                        <div class='step__inner'>
                            <h3 class='step__heading'>{$step['step_title']}</h3>
                            <div class='step__content'>{$step['step_content']}</div>
                        </div>
                    </div>
                ";
            endforeach;

            echo "</div>";
        }

        echo "</div>";
    }

	protected function _content_template(){

    }
}