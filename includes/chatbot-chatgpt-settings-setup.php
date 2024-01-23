<?php
/**
 * Chatbot Ultra for WordPress - Settings - Setup Page
 *
 * This file contains the code for the Chatbot Ultra settings page.
 * It handles the setup settings and other parameters.
 * 
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Settings section callback - Ver 1.3.0
function chatbot_ultra_settings_section_callback($args) {
    ?>
    <p>Configure settings for the Chatbot Ultra plugin, including the bot name, start status, and greetings.</p>
    <?php
}

// Chatbot Ultra Name
function chatbot_ultra_bot_name_callback($args) {
    $chatbot_ultra_bot_name = esc_attr(get_option('chatbot_ultra_bot_name', 'Chatbot Ultra'));
    ?>
    <input type="text" id="chatbot_ultra_bot_name" name="chatbot_ultra_bot_name" value="<?php echo esc_attr( $chatbot_ultra_bot_name ); ?>" class="regular-text">
    <?php
}

function chatbot_ultra_start_status_callback($args) {
    $chatbot_ultra_start_status = esc_attr(get_option('chatbot_ultra_start_status', 'closed'));
    ?>
    <select id="chatbot_ultra_start_status" name="chatbot_ultra_start_status">
        <option value="open" <?php selected( $chatbot_ultra_start_status, 'open' ); ?>><?php echo esc_html( 'Open' ); ?></option>
        <option value="closed" <?php selected( $chatbot_ultra_start_status, 'closed' ); ?>><?php echo esc_html( 'Closed' ); ?></option>
    </select>
    <?php
}

function chatbot_ultra_start_status_new_visitor_callback($args) {
    $chatbot_ultra_start_status = esc_attr(get_option('chatbot_ultra_start_status_new_visitor', 'closed'));
    ?>
    <select id="chatbot_ultra_start_status_new_visitor" name="chatbot_ultra_start_status_new_visitor">
        <option value="open" <?php selected( $chatbot_ultra_start_status, 'open' ); ?>><?php echo esc_html( 'Open' ); ?></option>
        <option value="closed" <?php selected( $chatbot_ultra_start_status, 'closed' ); ?>><?php echo esc_html( 'Closed' ); ?></option>
    </select>
    <?php
}

// Added in Ver 1.6.6
function chatbot_ultra_bot_prompt_callback($args) {
    $chatbot_ultra_bot_prompt = esc_attr(get_option('chatbot_ultra_bot_prompt', 'Enter your question ...'));
    ?>
    <input type="text" id="chatbot_ultra_bot_prompt" name="chatbot_ultra_bot_prompt" value="<?php echo esc_attr( $chatbot_ultra_bot_prompt ); ?>" class="regular-text">
    <?php
}

function chatbot_ultra_initial_greeting_callback($args) {
    $chatbot_ultra_initial_greeting = esc_attr(get_option('chatbot_ultra_initial_greeting', 'Hello! How can I help you today?'));
    ?>
    <textarea id="chatbot_ultra_initial_greeting" name="chatbot_ultra_initial_greeting" rows="2" cols="50"><?php echo esc_textarea( $chatbot_ultra_initial_greeting ); ?></textarea>
    <?php
}

function chatbot_ultra_subsequent_greeting_callback($args) {
    $chatbot_ultra_subsequent_greeting = esc_attr(get_option('chatbot_ultra_subsequent_greeting', 'Hello again! How can I help you?'));
    ?>
    <textarea id="chatbot_ultra_subsequent_greeting" name="chatbot_ultra_subsequent_greeting" rows="2" cols="50"><?php echo esc_textarea( $chatbot_ultra_subsequent_greeting ); ?></textarea>
    <?php
}

// Option to remove OpenAI disclaimer - Ver 1.4.1
function chatbot_ultra_disclaimer_callback($args) {
    $chatbot_ultra_disclaimer = esc_attr(get_option('chatbot_ultra_disclaimer', 'Yes'));
    ?>
    <select id="chatbot_ultra_disclaimer" name="chatbot_ultra_disclaimer">
        <option value="Yes" <?php selected( $chatbot_ultra_disclaimer, 'Yes' ); ?>><?php echo esc_html( 'Yes' ); ?></option>
        <option value="No" <?php selected( $chatbot_ultra_disclaimer, 'No' ); ?>><?php echo esc_html( 'No' ); ?></option>
    </select>
    <?php    
}

// Option for narrow or wide chatbot - Ver 1.4.2
function chatbot_ultra_width_callback($args) {
    $chatgpt_width = esc_attr(get_option('chatbot_ultra_width', 'Narrow'));
    ?>
    <select id="chatbot_ultra_width" name = "chatbot_ultra_width">
        <option value="Narrow" <?php selected( $chatgpt_width, 'Narrow' ); ?>><?php echo esc_html( 'Narrow' ); ?></option>
        <option value="Wide" <?php selected( $chatgpt_width, 'Wide' ); ?>><?php echo esc_html( 'Wide' ); ?></option>
    </select>
    <?php
}

