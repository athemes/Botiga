<?php
/**
 * Header Builder.
 * Top Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains top header row data
 */

$row      = $args[ 'row' ];
$device   = $args[ 'device' ]; 
$row_data = $args[ 'row_data' ];

$component_args = array(
    'builder_type' => 'footer',
    'device'       => $device
);

if( $row_data === NULL ) {
    return;
}

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); 

// Get columns number
$cols_number = $bhfb->get_row_number_of_columns( $row_data->$device ); 

// General options
$container 	     = get_theme_mod( 'footer_container', 'container' ); 
$columns_layout  = Botiga_Header_Footer_Builder::get_columns_layout_class( get_theme_mod( "botiga_footer_row__{$row}_columns_layout_desktop", Botiga_Header_Footer_Builder::get_row_columns_layout_default_customizer_value( $row ) ) ); 
$row_empty_class = Botiga_Header_Footer_Builder::is_row_empty( $row_data->$device ) ? ' bhfb-is-row-empty' : ''; ?>

<div class="<?php echo esc_attr( $container ); ?>">
    <div class="bhfb-row bhfb-cols-<?php echo esc_attr( $cols_number ); echo ' ' .  esc_attr( $columns_layout ); echo esc_attr( $row_empty_class ); ?>">
        <?php 
        foreach( $row_data->$device as $col_id => $elements ) :

            // Get customizer column options.
            $column_option_id     = 'botiga_footer_row__'. $row .'_column' . ( $col_id + 1 );

            $vertical_alignment   = get_theme_mod( $column_option_id . '_vertical_alignment', 'middle' );
            $inner_layout         = get_theme_mod( $column_option_id . '_inner_layout', 'inline' );
            $horizontal_alignment = get_theme_mod( $column_option_id . '_horizontal_alignment', 'start' );
            
            // Column class.
            $column_classes = array( 'bhfb-column' );
            $column_classes[] = 'bhfb-column-' . esc_attr( $col_id + 1 );
            
            ?>

            <div class="<?php echo implode( ' ', $column_classes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
                
                <?php Botiga_Header_Footer_Builder::customizer_edit_column_button( 'footer', $row, $col_id + 1 ); ?>

                <?php foreach( $elements as $component_callback ) {
                    if( method_exists( $bhfb, $component_callback  ) ) {
                        call_user_func( array( $bhfb, $component_callback ), $component_args );
                    } else if( class_exists( 'Botiga_Pro_HF_Builder_Components' ) ) {
                        $bp_bphfbc = Botiga_Pro_HF_Builder_Components::get_instance();

                        if( method_exists( $bp_bphfbc, $component_callback  ) ) {
                            call_user_func( array( $bp_bphfbc, $component_callback ), $component_args );
                        }
                    }
                } ?>

            </div>

        <?php 
        endforeach; ?>
    </div>
</div>