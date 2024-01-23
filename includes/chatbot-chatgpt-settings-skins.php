<?php
/**
 * Chatbot Ultra for WordPress - Settings - Adaptive Skins
 *
 * This file contains the code for the Chatbot Ultra settings page.
 * It handles the adaptive skins settings and other parameters.
 * 
 *
 * @package chatbot-ultra
 */

// IDEA - COMING SOON - Ver 1.6.8

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

function chatbot_ultra_skins_enqueue_styles() {

    // DIAG - Diagnostics
    // chatbot_ultra_back_trace( 'NOTICE', );
    
    $primary_color = get_theme_mod('primary_color', '#000000'); // Default to black if not set

    $custom_css = "
        .parent-class chatbot-ultra {
            background-color: {$primary_color} !important;
        }
        .parent-class chatbot-ultra .chatbot-ultra-header {
            background-color: {$primary_color} !important;
        }";
    wp_add_inline_style('chatbot-ultra', $custom_css);

    // DIAG - Diagnostics
    // chatbot_ultra_back_trace( 'NOTICE', '$custom_css: ' . $custom_css);

}
add_action('wp_enqueue_scripts', 'chatbot_ultra_skins_enqueue_styles');
