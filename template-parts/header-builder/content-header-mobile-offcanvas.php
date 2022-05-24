<?php
/**
 * Header Builder.
 * Header Mobile Offcanvas Template File.
 * 
 * @package Botiga
 * @var array $args Contains mobile offcanvas data
 */

$row_data   = $args[ 'row_data' ];
$components = $row_data->mobile->col_left;

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); ?>

<div class="container">
    <div class="bhfb-row bhfb-cols-1">
        <?php 
        if( count( $components->elements ) > 0 ) : ?>

            <div class="bhfb-column bhfb-mobile-offcanvas-col">
                <?php foreach( $components->elements as $component_callback ) {
                    call_user_func( array( $bhfb, $component_callback ) );
                } ?>

            </div>

        <?php 
        endif; ?>
    </div>
</div>