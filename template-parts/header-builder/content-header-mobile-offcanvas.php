<?php
/**
 * Header Builder.
 * Header Mobile Offcanvas Template File.
 * 
 * @package Botiga
 * @var array $args Contains mobile offcanvas data
 */

$elements = $args[ 'elements' ];

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); ?>

<div class="container">
    <div class="bhfb-row bhfb-cols-1">
        <?php 
        foreach( $elements as $col_class => $column ) :
            
            if( count( $column->elements ) > 0 ) : ?>

                <div class="bhfb-column bhfb-<?php echo esc_attr( $col_class ); ?>">
                    
                    <?php foreach( $column->elements as $element ) {
                        call_user_func( array( $bhfb, $element ) );
                    } ?>

                </div>

            <?php 
            endif; ?>

        <?php 
        endforeach; ?>
    </div>
</div>