<?php
class Botiga_Typography_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'botiga-google_fonts';
		/**
		 * The list of Google Fonts
		 */
		private $fontList = false;
		/**
		 * The saved font values decoded from json
		 */
		private $fontValues = [];
		/**
		 * The index of the saved font within the list of Google fonts
		 */
		private $fontListIndex = 0;
		/**
		 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
		 */
		private $fontCount = 'all';
		/**
		 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
		 */
		private $fontOrderBy = 'alpha';
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get the font sort order
			if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
				$this->fontOrderBy = 'popular';
			}
			// Get the list of Google fonts
			if ( isset( $this->input_attrs['font_count'] ) ) {
				if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
					$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
				}
			}
			$this->fontList = $this->get_google_fonts( 'all' );
			// Decode the default json font value
			$this->fontValues = json_decode( $this->value( 'family' ) );
			// Find the index of our default font within our list of Google fonts
			$this->fontListIndex = $this->get_font_index( $this->fontList, $this->fontValues->font );
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_style( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), '4.0.13', 'all' );
		}
		/**
		 * Export our List of Google Fonts to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['botigafontslist'] = $this->fontList;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$fontCounter = 0;
			$isFontInList = false;
			$fontListStr = '';

			if( !empty($this->fontList) && $this->fontList !== 'error' ) {
				?>
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>	
				<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>							
				<div class="google_fonts_select_control popover-block">
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value( 'family' ) ); ?>" class="customize-control-google-font-selection" <?php $this->link( 'family' ); ?> />
					<div class="google-fonts">
						<div class="font-control-title"><strong><?php esc_html_e( 'Font family', 'botiga' ) ?></strong></div>

						<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
							<?php
								foreach( $this->fontList as $key => $value ) {
									$fontCounter++;
									$fontListStr .= '<option value="' . $value->family . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . $value->family . '</option>';
									if ( $this->fontValues->font === $value->family ) {
										$isFontInList = true;
									}
									if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
										break;
									}
								}
								if ( !$isFontInList && $this->fontListIndex ) {
									// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
									$fontListStr = '<option value="' . $this->fontList[$this->fontListIndex]->family . '" ' . selected( $this->fontValues->font, $this->fontList[$this->fontListIndex]->family, false ) . '>' . $this->fontList[$this->fontListIndex]->family . ' (default)</option>' . $fontListStr;
								}
								// Display our list of font options
								echo $fontListStr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</select>
					</div>

					<div class="range-slider-wrapper cols2-control">
					<div class="font-control-title w50"><strong><?php esc_html_e( 'Font weight', 'botiga' ) ?></strong></div>
					<?php if ( $this->input_attrs['disableRegular'] == false ) : ?>
						<select class="google-fonts-regularweight-style w50">
							<?php
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
								}
							?>
						</select>
					<?php endif; ?>
					</div>				

					<input type="hidden" class="google-fonts-category" value="<?php echo esc_html( $this->fontValues->category ); ?>">
				</div>
				<?php
			} else if( $this->fontList === 'error' ) {
                echo wp_kses_post( 
                    sprintf(
                        /* translators: 1: How to use adobe fonts docs link */
                        __( '<p class="botiga-customize-error">Something went wrong and the Google Fonts couldn\'t be loaded. Please contact our support <a href="%s" target="_blank">here</a> to get help.', 'botiga' ),
                        'https://athemes.com/support/'
                    )
                );
			}
		}

		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function get_font_index( $haystack, $needle ) {
			if( 'error' === $haystack ) {
				return false;
			}

			foreach( $haystack as $key => $value ) {
				if( $value->family == $needle ) {
					return $key;
				}
			}

			return false;
		}

		/**
		 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
		 */
		public function get_google_fonts( $count = 30 ) {
			$fontFile = get_template_directory_uri() . '/inc/customizer/controls/typography/google-fonts-alphabetical.json';

			$request = wp_remote_get( $fontFile );
			$status  = wp_remote_retrieve_response_code( $request );

			if( is_wp_error( $request ) || $status !== 200 ) {
				return "error";
			}

			$body = wp_remote_retrieve_body( $request );
			$content = json_decode( $body );

			return $content->items;

		}
	}