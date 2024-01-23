<?php
/**
 * Chatbot Ultra for WordPress - Localize
 *
 * This file contains the code for the Chatbot Ultra settings page.
 * It localizes the settings and other parameters.
 * 
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
};

function chatbot_ultra_localize(){

    $defaults = array(
        'chatbot_ultra_bot_name' => 'Chatbot Ultra',
        'chatbot_ultra_bot_prompt' => 'Enter your question ...',
        'chatbot_ultra_initial_greeting' => 'Hello! How can I help you today?',
        'chatbot_ultra_subsequent_greeting' => 'Hello again! How can I help you?',
        'chatbot_ultra_start_status' => 'closed',
        'chatbot_ultra_start_status_new_visitor' => 'closed',
        'chatbot_ultra_disclaimer' => 'No',
        'chatbot_ultra_max_tokens' => '150',
        'chatbot_ultra_width' => 'Narrow',
        'chatbot_ultra_diagnostics' => 'Off',
        'chatbot_ultra_avatar_icon' => 'icon-001.png',
        'chatbot_ultra_avatar_icon_url' => '',
        'chatbot_ultra_custom_avatar_icon' => 'icon-001.png',
        'chatbot_ultra_avatar_greeting' => 'Howdy!!! Great to see you today! How can I help you?',
        'chatbot_ultra_model_choice' => 'gpt-3.5-turbo',
        'chatbot_ultra_max_tokens' => 150,
        'chatbot_ultra_conversation_context' => 'You are a versatile, friendly, and helpful assistant designed to support me in a variety of tasks.',
        'chatbot_ultra_enable_custom_buttons' => 'Off',
        'chatbot_ultra_custom_button_name_1' => '',
        'chatbot_ultra_custom_button_url_1' => '',
        'chatbot_ultra_custom_button_name_2' => '',
        'chatbot_ultra_custom_button_url_2' => '',
        'chatbot_ultra_allow_file_uploads' => 'No'
    );

    // Revised for Ver 1.5.0 
    $option_keys = array(
        'chatbot_ultra_bot_name',
        'chatbot_ultra_bot_prompt',
        'chatbot_ultra_initial_greeting',
        'chatbot_ultra_subsequent_greeting',
        'chatbot_ultra_start_status',
        'chatbot_ultra_start_status_new_visitor',
        'chatbot_ultra_disclaimer',
        'chatbot_ultra_max_tokens',
        'chatbot_ultra_width',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_avatar_icon',
        'chatbot_ultra_avatar_icon_url',
        'chatbot_ultra_custom_avatar_icon',
        'chatbot_ultra_avatar_greeting',
        'chatbot_ultra_enable_custom_buttons',
        'chatbot_ultra_custom_button_name_1',
        'chatbot_ultra_custom_button_url_1',
        'chatbot_ultra_custom_button_name_2',
        'chatbot_ultra_custom_button_url_2',
        'chatbot_ultra_allow_file_uploads'
    );

    $chatbot_settings = array();
    foreach ($option_keys as $key) {
        $default_value = isset($defaults[$key]) ? $defaults[$key] : '';
        $chatbot_settings[$key] = esc_attr(get_option($key, $default_value));
        // DIAG - Log key and value
        // chatbot_ultra_back_trace( 'NOTICE', 'Key: ' . $key . ', Value: ' . $chatbot_settings[$key]);
    }

    // Update localStorage - Ver 1.6.1
    echo "<script type=\"text/javascript\">
    document.addEventListener('DOMContentLoaded', (event) => {
        // Encode the chatbot settings array into JSON format for use in JavaScript
        let chatbotSettings = " . json_encode($chatbot_settings) . ";

        Object.keys(chatbotSettings).forEach((key) => {
            if(!localStorage.getItem(key)) {
                // DIAG - Log the key and value
                // console.log('Chatbot Ultra: NOTICE: Setting ' + key + ' in localStorage');
                localStorage.setItem(key, chatbotSettings[key]);
            } else {
                // DIAG - Log the key and value
                // console.log('Chatbot Ultra: NOTICE: ' + key + ' is already set in localStorage');
            }
        });
    });
    </script>";

}
