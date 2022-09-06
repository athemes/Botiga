<?php
/**
 * Header/Footer Builder
 * Search Component
 * 
 * @package Botiga_Pro
 */

echo '<div class="bhfb-builder-item bhfb-component-search" data-component-id="search">'; 
    $this->customizer_edit_button(); ?>
    <a href="#" class="header-search" title="<?php echo esc_attr__( 'Search for a product', 'botiga' ); ?>">
        <?php botiga_get_header_search_icon( true ); ?>
    </a>
<?php
echo '</div>';