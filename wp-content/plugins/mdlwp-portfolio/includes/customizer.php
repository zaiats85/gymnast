<?php

function mdlwp_portfolio_customizer_register( $wp_customize ) {

	$wp_customize->add_panel( 'mdlwp_portfolio', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Portfolio', 'mdlwp-portfolio' ),
	    'description' => __( 'Customize the portfolio layout', 'mdlwp-portfolio' ),
	    'active_callback' => 'callback_portfolio',
	) );

	function callback_portfolio(){ 
		return is_post_type_archive( 'portfolio' );
	}

	$wp_customize->add_section( 'portfolio_options', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Options', 'mdlwp-portfolio' ),
	    'description' => '',
	    'panel' => 'mdlwp_portfolio',
	) );

	$wp_customize->add_setting( 'display_filter', array(
		'default'			=> true,
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'mdlwp_sanitize_checkbox'
		)
	);

	$wp_customize->add_control( 'display_filter', array(
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'portfolio_options',
	    'label' => __( 'Display Filter', 'mdlwp-portfolio' ),
	    'description' => '',
	) );

	$wp_customize->add_section( 'portfolio_layout', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Portfolio Layout', 'mdlwp-portfolio' ),
	    'description' => '',
	    'panel' => 'mdlwp_portfolio',
	) );

	/**
	 * Create a Radio-Image control
	 * 
	 * This class incorporates code from the Kirki Customizer Framework and from a tutorial
	 * written by Otto Wood.
	 * 
	 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
	 * is licensed under the terms of the GNU GPL, Version 2 (or later).
	 * 
	 * @link https://github.com/reduxframework/kirki/
	 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
	 */
	class MDLWP_Portfolio_Custom_Radio_Image_Control extends WP_Customize_Control {
		
		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'radio-image';
		
		/**
		 * Enqueue scripts and styles for the custom control.
		 * 
		 * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
		 * 
		 * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
		 * at 'customize_controls_print_styles'.
		 *
		 * @access public
		 */
		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-button' );
		}
		
		/**
		 * Render the control to be displayed in the Customizer.
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}			
			
			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title">
				<?php echo esc_attr( $this->label ); ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</span>
			<div id="input_<?php echo $this->id; ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<label for="<?php echo $this->id . $value; ?>">
							<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
						</label>
					</input>
				<?php endforeach; ?>
			</div>
			<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
			<?php
		}
	}

	
	$wp_customize->add_setting(
		// $id
		'portfolio_layout',
		// $args
		array(
			'default'			=> 'three-column',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'mdlwp_sanitize_select'
		)
	);
	
	$wp_customize->add_control(
		new MDLWP_Portfolio_Custom_Radio_Image_Control( 
			// $wp_customize object
			$wp_customize,
			// $id
			'portfolio_layout',
			// $args
			array(
				'settings'		=> 'portfolio_layout',
				'section'		=> 'portfolio_layout',
				'label'			=> __( 'Layout', 'mdlwp-portfolio' ),
				'description'	=> __( 'Select the layout for the portfolio.', 'mdlwp-portfolio' ),
				'choices'		=> array(
					'two-column' 	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/2-col-portfolio.png',
					'three-column'	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/3-col-portfolio.png',
					'four-column' 	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/4-col-portfolio.png',
				)
			)
		)
	);

	$wp_customize->add_section( 'portfolio_related', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Related Portfolio Items', 'mdlwp-portfolio' ),
	    'description' => '',
	    'panel' => 'mdlwp_portfolio',
	) );

	$wp_customize->add_setting( 'display_related', array(
		'default'			=> true,
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'mdlwp_sanitize_checkbox'
		)
	);

	$wp_customize->add_control( 'display_related', array(
	    'type' => 'checkbox',
	    'priority' => 10,
	    'section' => 'portfolio_related',
	    'label' => __( 'Display Related Items', 'mdlwp-portfolio' ),
	    'description' => '',
	) );

	$wp_customize->add_setting( 'related_title', array(
		'default'			=> 'Related Projects',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		)
	);

	$wp_customize->add_control( 'related_title', array(
	    'type' => 'text',
	    'priority' => 10,
	    'section' => 'portfolio_related',
	    'label' => __( 'Related Items Title', 'mdlwp-portfolio' ),
	    'description' => '',
	) );

	$wp_customize->add_setting( 'related_items', array(
		'default'			=> 3,
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		)
	);

	$wp_customize->add_control( 'related_items', array(
	    'type' => 'number',
	    'priority' => 10,
	    'section' => 'portfolio_related',
	    'label' => __( 'Number of Related Items', 'mdlwp-portfolio' ),
	    'description' => 'How many related items would you like to show?',
	) );

	$wp_customize->add_setting(
		// $id
		'related_layout',
		// $args
		array(
			'default'			=> 'three-column',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'mdlwp_sanitize_select'
		)
	);
	
	$wp_customize->add_control(
		new MDLWP_Portfolio_Custom_Radio_Image_Control( 
			// $wp_customize object
			$wp_customize,
			// $id
			'related_layout',
			// $args
			array(
				'settings'		=> 'related_layout',
				'section'		=> 'portfolio_related',
				'label'			=> __( 'Layout', 'mdlwp-portfolio' ),
				'description'	=> __( 'Select the layout for the related items.', 'mdlwp-portfolio' ),
				'choices'		=> array(
					'two-column' 	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/2-col-portfolio.png',
					'three-column'	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/3-col-portfolio.png',
					'four-column' 	=> MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/img/4-col-portfolio.png',
				)
			)
		)
	);

}
add_action( 'customize_register', 'mdlwp_portfolio_customizer_register' );


/**
 * Add CSS for custom controls
 *
 * This function incorporates CSS from the Kirki Customizer Framework
 *
 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later)
 *
 * @link https://github.com/reduxframework/kirki/
 */
function mdlwp_portfolio_customizer_custom_control_css() { 
	?>
	<style>
	.customize-control-radio-image .image.ui-buttonset input[type=radio] {
		height: auto; 
	}
	.customize-control-radio-image .image.ui-buttonset label {
		display: inline-block;
		margin-right: 5px;
		margin-bottom: 5px; 
	}
	.customize-control-radio-image .image.ui-buttonset label.ui-state-active {
		background: none;
	}
	.customize-control-radio-image .customize-control-radio-buttonset label {
		padding: 5px 10px;
		background: #f7f7f7;
		border-left: 1px solid #dedede;
		line-height: 35px; 
	}
	.customize-control-radio-image label img {
		border: 1px solid #bbb;
		opacity: 0.5;
	}
	#customize-controls .customize-control-radio-image label img {
		max-width: 50px;
		height: auto;
	}
	.customize-control-radio-image label.ui-state-active img {
		border-color: #999; 
		opacity: 1;
	}
	.customize-control-radio-image label.ui-state-hover img {
		opacity: 0.9;
		border-color: #999; 
	}
	.customize-control-radio-buttonset label.ui-corner-left {
		border-radius: 3px 0 0 3px;
		border-left: 0; 
	}
	.customize-control-radio-buttonset label.ui-corner-right {
		border-radius: 0 3px 3px 0; 
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'mdlwp_portfolio_customizer_custom_control_css' );