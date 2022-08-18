<?php
/**
 * Footer Builder
 * Button 2 Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-button2" data-component-id="button2">
    <?php $this->customizer_edit_button();
    $text 	= get_theme_mod( 'bhfb_footer_button2_text', esc_html__( 'Click me', 'botiga-pro' ) );
    $url	= get_theme_mod( 'bhfb_footer_button2_link', '#' );
    $class  = get_theme_mod( 'bhfb_footer_button2_class', '' ); 
    $newtab = get_theme_mod( 'bhfb_footer_button2_newtab', 0 );

    $open	= '';
    if ( $newtab ) {
        $open = 'target="_blank"';
    } ?>
        <a <?php echo esc_html( $open ); ?> class="button<?php echo esc_attr( ( $class ? ' '. $class : '' ) ); ?>" href="<?php echo esc_url( $url ); ?>">
            <?php echo esc_html( $text ); ?>
        </a>
</div>