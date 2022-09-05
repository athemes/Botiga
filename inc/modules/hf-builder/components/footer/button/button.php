<?php
/**
 * Footer Builder
 * Button 1 Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-button" data-component-id="button">
    <?php $this->customizer_edit_button();
    $text 	= get_theme_mod( 'bhfb_footer_button1_text', esc_html__( 'Click me', 'botiga-pro' ) );
    $url	= get_theme_mod( 'bhfb_footer_button1_link', '#' );
    $class  = get_theme_mod( 'bhfb_footer_button1_class', '' ); 
    $newtab = get_theme_mod( 'bhfb_footer_button1_newtab', 0 );

    $open	= '';
    if ( $newtab ) {
        $open = 'target="_blank"';
    } ?>
        <a <?php echo esc_html( $open ); ?> class="button<?php echo esc_attr( ( $class ? ' '. $class : '' ) ); ?>" href="<?php echo esc_url( $url ); ?>">
            <?php echo esc_html( $text ); ?>
        </a>
</div>