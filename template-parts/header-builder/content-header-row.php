<?php
/**
 * Header Builder.
 * Above Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains above header row data
 */

$device   = $args[ 'device' ]; 
$row      = $args[ 'row' ];
$row_data = $args[ 'row_data' ];

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance();

// Get columns number
$cols_number = $bhfb->get_row_number_of_columns( $row_data->$device ); 

// General options
$container      = get_theme_mod( 'header_container', 'container-fluid' ); 
$columns_layout = Botiga_Header_Footer_Builder::get_columns_layout_class( get_theme_mod( "botiga_header_row__${row}_columns_layout", '3col-equal' ) ); ?>

<div class="<?php echo esc_attr( $container ); ?>">
    <div class="bhfb-row bhfb-cols-<?php echo esc_attr( $cols_number ); ?> bhfb-cols-layout-<?php echo esc_attr( $columns_layout ); ?>">
        <?php 
        foreach( $row_data->$device as $col_class => $elements ) : ?>
            
            <div class="bhfb-column bhfb-column-<?php echo esc_attr( $col_class + 1 ); ?>">
                
                <?php foreach( $elements as $component_callback ) {
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
        endforeach; ?>
    </div>
</div>