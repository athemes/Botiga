<?php
/**
 * Header/Footer Builder
 * Polylang Language Switcher Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-pll_switcher" data-component-id="pll_switcher">
    <?php $this->customizer_edit_button();

    if ( ! function_exists( 'pll_the_languages' ) ) {
        return;
    }

    $dropdown 		= get_theme_mod( 'botiga_section_hb_component__pll_switcher_dropdown', 0 );
    $show_names 	= get_theme_mod( 'botiga_section_hb_component__pll_switcher_show_names', 0 );
    $show_flags 	= get_theme_mod( 'botiga_section_hb_component__pll_switcher_show_flags', 1 );
    $hide_current 	= get_theme_mod( 'botiga_section_hb_component__pll_switcher_hide_current', 0 );
    
    $args = array(
        'dropdown' 		=> $dropdown,
        'show_names' 	=> $show_names,
        'show_flags'	=> $show_flags,
        'hide_current' 	=> $hide_current,
    ); ?> 

    <ul class="botiga-pll-switcher">
        <?php pll_the_languages( $args ); ?>
    </ul>
</div>