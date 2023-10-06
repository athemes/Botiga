<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

echo '<div class="bhfb-builder-item bhfb-component-mobile_offcanvas_menu" data-component-id="mobile_offcanvas_menu">'; 
    $this->customizer_edit_button();
    $location = 'primary';
    if( has_nav_menu( 'mobile' ) ) {
        $location = 'mobile';
    }

    echo '<div class="mobile-offcanvas-menu-content">';
    
        do_action( 'botiga_before_header_builder_mobile_offcanvas_menu_output' ); 
        
        $main_site_nav_mobile_classes = apply_filters( 'botiga_site_navigation_mobile_class', array( 'botiga-dropdown', 'main-navigation' ) );

        ?>

        <nav id="site-navigation-mobile" class="<?php echo esc_attr( implode( ' ', $main_site_nav_mobile_classes ) ); ?>" <?php botiga_schema( 'nav' ); ?>>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => has_nav_menu( $location ) ? $location : '',
                    'menu_id'        => "$location-menu",
                    'menu_class'     => 'botiga-dropdown-ul menu',
                    'walker'         => apply_filters( 'botiga_mobile_primary_wp_nav_menu_walker', '' )
                )
            );
            ?>
        </nav><!-- #site-navigation -->

        <?php do_action( 'botiga_after_header_builder_mobile_offcanvas_menu_output' ); 
    echo '</div>';
    ?>
<?php
echo '</div>';

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound