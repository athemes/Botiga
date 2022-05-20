<?php
/**
 * Header Builder.
 * Above Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains above header row data
 */

$device   = $args[ 'device' ]; 
$elements = $args[ 'elements' ];

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); 

$cols_number = botiga_bhfb_get_number_of_columns( $elements->$device ); ?>

<div class="container">
    <div class="bhfb-row bhfb-cols-<?php echo esc_attr( $cols_number ); ?>">
        <?php 
        foreach( $elements->$device as $col_class => $column ) :
            
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