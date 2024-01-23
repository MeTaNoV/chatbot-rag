<?php
/*
 * Plugin Name: Chatbot Ulra
 * Plugin URI:  https://github.com/MeTaNoV/chatbot-ultra
 * Description: A simple plugin to add a Chatbot Ulra to your Wordpress Website.
 * Version:     0.0.1
 * Author:      Pascal Gula
 * Author URI:  https://github.com/MeTaNoV/
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *  
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Chatbot Ulra. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 * 
*/

// If this file is called directly, die.
defined( 'WPINC' ) || die;

// If this file is called directly, die.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Declare Globals here - Ver 1.6.3
global $wpdb; // Declare the global $wpdb object

// Uniquely Identify the Visitor - Ver 1.7.4
global $sessionId; // Declare the global $sessionID variable

if ($sessionId == '') {
    session_start();
    $sessionId = session_id();
    session_write_close();
    // error_log('Session ID: ' . $sessionId);
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-globals.php'; // Globals - Ver 1.6.5

// Include necessary files - chat provider API and GPT Assistant API - Ver 1.6.9
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-call-gpt-api.php'; // ChatGPT API - Ver 1.6.9
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-call-gpt-assistant.php'; // Custom GPT Assistants - Ver 1.6.9
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-quivr-call-api.php'; // Custom Quivr API - Ver 1.6.9

// Include necessary files - Knowledge Navigator
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-acquire.php'; // Knowledge Navigator Acquistion - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-acquire-words.php'; // Knowledge Navigator Acquistion - Ver 1.6.5
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-acquire-word-pairs.php'; // Knowledge Navigator Acquistion - Ver 1.6.5
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-analysis.php'; // Knowlege Navigator Analysis- Ver 1.6.2
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-db.php'; // Knowledge Navigator - Database Management - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-enhance-response.php'; // Knowledge Navigator - TD-IDF Response Enhancement - Ver 1.6.9
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-scheduler.php'; // Knowledge Navigator - Scheduler - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-kn-settings.php'; // Knowlege Navigator - Settings - Ver 1.6.1

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-db-management.php'; // Database Management for Reporting - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-file-upload.php'; // Functions - Ver 1.7.6
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-api-model.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-api-test.php'; // Refactoring Settings - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-avatar.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-buttons.php'; // Refactoring Settings - Ver 1.6.5
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-custom-gpts.php'; // Refactoring Settings - Ver 1.7.2
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-quivr.php';
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-diagnostics.php'; // Refactoring Settings - Ver 1.6.5
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-links.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-localization.php'; // Refactoring Settings - Ver 1.7.2.1
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-localize.php'; // Fixing localStorage - Ver 1.6.1
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-notices.php'; // Notices - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-premium.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-registration.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-reporting.php'; // Reporting - Ver 1.6.3
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-setup.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-skins.php'; // Adpative Skins - Ver 1.6.7
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-settings-support.php'; // Refactoring Settings - Ver 1.5.0
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-threads.php'; // Ver 1.7.2.1
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-transients.php'; // Ver 1.7.2
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-ultra-upgrade.php'; // Ver 1.6.7

add_action('init', 'my_custom_buffer_start');
function my_custom_buffer_start() {
    ob_start();
}

// Check for Upgrades - Ver 1.7.7
if (!esc_attr(get_option('chatbot_ultra_upgraded'))) {
    chatbot_ultra_upgrade();
    update_option('chatbot_ultra_upgraded', 'Yes');
}

// Diagnotics on/off setting can be found on the Settings tab - Ver 1.5.0
global $chatbot_ultra_diagnostics;
$chatbot_ultra_diagnostics = esc_attr(get_option('chatbot_ultra_diagnostics', 'Off'));

// Custom buttons on/off setting can be found on the Settings tab - Ver 1.6.5
global $chatbot_ultra_enable_custom_buttons;
$chatbot_ultra_enable_custom_buttons = esc_attr(get_option('chatbot_ultra_enable_custom_buttons', 'Off'));

// Allow file uploads on/off setting can be found on the Settings tab - Ver 1.7.6
global $chatbot_ultra_allow_file_uploads;
$chatbot_ultra_allow_file_uploads = esc_attr(get_option('chatbot_ultra_allow_file_uploads', 'No'));

// Suppress Notices on/off setting can be found on the Settings tab - Ver 1.6.5
global $chatbot_ultra_suppress_notices;
$chatbot_ultra_suppress_notices = esc_attr(get_option('chatbot_ultra_suppress_notices', 'Off'));

// Suppress Attribution on/off setting can be found on the Settings tab - Ver 1.6.5
global $chatbot_ultra_suppress_attribution;
$chatbot_ultra_suppress_attribution = esc_attr(get_option('chatbot_ultra_suppress_attribution', 'Off'));

// Suppress Learnings Message - Ver 1.7.1
global $chatbot_ultra_suppress_learnings;
$chatbot_ultra_suppress_learnings = esc_attr(get_option('chatbot_ultra_suppress_learnings', 'Random'));

// Context History - Ver 1.6.1
$context_history = [];

function chatbot_ultra_enqueue_admin_scripts() {
    wp_enqueue_script('chatbot_ultra_admin', plugins_url('assets/js/chatbot-ultra-admin.js', __FILE__), array('jquery'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'chatbot_ultra_enqueue_admin_scripts');

// Activation, deactivation, and uninstall functions
register_activation_hook(__FILE__, 'chatbot_ultra_activate');
register_deactivation_hook(__FILE__, 'chatbot_ultra_deactivate');
register_uninstall_hook(__FILE__, 'chatbot_ultra_uninstall');
add_action('upgrader_process_complete', 'chatbot_ultra_upgrade_completed', 10, 2);

// Enqueue plugin scripts and styles
function chatbot_ultra_enqueue_scripts() {

    // Enqueue the styles
    wp_enqueue_style('dashicons');
    wp_enqueue_style('chatbot-ultra-css', plugins_url('assets/css/chatbot-ultra.css', __FILE__));

    // Enqueue the scripts
    wp_enqueue_script('chatbot-ultra-js', plugins_url('assets/js/chatbot-ultra.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_script('chatbot-ultra-local', plugins_url('assets/js/chatbot-ultra-local.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_script('chatbot-ultra-file-upload-js', plugins_url('assets/js/chatbot-ultra-file-upload.js', __FILE__), array('jquery'), '1.0', true);
    
    // Localize the data for user id and page id
    $user_id = get_current_user_id();
    $page_id = get_the_ID();
    $script_data_array = array(
        'user_id' => $user_id,
        'page_id' => $page_id
    );

    // Defaults for Ver 1.6.1
    $defaults = array(
        'chatbot_ultra_bot_name' => 'Chatbot Ultra',
        // TODO IDEA - Add a setting to fix or randomize the bot prompt
        'chatbot_ultra_bot_prompt' => 'Enter your question ...',
        'chatbot_ultra_initial_greeting' => 'Hello! How can I help you today?',
        'chatbot_ultra_subsequent_greeting' => 'Hello again! How can I help you?',
        'chatbot_ultra_display_style' => 'floating',
        'chatbot_ultra_assistant_alias' => 'primary',
        'chatbot_ultra_start_status' => 'closed',
        'chatbot_ultra_start_status_new_visitor' => 'closed',
        'chatbot_ultra_disclaimer' => 'No',
        'chatbot_ultra_max_tokens' => '2000',
        'chatbot_ultra_width' => 'Narrow',
        'chatbot_ultra_diagnostics' => 'Off',
        'chatbot_ultra_avatar_icon' => 'icon-001.png',
        'chatbot_ultra_avatar_icon_url' => '',
        'chatbot_ultra_custom_avatar_icon' => 'icon-001.png',
        'chatbot_ultra_avatar_greeting' => 'Howdy!!! Great to see you today! How can I help you?',
        'chatbot_ultra_model_choice' => 'gpt-4-1106-preview',
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
        'chatbot_ultra_bot_prompt', // Added in Ver 1.6.6
        'chatbot_ultra_initial_greeting',
        'chatbot_ultra_subsequent_greeting',
        'chatbot_ultra_display_style',
        'chatbot_ultra_assistant_alias',
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
    }

    $chatbot_settings['chatbot_ultra_icon_base_url'] = plugins_url( 'assets/icons/', __FILE__ );

    // Localize the data for javascripts
    wp_localize_script('chatbot-ultra-js', 'php_vars', $script_data_array);

    wp_localize_script('chatbot-ultra-js', 'plugin_vars', array(
        'pluginUrl' => plugins_url('', __FILE__ ),
    ));

    wp_localize_script('chatbot-ultra-local', 'chatbotSettings', $chatbot_settings);

    wp_localize_script('chatbot-ultra-js', 'chatbot_ultra_params', array(
        'pluginUrl' => plugins_url('', __FILE__ ),
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    // Upload files - Ver 1.7.6
    wp_localize_script('chatbot-ultra-upload-trigger-js', 'chatbot_ultra_params', array(
        'pluginUrl' => plugins_url('', __FILE__ ),
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    // Populate the chatbot settings array with values from the database, using default values where necessary
    $chatbot_settings = array();
    foreach ($option_keys as $key) {
        $default_value = isset($defaults[$key]) ? $defaults[$key] : '';
        $chatbot_settings[$key] = esc_attr(get_option($key, $default_value));
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', 'chatbot-ultra.php: Key: ' . $key . ', Value: ' . $chatbot_settings[$key]);
    }

    // Update localStorage - Ver 1.6.1
    echo "<script type=\"text/javascript\">
    document.addEventListener('DOMContentLoaded', (event) => {
        // Encode the chatbot settings array into JSON format for use in JavaScript
        let chatbotSettings = " . json_encode($chatbot_settings) . ";

        Object.keys(chatbotSettings).forEach((key) => {
            if(!localStorage.getItem(key)) {
                // DIAG - Log the key and value
                // console.log('Chatbot ultra: NOTICE: Setting ' + key + ' in localStorage');
                localStorage.setItem(key, chatbotSettings[key]);
            } else {
                // DIAG - Log the key and value
                // console.log('Chatbot ultra: NOTICE: ' + key + ' is already set in localStorage');
            }
        });
    });
    </script>";
    
}
add_action('wp_enqueue_scripts', 'chatbot_ultra_enqueue_scripts');

// Settings and Deactivation Links - Ver - 1.5.0
function enqueue_jquery_ui() {
    wp_enqueue_style('wp-jquery-ui-dialog');
    wp_enqueue_script('jquery-ui-dialog');
}
add_action( 'admin_enqueue_scripts', 'enqueue_jquery_ui' );

// Schedule Cleanup of Expired Transients
if (!wp_next_scheduled('chatbot_ultra_cleanup_event')) {
    wp_schedule_event(time(), 'daily', 'chatbot_ultra_cleanup_event');
}
add_action('chatbot_ultra_cleanup_event', 'clean_specific_expired_transients');

// Schedule Conversation Log Cleanup - Ver 1.6.7
if (!wp_next_scheduled('chatbot_ultra_conversation_log_cleanup_event')) {
    wp_schedule_event(time(), 'daily', 'chatbot_ultra_conversation_log_cleanup_event');
}
add_action('chatbot_ultra_conversation_log_cleanup_event', 'chatbot_ultra_conversation_log_cleanup');

// Handle Ajax requests
function chatbot_ultra_send_message() {

    // Global variables
    global $sessionId;
    global $thread_Id;

    // Retrieve the API key
    $api_key = esc_attr(get_option('chatbot_ultra_api_key'));
    // Retrieve the Use GPT Assistant Id
    $model = esc_attr(get_option('chatbot_ultra_model_choice', 'gpt-3.5-turbo'));
    // FIXME - If gpt-4-turbo is selected, set the API model to gpt-4-1106-preview, i.e., the API name for the model
    if ($model == 'gpt-4-turbo') {
        $model = 'gpt-4-1106-preview';
    }
    // DIAG - Diagnostics
    // chatbot_ultra_back_trace( 'NOTICE', '$model: ' . $model);
    // Retrieve the Max tokens - Ver 1.4.2
    $chatbot_ultra_max_tokens = esc_attr(get_option('chatbot_ultra_max_tokens', 150));
    // Send only clean text via the API
    $message = sanitize_text_field($_POST['message']);

    // FIXME - ADD THIS BACK IN AFTER DECIDING WHAT TO DO ABOUT MISSING OR BAD API KEYS
    // Check API key and message
    if (!$api_key || !$message) {
        wp_send_json_error('Invalid API key or message');
    }

    $thread_Id = '';
    $assistant_id = '';
    $user_id = '';
    $page_id = '';
    // error_log ('$sessionId ' . $sessionId);
    
    // Check the transient for the Assistant ID - Ver 1.7.2
    $user_id = intval($_POST['user_id']);
    $page_id = intval($_POST['page_id']); 
    // DIAG - Diagnostics
    // chatbot_ultra_back_trace( 'NOTICE', '$user_id ' . $user_id);
    // chatbot_ultra_back_trace( 'NOTICE', '$page_id ' . $page_id);
    $chatbot_settings = get_chatbot_ultra_transients( 'dipslay_style', $user_id, $page_id);
    $display_style = isset($chatbot_settings['display_style']) ? $chatbot_settings['display_style'] : '';
    $chatbot_settings = get_chatbot_ultra_transients( 'assistant_alias', $user_id, $page_id);
    $chatbot_ultra_assistant_alias = isset($chatbot_settings['assistant_alias']) ? $chatbot_settings['assistant_alias'] : '';
    $chatbot_settings = get_chatbot_ultra_threads($user_id, $page_id);
    $assistant_id = isset($chatbot_settings['assistantID']) ? $chatbot_settings['assistantID'] : '';
    $thread_Id = isset($chatbot_settings['threadID']) ? $chatbot_settings['threadID'] : '';

    // Assistants
    // $chatbot_ultra_assistant_alias == 'original'; // Default
    // $chatbot_ultra_assistant_alias == 'primary';
    // $chatbot_ultra_assistant_alias == 'alternate';
    // $chatbot_ultra_assistant_alias == 'asst_xxxxxxxxxxxxxxxxxxxxxxxx'; // GPT Assistant Id
  
    // Which Assistant ID to use - Ver 1.7.2
    if ($chatbot_ultra_assistant_alias == 'original') {
        $use_assistant_id = 'No';
        // error_log ('Using Original GPT Assistant Id');
    } elseif ($chatbot_ultra_assistant_alias == 'primary') {
        $assistant_id = esc_attr(get_option('chatbot_ultra_assistant_id'));
        $use_assistant_id = 'Yes';
        // error_log ('Using Primary GPT Assistant Id ' . $assistant_id);
        // Check if the GPT Assistant Id is blank, null, or "Please provide the Customer GPT Assistant Id."
        if (empty($assistant_id) || $assistant_id == "Please provide the Customer GPT Assistant Id.") {
            // Override the $use_assistant_id and set it to 'No'
            $use_assistant_id = 'No';
            // error_log ('Falling back to ultra API');
        }
    } elseif ($chatbot_ultra_assistant_alias == 'alternate') {
        $assistant_id = esc_attr(get_option('chatbot_ultra_assistant_id_alternate'));
        $use_assistant_id = 'Yes';
        // error_log ('Using Alternate GPT Assistant Id ' . $assistant_id);
        // Check if the GPT Assistant Id is blank, null, or "Please provide the Customer GPT Assistant Id."
        if (empty($assistant_id) || $assistant_id == "Please provide the Customer GPT Assistant Id.") {
            // Override the $use_assistant_id and set it to 'No'
            $use_assistant_id = 'No';
            // error_log ('Falling back to chat provider API');
        }
    } else {
        // Reference GPT Assistant IDs directly - Ver 1.7.3
        if (substr($chatbot_ultra_assistant_alias, 0, 5) === 'asst_') {
            // DIAG - Diagnostics
            // chatbot_ultra_back_trace( 'NOTICE', 'Using GPT Assistant Id: ' . $chatbot_ultra_assistant_alias);
            // Override the $assistant_id with the GPT Assistant Id
            $assistant_id = $chatbot_ultra_assistant_alias;
            $use_assistant_id = 'Yes';
            // error_log ('Using GPT Assistant Id ' . $assistant_id);
        } else {
            // DIAG - Diagnostics
            // chatbot_ultra_back_trace( 'NOTICE', 'Using ultra API: ' . $chatbot_ultra_assistant_alias);
            // Override the $use_assistant_id and set it to 'No'
            $use_assistant_id = 'No';
            // error_log ('Falling back to chat provider API');
        }
    }

    // Decide whether to use an Assistant or chat provider API - Ver 1.6.7
    if ($use_assistant_id == 'Yes') {
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', 'Using GPT Assistant Id: ' . $use_assistant_id);

        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', '* * * chatbot-ultra.php * * *');
        // chatbot_ultra_back_trace( 'NOTICE', '$user_id ' . $user_id);
        // chatbot_ultra_back_trace( 'NOTICE', '$page_id ' . $page_id);
        // chatbot_ultra_back_trace( 'NOTICE', '* * * chatbot-ultra.php * * *');

        // Send message to Custom GPT API - Ver 1.6.7

        // error_log ('$message ' . $message);
        append_message_to_conversation_log($sessionId, $user_id, $page_id, 'Visitor', $thread_Id, $assistant_id, $message);
        
        $response = chatbot_ultra_custom_gpt_call_api($api_key, $message, $assistant_id, $thread_Id, $user_id, $page_id);

        // error_log ('$response ' . $response);
        append_message_to_conversation_log($sessionId, $user_id, $page_id, 'Chatbot', $thread_Id, $assistant_id, $response);

        // Use TF-IDF to enhance response
        $response = $response . chatbot_ultra_enhance_with_tfidf($message);
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', ['message' => 'response', 'response' => $response]);
        // Clean (erase) the output buffer - Ver 1.6.8
        ob_clean();
        if (substr($response, 0, 6) === 'Error:' || substr($response, 0, 7) === 'Failed:') {
            // Return response
            wp_send_json_error('Oops! Something went wrong on our end. Please try again later');
        } else {
            // Return response
            wp_send_json_success($response);
        }
    } else {
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', 'Using ultra API: ' . $use_assistant_id);
        // chatbot_ultra_back_trace( 'NOTICE', '$assistant_id: ' . $assistant_id);
        // Send message to chat provider API - Ver 1.6.7
        $response = chatbot_ultra_call_api($api_key, $message);
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', ['message' => 'BEFORE CALL TO ENHANCE TFIDF', 'response' => $response]);
        // Use TF-IDF to enhance response
        $response = $response . chatbot_ultra_enhance_with_tfidf($message);
        // DIAG - Diagnostics
        // chatbot_ultra_back_trace( 'NOTICE', ['message' => 'AFTER CALL TO ENHANCE TFIDF', 'response' => $response]);
        // Return response
        wp_send_json_success($response);
    }

    wp_send_json_error('Oops, I fell through the cracks!');

}

// Add action to send messages - Ver 1.0.0
add_action('wp_ajax_chatbot_ultra_send_message', 'chatbot_ultra_send_message');
add_action('wp_ajax_nopriv_chatbot_ultra_send_message', 'chatbot_ultra_send_message');

// Add action to upload files - Ver 1.7.6
add_action('wp_ajax_chatbot_ultra_upload_file_to_assistant', 'chatbot_ultra_upload_file_to_assistant');
add_action('wp_ajax_nopriv_chatbot_ultra_upload_file_to_assistant', 'chatbot_ultra_upload_file_to_assistant');

// Settings and Deactivation - Ver 1.5.0
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'chatbot_ultra_plugin_action_links');

// Crawler aka Knowledge Navigator - Ver 1.6.1
function chatbot_ultra_kn_status_activation() {
    add_option('chatbot_ultra_kn_status', 'Never Run');
    // clear any old scheduled runs
    if (wp_next_scheduled('crawl_scheduled_event_hook')) {
        wp_clear_scheduled_hook('crawl_scheduled_event_hook');
    }
    // clear the 'knowledge_navigator_scan_hook' hook on plugin activation - Ver 1.6.3
    if (wp_next_scheduled('knowledge_navigator_scan_hook')) {
        wp_clear_scheduled_hook('knowledge_navigator_scan_hook'); // Clear scheduled runs
    }
}
register_activation_hook(__FILE__, 'chatbot_ultra_kn_status_activation');

// Clean Up in Aisle 4
function chatbot_ultra_kn_status_deactivation() {
    delete_option('chatbot_ultra_kn_status');
    wp_clear_scheduled_hook('knowledge_navigator_scan_hook'); 
}
register_deactivation_hook(__FILE__, 'chatbot_ultra_kn_status_deactivation');

// Function to add a new message and response, keeping only the last five - Ver 1.6.1
function addEntry($transient_name, $newEntry) {
    $context_history = get_transient($transient_name);
    if (!$context_history) {
        $context_history = [];
    }

    // Determine the total length of all existing entries
    $totalLength = 0;
    foreach ($context_history as $entry) {
        if (is_string($entry)) {
            $totalLength += strlen($entry);
        } elseif (is_array($entry)) {
            $totalLength += strlen(json_encode($entry)); // Convert to string if an array
        }
    }

    // IDEA - How will the new threading option from OpenAI change how this works?
    // Define thresholds for the number of entries to keep
    $maxEntries = 30; // Default maximum number of entries
    if ($totalLength > 5000) { // Higher threshold
        $maxEntries = 20;
    }
    if ($totalLength > 10000) { // Lower threshold
        $maxEntries = 10;
    }

    while (count($context_history) >= $maxEntries) {
        array_shift($context_history); // Remove the oldest element
    }

    if (is_array($newEntry)) {
        $newEntry = json_encode($newEntry); // Convert the array to a string
    }

    array_push($context_history, $newEntry); // Append the new element
    set_transient($transient_name, $context_history); // Update the transient
}


// Function to return message and response - Ver 1.6.1
function concatenateHistory($transient_name) {
    $context_history = get_transient($transient_name);
    if (!$context_history) {
        return ''; // Return an empty string if the transient does not exist
    }
    return implode(' ', $context_history); // Concatenate the array values into a single string
}

// Initialize the Greetings - Ver 1.6.1
function enqueue_greetings_script() {
    global $chatbot_ultra_diagnostics;

    // DIAG - Diagnostics - Ver 1.6.1
    // chatbot_ultra_back_trace( 'NOTICE', "enqueue_greetings_script() called");

    wp_enqueue_script('greetings', plugin_dir_url(__FILE__) . 'assets/js/greetings.js', array('jquery'), null, true);

    $greetings = array(
        'chatbot_ultra_initial_greeting' => esc_attr(get_option('chatbot_ultra_initial_greeting', 'Hello! How can I help you today?')),
        'chatbot_ultra_subsequent_greeting' => esc_attr(get_option('chatbot_ultra_subsequent_greeting', 'Hello again! How can I help you?')),
    );

    wp_localize_script('greetings', 'greetings_data', $greetings);

}
add_action('wp_enqueue_scripts', 'enqueue_greetings_script');
