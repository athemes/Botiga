<?php
class Botiga_Typography_Adobe_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'botiga-adobe_fonts';

        public $kits = '';

        public $families = '';
		
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			
            $kits = get_option( 'botiga_adobe_fonts_kits' );
            $kits[ 'system_default' ] = array(
                'enable' => 1,
                'project_name' => 'System Default',
                'families' => array(
                    array(
                        'name' => 'System Default',
                        'css_name' => array( 'system-default' ),
                        'css_stack' => '"system-default", sans-serif',
                        'variations' => array( 'n4', 'n5', 'n8' )
                    )
                )
            );

            $this->kits = $kits;

            $families = array();
            foreach( $this->kits as $kit_id => $project ) { 
                foreach( $project[ 'families' ] as $family ) {
                    array_push( $families, $family );
                }
            }

            $this->families = $families;
		}

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_style( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), '4.0.13', 'all' );

            wp_localize_script( 'botiga-select2', 'botiga_adobe_fonts', $this->families );
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

            <?php 
            $family_val = 'System Default'; 
            $weight_val = '400';
            if( $this->value() ) {
                $values = explode( '|', $this->value() );
                $family_val = $values[0];
                $weight_val = $values[1];
            } ?>

            <div class="adobe_fonts_select_control">
                <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-adobe-font-selection" <?php $this->link(); ?> />
                <div class="adobe-fonts">
                    <div class="font-control-title">
                        <strong><?php esc_html_e( 'Font family', 'botiga' ) ?></strong>
                    </div>
                    <select class="adobe-font-family" control-name="<?php echo esc_attr( $this->id ); ?>">

                        <?php 
                        foreach( $this->kits as $kit_id => $project ) : 

                            if( ! $project[ 'enable' ] ) {
                                continue;
                            }

                            foreach( $project[ 'families' ] as $family ) : ?>
                                <option value="<?php echo esc_attr( $family[ 'css_name' ][0] ); ?>"<?php selected( $family[ 'css_name' ][0], $family_val, true ); ?>><?php echo esc_html( $family[ 'name' ] ); ?></option>
                            <?php 
                            endforeach;
                        endforeach; ?>

                    </select>

                    <div class="font-control-title w50">
                        <strong><?php esc_html_e( 'Font weight', 'botiga' ) ?></strong>
                    </div>
                    <select class="adobe-font-weight w50">
                        <option value="<?php echo esc_attr( $weight_val ); ?>"><?php echo esc_html( $weight_val ); ?></option>
                    </select>
                </div>
            </div>
            
            <?php
		}

        /**
         * Standardize font variations (font-weight)
         * 
         */
        public function standardize_font_variations( $variation ) {
            $variations = array();

            // normal format
            for( $i=1;$i<=9;$i++ ) {
                $variations[ "n${i}" ] = $i * 100 ;
            }

            if ( array_key_exists( $variation, $variations ) ) {
                return $variations[ $variation ];
            } else {
                return '400';
            }
        }
	}