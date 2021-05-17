<?php

class DV_Steps extends \Elementor\Widget_Base {
    public function __construct( $data = [], $args = null ){
        parent::__construct( $data, $args );

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'widget_styles'] );

        wp_register_script( 'dv-steps', get_template_directory_uri() . '/assets/js/elementor/steps.js', [ 'elementor-frontend', 'glider' ], DV_THEME_VERSION, true );
    }

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

    public function widget_styles(){
        wp_enqueue_style( 'glider' );
    }

    public function get_script_depends(){
        return [ 'dv-steps' ];
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
            'image',
            [
                'label'         => __( 'Choose image', 'dv' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'default'           => [
                    'url'           => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'step_number',
            [
                'label'         => __( 'Number', 'dv' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'placeholder' 	=> __( 'Enter step number', 'dv' )
            ]
        );

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
        }

        echo "<div class='steps' style='{$style}'>";

        if( $settings['steps_heading'] ){
            echo "
                <div class='steps__title'>
                    <h2 class='steps__heading'>{$settings['steps_heading']}</h2>
                    <div class='steps__subheading'>{$settings['steps_subheading']}</div>
                </div>
            ";
        }

        if( $settings['steps'] ){
            echo "<div class='steps__slider'>";

            foreach( $settings['steps'] as $key => $step ) :
                $image = '';

                if( $step['image'] ){
                    $image = wp_get_attachment_image( $step['image']['id'] );
                }

                echo "
                    <div class='step'>
                        <div class='step__inner'>
                            <div class='step__header'>
                                <div class='step__number'>{$step['step_number']}</div>
                                {$image}
                            </div>
                            <div class='step__body'>
                                <h3 class='step__heading'>{$step['step_title']}</h3>
                                <div class='step__desc'>{$step['step_content']}</div>
                            </div>
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