<?php
/**
 * Header/Footer Builder
 * Login/Register Component
 * 
 * @package Botiga_Pro
 */
echo '<div class="bhfb-builder-item bhfb-component-login_register" data-component-id="login_register">';
    $this->customizer_edit_button();
    $output = '';

    if( is_user_logged_in() ) {
        $show_welcome_message = get_theme_mod( 'login_register_show_welcome_message', 1 );
        if( ! $show_welcome_message ) {
            return;
        }

        $current_user = wp_get_current_user();

        /* translators: 1: display name. */
        $welcome_message_text = get_theme_mod( 'login_register_welcome_message_text', sprintf( esc_html__( 'Welcome %s', 'botiga-pro' ), '{display_name}' ) );
        $welcome_message_text = str_replace(
            array( '{user_firstname}', '{user_lastname}', '{user_email}', '{user_login}', '{display_name}' ),
            array($current_user->user_firstname, $current_user->user_lastname, $current_user->user_email, $current_user->user_login, $current_user->display_name ),
            $welcome_message_text
        );
        
        $output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'" title="'. esc_attr__( 'My account', 'botiga-pro' ) .'">' . esc_html( $welcome_message_text ) . '</a>'; 
        $output .= '<nav>';
            $output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'" title="'. esc_attr__( 'My account dashboard', 'botiga-pro' ) .'">'. esc_html__( 'Dashboard', 'botiga-pro' ) .'</a>';
            $output .= '<a href="'. esc_url( wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' ) ) ) .'" title="'. esc_attr__( 'Orders', 'botiga-pro' ) .'">'. esc_html__( 'Orders', 'botiga-pro' ) .'</a>';
            $output .= '<a href="'. esc_url( wc_get_endpoint_url( 'downloads', '', wc_get_page_permalink( 'myaccount' ) ) ) .'" title="'. esc_attr__( 'Downloads', 'botiga-pro' ) .'">'. esc_html__( 'Downloads', 'botiga-pro' ) .'</a>';
            $output .= '<a href="'. esc_url( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) ) ) .'" title="'. esc_attr__( 'Addresses', 'botiga-pro' ) .'">'. esc_html__( 'Addresses', 'botiga-pro' ) .'</a>';
            $output .= '<a href="'. esc_url( wc_get_endpoint_url( 'edit-account', '', wc_get_page_permalink( 'myaccount' ) ) ) .'" title="'. esc_attr__( 'Account details', 'botiga-pro' ) .'">'. esc_html__( 'Account Details', 'botiga-pro' ) .'</a>';
            $output .= '<a href="'. esc_url( wc_logout_url() ) .'" title="'. esc_attr__( 'Logout', 'botiga-pro' ) .'">'. esc_html__( 'Logout', 'botiga-pro' ) .'</a>';
        $output .= '</nav>';
    } else {
        $login_register_link_text = get_theme_mod( 'login_register_link_text', esc_html__( 'Login', 'botiga-pro' ) );
        $login_register_popup     = get_theme_mod( 'login_register_popup', 0 );

        $link_classes = array( 'botiga-login-register-link' );
        
        if( $login_register_popup ) {
            $link_classes[] = 'has-popup';
        }

        $output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'" title="'. esc_attr__( 'Login or register', 'botiga-pro' ) .'" data-popup-id="loginRegisterPopup" class="'. esc_attr( implode( ' ', $link_classes ) ) .'">'. esc_html( $login_register_link_text ) .'</a>';
    }

    echo '<div class="header-item header-login-register">';
        echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
    echo '</div>';
echo '</div>';