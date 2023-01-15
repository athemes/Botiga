<?php
/**
 * Header/Footer Builder
 * Secondary Menu Component
 * 
 * @package Botiga_Pro
 */

// Check display conditions.
if ( ! botiga_get_display_conditions( 'secondary_menu_display_conditions', false, '[{"type":"include","condition":"all","id":null}]' ) ) {
    return;
}

?>

<div class="bhfb-builder-item bhfb-component-secondary_menu" data-component-id="secondary_menu">
    <?php $this->customizer_edit_button();

    if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'secondary' ) ) : ?>
        <nav class="secondary-navigation" aria-label="<?php echo esc_attr__( 'Secondary Navigation Menu', 'botiga' ); ?>">
            <?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
        </nav>
    <?php else: ?>				
    <nav class="top-bar-secondary-navigation secondary-navigation botiga-dropdown bhfb-navigation" aria-label="<?php echo esc_attr__( 'Secondary Navigation Menu', 'botiga' ); ?>">
        <?php
        wp_nav_menu( array(
            'theme_location'=> 'secondary',
            'menu_id'       => 'secondary',
            'fallback_cb'	=> false,
            'depth'			=> 0,
            'walker'        => apply_filters( 'botiga_secondary_wp_nav_menu_walker', '' )
        ) );
        ?>
    </nav>
    <?php endif; ?>
</div>