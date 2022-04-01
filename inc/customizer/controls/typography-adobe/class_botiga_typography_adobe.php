<?php
class Botiga_Typography_Adobe_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'botiga-adobe_fonts';
		
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			

		}

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_style( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), '4.0.13', 'all' );
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() { ?>

            <?php if( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>	
            <?php if( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>							
            <div class="adobe_fonts_select_control">
                <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="default_value" class="customize-control-adobe-font-selection" <?php // $this->link( 'family' ); ?> />
                <div class="adobe-fonts">
                    <div class="font-control-title"><strong><?php esc_html_e( 'Font family', 'botiga' ) ?></strong></div>

                    <select class="adobe-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
                        <option value="test">Test</option>
                    </select>
                </div>

                <div class="range-slider-wrapper cols2-control">
                    <div class="font-control-title w50"><strong><?php esc_html_e( 'Font weight', 'botiga' ) ?></strong></div>
                    <select class="adobe-fonts-regularweight-style w50">
                        <option value="500">500</option>
                    </select>
                </div>				

                <input type="hidden" class="adobe-fonts-category" value="">
            </div>
            
            <?php
		}
	}