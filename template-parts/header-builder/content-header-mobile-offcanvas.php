<?php
/**
 * Header Builder.
 * Header Mobile Offcanvas Template File.
 * 
 * @package Botiga
 * @var array $args Contains mobile offcanvas data
 */

$row_data   = $args[ 'row_data' ];

if( $row_data === NULL ) {
    return;
}

$elements = $row_data->mobile_offcanvas;

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); ?>

<div class="container">
    <div class="bhfb-row bhfb-cols-1">
        <?php 
        if( is_array( $elements[0] ) && count( $elements[0] ) > 0 ) : ?>

            <div class="bhfb-column bhfb-mobile-offcanvas-col">
                <?php foreach( $elements[0] as $component_callback ) {
                    if( method_exists( $bhfb, $component_callback  ) ) {
                        call_user_func( array( $bhfb, $component_callback ), array( 'header' ) );
                    } else if( class_exists( 'Botiga_Pro_HF_Builder_Components' ) ) {
                        $bp_bphfbc = Botiga_Pro_HF_Builder_Components::get_instance();

                        if( method_exists( $bp_bphfbc, $component_callback  ) ) {
                            call_user_func( array( $bp_bphfbc, $component_callback ), array( 'header' ) );
                        }
                    }
                } ?>

            </div>

        <?php 
        endif; ?>
    </div>
</div>