<?php

/**
 * Silent Upgrader Skin.
 * The main purpose of this class is to suppress the output of the upgrader.
 * 
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

if ( ! class_exists( 'Botiga_Silent_Upgrader_Skin' ) ) {
    class Botiga_Silent_Upgrader_Skin extends WP_Upgrader_Skin {
        public function header() {}
        public function footer() {}
        public function error( $errors ) {}
        public function feedback( $feedback, ...$args ) {}
    }
}
