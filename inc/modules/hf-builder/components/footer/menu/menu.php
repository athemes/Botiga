<?php
/**
 * Header/Footer Builder
 * Secondary Menu Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-footer_menu" data-component-id="footer_menu">
    <?php $this->customizer_edit_button();

    if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'secondary' ) ) : ?>
        <nav class="botiga-footer-copyright-navigation" aria-label="<?php echo esc_attr__( 'Footer navigation menu', 'botiga-pro' ); ?>">
            <?php wp_nav_menu( array( 'theme_location' => 'footer-copyright-menu') ); ?>
        </nav>
    <?php else: ?>			
    <nav class="botiga-footer-copyright-navigation" aria-label="<?php echo esc_attr__( 'Footer navigation menu', 'botiga-pro' ); ?>">
        <?php
        wp_nav_menu( array(
            'theme_location'=> 'footer-copyright-menu',
            'menu_id'       => 'footer-copyright-menu',
            'fallback_cb'	=> false,
            'depth'			=> 0,
            'walker'        => apply_filters( 'botiga_footer_copyright_wp_nav_menu_walker', '' )
        ) );
        ?>
    </nav>
    <?php endif; ?>
</div>