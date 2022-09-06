<?php
/**
 * Header/Footer Builder
 * Search Form
 * 
 * @package Botiga_Pro
 */ ?>

<div class="header-search-form">
<?php
    if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
        echo do_shortcode('[wcas-search-form]');
    } else {
        get_search_form();
    }
?>
</div>