<?php
class Botiga_Typography_Adobe_Kits_Control extends WP_Customize_Control {
    /**
     * The type of control being rendered
     */
    public $type = 'botiga-adobe_fonts_kits';

    public $kits = array();
    
    /**
     * Get our list of fonts from the json file
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
        
        $this->kits = get_option( 'botiga_adobe_fonts_kits' );
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
        
        <div style="margin-bottom: 25px;">
            <label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title"><?php echo esc_html__( 'API Token', 'botiga' ); ?></label>
            <input id="<?php echo esc_attr( $this->id ); ?>" type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />

            <span class="customize-control-description" style="margin-top: 10px; margin-bottom: 10px;">
                <?php echo esc_html__( 'You can get your Adobe Fonts API Token here: ', 'botiga' ) . '<a href="https://fonts.adobe.com/account/tokens" target="_blank">https://fonts.adobe.com/account/tokens</a>'; ?>
            </span>

            <a href="#" class="button button-primary botiga-adobe_fonts_kits_submit_token" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'botiga' ); ?>" data-default-text="<?php echo esc_attr__( 'Get Fonts', 'botiga' ); ?>"><?php echo esc_html__( 'Get Fonts', 'botiga' ); ?></a>
        </div>
        
        <div class="botiga-adobe_fonts_kits_ajax_wrapper">
            <?php botiga_customize_control_adobe_font_kits_output( $this->kits ); ?>
        </div>

        <?php 
    }
}