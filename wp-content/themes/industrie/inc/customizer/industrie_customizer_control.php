<?php
//add new custom control type switch
if(class_exists( 'WP_Customize_control')){

	// Switch controll
	class industrie_Customize_Switch_Control extends WP_Customize_Control {
		public $type = 'switch';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<div class="switch_options">
					<span class="switch_enable"><?php esc_html_e('On','industrie'); ?></span>
					<span class="switch_disable"><?php esc_html_e('Off','industrie'); ?></span>
					<input type="hidden" id="switch_yes_no" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				</div>
			</label>
			<?php
		}
	}
	
	// Select controll
	class industrie_Customize_Select_Control extends WP_Customize_Control {
		public $type = 'select';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				
					<select class="select_options">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
					</select>
					
					<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>"/>
			</label>
			<?php
		}
	}

	// Multiple check controll
	class industrie_Customize_Multicheck_Control extends WP_Customize_Control {
		public $type = 'multicheck';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
				<div class="multicheck_options">
					<?php foreach ( $this->choices as $value => $label ) : ?>
							<label>
								<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
								<?php echo esc_html( $label ); ?>
							</label>
					<?php endforeach; ?>
					<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
				</div>
			</label>
			<?php
		}
	}

	/**
	 * Section Separator
	 */
	class industrie_Separator_Control extends WP_Customize_Control{
		public $type = 'separator';
		public function render_content(){
			?>
			<p><hr></p>
			<?php
		}
	}

	/**
	 * Section heading controll
	 */
	class industrie_Heading_Control extends WP_Customize_Control{
		public function render_content(){
			?>
			<h2 class="customize-control-title"><?php echo esc_html( $this->label ); ?> </h2>
			<?php
		}
	}

	/***************************************************
	 * 
	 ***************************************************/
	if ( class_exists( 'WP_Customize_Panel' ) ) {

		class PE_WP_Customize_Panel extends WP_Customize_Panel {
	  
		  public $panel;

		  public $priority = 100;
	  
		  public $type = 'pe_panel';
	  
		  public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;
			$array['autoExpandSoleSection'] = $this->auto_expand_sole_section;
			return $array;
		  }
	  
		}
	  
	  }
	  
	  if ( class_exists( 'WP_Customize_Section' ) ) {
	  
		class PE_WP_Customize_Section extends WP_Customize_Section {
	  
		  public $section;
	  
		  public $type = 'pe_section';
	  
		  public function json() {
	  
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;
	  
			if ( $this->panel ) {
	  
			  $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	  
			} else {
	  
			  $array['customizeAction'] = 'Customizing';
	  
			}
	  
			return $array;
	  
		  }
	  
		}
	  
	  }

}
	//load js to control function of switch
	function industrie_inc_custom_admin_style($hook) {
		if ( 'customize.php' == $hook || 'widgets.php' == $hook ) {
			wp_enqueue_style( 'industrie-control-admin-css', get_template_directory_uri() . '/inc/customizer/css/customizer.css',array());
			wp_enqueue_script( 'industrie-control-admin-js', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'jquery' ), '20150611', true );
		}else{
			return;
		}
	}
	add_action( 'admin_enqueue_scripts', 'industrie_inc_custom_admin_style' );



// Enqueue our scripts and styles
function pe_customize_controls_scripts() {
	wp_enqueue_script( 'pe-customize-controls', get_theme_file_uri( '/inc/customizer/js/pe-customize-controls.js' ), array(), '1.0', true );
  }
  add_action( 'customize_controls_enqueue_scripts', 'pe_customize_controls_scripts' );
  
function pe_customize_controls_styles() {
	wp_enqueue_style( 'pe-customize-controls', get_theme_file_uri( '/inc/customizer/css/pe-customize-controls.css' ), array(), '1.0' );
  }
  add_action( 'customize_controls_print_styles', 'pe_customize_controls_styles' );
