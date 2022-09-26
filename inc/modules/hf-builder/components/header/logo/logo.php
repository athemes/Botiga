<?php
/**
 * Header/Footer Builder
 * Logo Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-logo" data-component-id="logo">
    <?php $this->customizer_edit_button(); ?>
    <div class="site-branding">
        <?php
        the_custom_logo();
        if ( is_front_page() || is_home() ) :
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
        else :
            ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
        endif;
        $botiga_description = get_bloginfo( 'description', 'display' );
        if ( $botiga_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $botiga_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
    </div><!-- .site-branding -->
</div>