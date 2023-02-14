<?php

// Create random menu for tests
$menuname = 'Menu For Tests';

// Does the menu exist already?
$menu_exists = wp_get_nav_menu_object( $menuname );

// If it doesn't exist, let's create it.
if( ! $menu_exists){
    $menu_id = wp_create_nav_menu( $menuname );

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Home'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url( '/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Activity'),
        'menu-item-classes' => 'activity',
        'menu-item-url' => home_url( '/activity/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Members'),
        'menu-item-classes' => 'members',
        'menu-item-url' => home_url( '/members/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Groups'),
        'menu-item-classes' => 'groups',
        'menu-item-url' => home_url( '/groups/' ), 
        'menu-item-status' => 'publish'));

    $dropdown_parent_id = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Forums'),
        'menu-item-classes' => 'forums',
        'menu-item-url' => home_url( '/forums/' ), 
        'menu-item-status' => 'publish'));
    
    for( $i=1; $i<=5; $i++ ) {
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' =>  __('Sub Menu Item ' . $i),
            'menu-item-classes' => 'sub-menu-item-' . $i,
            'menu-item-url' => home_url( '/sub-item-' . $i . '/' ), 
            'menu-item-parent-id' => $dropdown_parent_id,
            'menu-item-status' => 'publish') );
    }

    // Assign menu to the primary location
    set_theme_mod( 'nav_menu_locations', array( 
        'primary' => $menu_id, 
        'secondary' => $menu_id,
        'footer-copyright-menu' => $menu_id 
    ) );
}

// Header
// Set header builder components
set_theme_mod( 'botiga_header_row__mobile_offcanvas', '{"desktop":[],"mobile":[],"mobile_offcanvas":[["mobile_offcanvas_menu","social","contact_info","button","html","button2","html2","shortcode"]]}' );
set_theme_mod( 'botiga_header_row__above_header_row', '{"desktop":[["secondary_menu","social"],["contact_info","html"],["button2","html2"]],"mobile":[[],[],[]],"mobile_offcanvas":[["secondary_menu","social"],["contact_info","html"],["button2","html2"]]}' );
set_theme_mod( 'botiga_header_row__main_header_row', '{"desktop":[["menu"],["logo","button"],["search","woo_icons"]],"mobile":[["search"],["logo"],["mobile_hamburger"]]}' );
set_theme_mod( 'botiga_header_row__below_header_row', '{"desktop":[["shortcode"],[],[]],"mobile":[[],[],[]],"mobile_offcanvas":[[]]}' );

// Set header builder components contnet
set_theme_mod( 'social_profiles_topbar', 'https://facebook,https://twitter' );
set_theme_mod( 'header_html_content', 'HTML Content Example One' );
set_theme_mod( 'botiga_section_hb_component__html2_content', 'HTML Content Example Two' );
set_theme_mod( 'header_shortcode_content', 'shortcode content goes here' );

// Footer
// Set footer builder components
set_theme_mod( 'botiga_footer_row__main_footer_row', '{ "desktop": [["social", "copyright", "footer_menu", "button", "button2", "html", "html2", "widget1", "widget2", "widget3", "widget4", "shortcode"], [], []], "mobile": [[], [], []] }' );

// Set footer builder componenets content
set_theme_mod( 'social_profiles_footer', 'https://facebook,https://twitter' );
set_theme_mod( 'footer_html_content', 'HTML Content One For Tests' );
set_theme_mod( 'botiga_section_fb_component__html2_content', 'HTML Content Two For Tests' );
set_theme_mod( 'footer_shortcode_content', 'Shortcode content goes here' );
