<?php
/**
 * Chatbot Ultra for WordPress - Upgrade the chatbot-ultra plugin.
 *
 * This file contains the code for upgrading the plugin.
 * It should run with the plugin is activated, deactivated, or updated.
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Activation Hook - Revised 1.7.6
function chatbot_ultra_activate() {

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin activation started');

    // Logic to run during activation
    chatbot_ultra_upgrade();

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin activation completed');

    return;

}

// Deactivation Hook - Revised 1.7.6
function chatbot_ultra_deactivate() {

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin deactivation started');

    // Logic to run during deactivation
    // FIXME - THIS IS NOT DELETEING THE PLUGIN - JUST DEACTIVATION

    // FIXME - Asked what data should be removed
    // 
    // DB - chatbot_ultra_conversation_log
    // DB - chatbot_ultra_interactions
    // DB - chatbot_ultra_knowledge_base
    // DB - chatbot_ultra_knowledge_base_tfidf

    // FIXME - Asked what options should be removed
    //
    // OPTIONS - *chatbot_ultra*

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin deactivation completed');

    return;

}

// Upgrade Hook for Plugin Update - Revised 1.7.6
function chatbot_ultra_upgrade_completed($upgrader_object, $options) {

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin upgrade started');

    if ($options['action'] == 'update' && $options['type'] == 'plugin') {
        if (isset($options['plugins']) && is_array($options['plugins'])) {
            foreach($options['plugins'] as $plugin) {
                if (plugin_basename(__FILE__) === $plugin) {
                    // Logic to run during upgrade
                    chatbot_ultra_upgrade();
                    break;
                }
            }
        } else {
            // DIAG - Log the warning
            // chatbot_ultra_back_trace( 'WARNING', '"plugins" key is not set or not an array');
        }
    }

    // DIAG - Log the activation
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin upgrade started');

    return;

}

// Upgrade Logic - Revised 1.7.6
function chatbot_ultra_upgrade() {
    // KEEP ME AS EXAMPLE CODE

    // // DIAG - Log the upgrade
    // // chatbot_ultra_back_trace( 'NOTICE', 'Plugin upgrade started');

    // // Removed obsolete or replaced options
    // if ( get_option( 'chatbot_ultra_crawler_status' ) ) {
    //     delete_option( 'chatbot_ultra_crawler_status' );
    //     // chatbot_ultra_back_trace( 'NOTICE', 'chatbot_ultra_crawler_status option deleted');
    // }

    // // Add new or replaced options - chatbot_ultra_diagnostics
    // if ( get_option( 'chatbot_ultra_diagnostics' ) ) {
    //     $diagnostics = get_option( 'chatbot_ultra_diagnostics' );
    //     if ( !$diagnostics || $diagnostics == '' || $diagnostics == ' ' ) {
    //         update_option( 'chatbot_ultra_diagnostics', 'No' );
    //     }
    //     // chatbot_ultra_back_trace( 'NOTICE', 'chatbot_ultra_diagnostics option updated');
    // }

    // // Add new or replaced options - chatbot_ultra_plugin_version
    // // If the old option exists, delete it
    // if (get_option( 'ultra_plugin_version' )) {
    //     delete_option( 'ultra_plugin_version' );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'ultra_plugin_version option deleted');
    // }

    // // Replace option - chatbot_ultra_width
    // // If the old option exists, delete it
    // if (get_option( 'chatbot_width' )) {
    //     $chatbot_ultra_width = get_option( 'chatbot_width_setting' );
    //     delete_option( 'chatbot_width_setting' );
    //     update_option( 'chatbot_ultra_width', $chatbot_ultra_width );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'chatbot_width_setting option deleted');
    // }
    // if (get_option( 'ultra_width_setting' )) {
    //     $chatbot_ultra_width = get_option('chatbot_width_setting');
    //     delete_option( 'ultra_width_setting' );
    //     update_option( 'chatbot_ultra_width', $chatbot_ultra_width );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'chatbot_ultra_width option replaced');
    // }

    // // Replace option - chatbot_ultra_api_key
    // // If the old option exists, delete it
    // if (get_option( 'chatbot_ultra_api_key' )) {
    //     $chatbot_ultra_api_key = get_option( 'chatbot_ultra_api_key' );
    //     delete_option( 'chatbot_ultra_api_key' );
    //     update_option( 'chatbot_ultra_api_key', $chatbot_ultra_api_key );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'chatbot_width_setting option deleted');
    // }

    // // Replace option - chatbot_ultra_avatar_greeting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_avatar_greeting_setting' )) {
    //     $chatbot_ultra_avatar_greeting = get_option( 'ultra_avatar_greeting_setting' );
    //     delete_option( 'ultra_avatar_greeting_setting' );
    //     update_option( 'chatbot_ultra_avatar_greeting', $chatbot_ultra_avatar_greeting );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'cultra_avatar_greeting_setting option deleted');
    // }

    // // Replace option - ultra_avatar_icon_setting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_avatar_icon_setting' )) {
    //     $chatbot_ultra_avatar_greeting = get_option( 'ultra_avatar_icon_setting' );
    //     delete_option( 'ultra_avatar_icon_setting' );
    //     update_option( 'chatbot_ultra_avatar_icon', $chatbot_ultra_avatar_icon );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_avatar_icon_setting option deleted');
    // }
    // if (get_option ( 'chatbot_ultra_avatar_icon' )) {
    //     delete_option( 'chatbot_ultra_avatar_icon' );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', 'chatbot_ultra_avatar_icon option replaced');
    // }

    // // Replace option - ultra_avatar_icon_setting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_avatar_icon_url_setting' )) {
    //     $chatbot_ultra_avatar_icon_url = get_option( 'ultra_avatar_icon_url_setting' );
    //     delete_option( 'ultra_avatar_icon_url_setting' );
    //     update_option( 'chatbot_ultra_avatar_icon_url', $chatbot_ultra_avatar_icon_url );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_avatar_icon_url_setting option deleted');
    // }

    // // Replace option - ultra_bot_name
    // // If the old option exists, delete it
    // if (get_option( 'ultra_bot_name' )) {
    //     $chatbot_ultra_bot_name = get_option( 'ultra_bot_name' );
    //     delete_option( 'ultra_bot_name' );
    //     update_option( 'chatbot_ultra_bot_name', $chatbot_ultra_bot_name );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_bot_name option deleted');
    // }

    // // Replace option - ultra_custom_avatar_icon_setting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_custom_avatar_icon_setting' )) {
    //     $chatbot_ultra_custom_avatar_icon = get_option( 'ultra_custom_avatar_icon_setting' );
    //     delete_option( 'ultra_custom_avatar_icon_setting' );
    //     update_option( 'chatbot_ultra_custom_avatar_icon', $chatbot_ultra_custom_avatar_icon );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_custom_avatar_icon_setting option deleted');
    // }

    // // Replace option - ultra_diagnostics
    // // If the old option exists, delete it
    // if (get_option( 'ultra_diagnostics' )) {
    //     $chatbot_ultra_diagnostics = get_option( 'ultra_diagnostics' );
    //     delete_option( 'ultra_diagnostics' );
    //     update_option( 'chatbot_ultra_diagnostics', $chatbot_ultra_diagnostics );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_diagnostics option deleted');
    // }

    // // Replace option - ultra_disclaimer_setting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_disclaimer_setting' )) {
    //     $chatbot_ultra_disclaimer = get_option( 'ultra_disclaimer_setting' );
    //     delete_option( 'ultra_disclaimer_setting' );
    //     update_option( 'chatbot_ultra_disclaimer', $chatbot_ultra_disclaimer );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_disclaimer_setting option deleted');
    // }

    // // Replace option - ultra_ultra_initial_greeting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_ultra_initial_greeting' )) {
    //     $chatbot_ultra_initial_greeting = get_option( 'ultra_ultra_initial_greeting' );
    //     delete_option( 'ultra_ultra_initial_greeting' );
    //     update_option( 'chatbot_ultra_initial_greeting', $chatbot_ultra_initial_greeting );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_ultra_initial_greeting option deleted');
    // }

    // // Replace option - ultra_max_tokens
    // // If the old option exists, delete it
    // if (get_option( 'ultra_max_tokens' )) {
    //     $chatbot_ultra_max_tokens = get_option( 'ultra_max_tokens' );
    //     delete_option( 'ultra_max_tokens' );
    //     update_option( 'chatbot_ultra_max_tokens', $chatbot_ultra_max_tokens );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_max_tokens option deleted');
    // }

    // // Replace option - ultra_model_choice
    // // If the old option exists, delete it
    // if (get_option( 'ultra_model_choice' )) {
    //     $chatbot_ultra_model_choice = get_option( 'ultra_model_choice' );
    //     delete_option( 'ultra_model_choice' );
    //     update_option( 'chatbot_ultra_model_choice', $chatbot_ultra_model_choice );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_model_choice option deleted');
    // }

    // // Replace option - chatbot_ultra_start_status_new_visitor
    // // If the old option exists, delete it
    // if (get_option( 'chatbot_ultra_start_status_new_visitor' )) {
    //     $chatbot_ultra_start_status_new_visitor = get_option( 'chatbot_ultra_start_status_new_visitor' );
    //     delete_option( 'chatbot_ultra_start_status_new_visitor' );
    //     update_option( 'chatbot_ultra_start_status_new_visitor', $chatbot_ultra_start_status_new_visitor );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', chatbot_ultra_start_status_new_visitor option deleted');
    // }
    // if (get_option( 'ultra_start_status' )) {
    //     delete_option( 'ultra_start_status' );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_start_status option deleted');
    // }

    // // Replace option - chatbot_ultra_start_status
    // // If the old option exists, delete it
    // if (get_option( 'chatbot_ultra_start_status' )) {
    //     $chatbot_ultra_start_status = get_option( 'chatbot_ultra_start_status' );
    //     delete_option( 'chatbot_ultra_start_status' );
    //     update_option( 'chatbot_ultra_start_status', $chatbot_ultra_start_status );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', chatbot_ultra_start_status option deleted');
    // }

    // // Replace option - ultra_chatbot_bot_prompt
    // // If the old option exists, delete it
    // if (get_option( 'ultra_chatbot_bot_prompt' )) {
    //     $chatbot_ultra_bot_prompt = get_option( 'ultra_chatbot_bot_prompt' );
    //     delete_option( 'ultra_chatbot_bot_prompt' );
    //     update_option( 'chatbot_ultra_bot_prompts', $chatbot_ultra_bot_prompt );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_chatbot_bot_prompt option deleted');
    // }

    // // Replace option - ultra_subsequent_greeting
    // // If the old option exists, delete it
    // if (get_option( 'ultra_subsequent_greeting' )) {
    //     $chatbot_ultra_subsequent_greeting = get_option( 'ultra_subsequent_greeting' );
    //     delete_option( 'ultra_subsequent_greeting' );
    //     update_option( 'chatbot_ultra_subsequent_greeting', $chatbot_ultra_subsequent_greeting );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultra_subsequent_greeting option deleted');
    // }

    // // Replace option - ultraChatBotStatus
    // if (get_option( 'ultraChatBotStatus' )) {
    //     delete_option( 'ultraChatBotStatus' );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultraChatBotStatus option deleted');
    // }

    // // Replace option - ultraChatBotStatusNewVisitor
    // if (get_option( 'ultraChatBotStatusNewVisitor' )) {
    //     delete_option( 'ultraChatBotStatusNewVisitor' );
    //     // DIAG - Log the old option deletion
    //     // chatbot_ultra_back_trace('NOTICE', ultraChatBotStatusNewVisitor option deleted');
    // }
    
    // FIXME - DETERMINE WHAT OTHER 'OLD' OPTIONS SHOULD BE DELETED
    // FIXME - DETERMINE WHAT OPTION NAMES NEED TO BE CHANGED (DELETE, THEN REPLACE)

    // Add/update the option - chatbot_ultra_plugin_version
    $plugin_version = get_plugin_version();
    update_option('chatbot_ultra_plugin_version', $plugin_version);
    
    // DIAG - Log the plugin version
    chatbot_ultra_back_trace('NOTICE', 'chatbot_ultra_plugin_version option created');

    // Add new/replaced options - chatbot_ultra_interactions
    create_chatbot_ultra_interactions_table();
    // DIAG - Log the table creation
    chatbot_ultra_back_trace( 'NOTICE', 'chatbot_ultra_interactions table created');

    // Add new/replaced options - create_conversation_logging_table
    create_conversation_logging_table();
    // DIAG - Log the table creation
    chatbot_ultra_back_trace( 'NOTICE', 'chatbot_ultra_conversation_log table created');

    // DIAG - Log the upgrade compelete
    chatbot_ultra_back_trace( 'NOTICE', 'Plugin upgrade completed');

    return;

}

// Upgrade Logic - Revised 1.7.6
function chatbot_ultra_uninstall(){
    
        // DIAG - Log the uninstall
        // chatbot_ultra_back_trace( 'NOTICE', 'Plugin uninstall started');
    
        // Remove obsolete or replaced options
        // FIXME - Ask what data should be removed
        // TBD

        // Remove tables
        // FIXME - Ask what data should be removed
        // TBD

        // Remove transients
        // FIXME - Ask what data should be removed
        // TBD
    
        // DIAG - Log the uninstall
        // chatbot_ultra_back_trace( 'NOTICE', 'Plugin uninstall completed');

        return;
}

// Determine if the plugin is installed
function get_plugin_version() {

    if (!function_exists('get_plugin_data')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }

    $plugin_data = get_plugin_data(plugin_dir_path(__FILE__) . '../chatbot-ultra.php');
    $plugin_version = $plugin_data['Version'];
    update_option('chatbot_ultra_plugin_version', $plugin_version);
    
    // DIAG - Log the plugin version
    // chatbot_ultra_back_trace( 'NOTICE', 'Plugin version '. $plugin_version);

    return $plugin_version;

}

