<?php
/**
 * Header Builder.
 * Above Header Row Template File.
 * 
 * @package Botiga
 * @var array $args Contains above header row data
 */

$elements = $args[ 'elements' ]; 

// Get instance from bhfb class
$bhfb = Botiga_Header_Footer_Builder::get_instance(); ?>

<div class="container">
    <div class="row valign bt-d-flex justify-content-between">
        <?php foreach( $elements as $column ) : ?>
        
            <?php if( count( $column->elements ) > 0 ) : ?>
                <div class="col-auto bt-d-flex align-items-center">
                    
                    <?php foreach( $column->elements as $element ) {
                        call_user_func( array( $bhfb, $element ) );
                    } ?>

                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>
</div>