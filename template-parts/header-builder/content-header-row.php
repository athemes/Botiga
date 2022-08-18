<?php
/**
 * Header Builder.
 * Above Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains above header row data
 */

$device   = $args[ 'device' ]; 
$row_data = $args[ 'row_data' ];

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance();

// Get columns number
$cols_number = $bhfb->get_row_number_of_columns( $row_data->$device ); 

// General options
$container = get_theme_mod( 'header_container', 'container-fluid' ); ?>

<div class="<?php echo esc_attr( $container ); ?>">
    <div class="bhfb-row bhfb-cols-<?php echo esc_attr( $cols_number ); ?>">
        <?php 
        // var_dump( $row_data->$device );
        foreach( $row_data->$device as $col_class => $elements ) :
            
            if( count( $elements ) > 0 ) : ?>

                <div class="bhfb-column bhfb-column-<?php echo esc_attr( $col_class + 1 ); ?>">
                    
                    <?php foreach( $elements as $component_callback ) {
                        if( method_exists( $bhfb, $component_callback  ) ) {
                            call_user_func( array( $bhfb, $component_callback ), array( 'header' ) );
                        } else if( function_exists( $component_callback ) ) {
                            call_user_func( $component_callback );
                        }
                    } ?>

                </div>

            <?php 
            endif; ?>

        <?php 
        endforeach; ?>
    </div>
</div>