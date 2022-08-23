<?php
/**
 * Header Builder.
 * Above Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains above header row data
 */

$row      = $args[ 'row' ];
$device   = $args[ 'device' ]; 
$row_data = $args[ 'row_data' ];

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); 

// Get columns number
$cols_number = $bhfb->get_row_number_of_columns( $row_data->$device ); 

// General options
$container 	        = get_theme_mod( 'footer_container', 'container' ); 
$vertical_alignment = get_theme_mod( 'botiga_footer_row__' . $row . '_vertical_alignment', 'top' );
$inner_layout       = get_theme_mod( 'botiga_footer_row__' . $row . '_inner_layout', 'stack' ); ?>

<div class="<?php echo esc_attr( $container ); ?>">
    <div class="bhfb-row bhfb-cols-<?php echo esc_attr( $cols_number ); ?> bhfb-cols-valign-<?php echo esc_attr( $vertical_alignment ); ?> bhfb-cols-inner-layout-<?php echo esc_attr( $inner_layout ); ?>">
        <?php 
        foreach( $row_data->$device as $col_class => $elements ) :
            
            if( count( $elements ) > 0 ) : ?>

                <div class="bhfb-column bhfb-column-<?php echo absint( $col_class + 1 ); ?>">
                    
                    <?php foreach( $elements as $component_callback ) {
                        if( method_exists( $bhfb, $component_callback  ) ) {
                            call_user_func( array( $bhfb, $component_callback ), array( 'footer' ) );
                        } else if( class_exists( 'Botiga_Pro_HF_Builder_Components' ) ) {
                            $bp_bphfbc = Botiga_Pro_HF_Builder_Components::get_instance();

                            if( method_exists( $bp_bphfbc, $component_callback  ) ) {
                                call_user_func( array( $bp_bphfbc, $component_callback ), array( 'footer' ) );
                            }
                        }
                    } ?>

                </div>

            <?php 
            endif; ?>

        <?php 
        endforeach; ?>
    </div>
</div>