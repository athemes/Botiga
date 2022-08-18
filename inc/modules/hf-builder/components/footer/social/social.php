<?php
/**
 * Footer Builder
 * Social Component
 * 
 * @package Botiga_Pro
 */

echo '<div class="bhfb-builder-item bhfb-component-social" data-component-id="social">';
    $this->customizer_edit_button();
    botiga_social_profile( 'social_profiles_footer' );
echo '</div>';