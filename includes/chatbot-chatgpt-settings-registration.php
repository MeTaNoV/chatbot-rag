<?php
/**
 * Chatbot Ultra for WordPress - Registration
 *
 * This file contains the code for the Chatbot Ultra settings page.
 * It handles the registration of settings and other parameters.
 * 
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Register settings
function chatbot_ultra_settings_init() {
    // TODO(pg): check if all correct...

    // API/Model settings tab - Ver 1.3.0
    // register_setting('chatbot_ultra_api_model', 'chatbot_ultra_api_key');
    // Obfuscate the API key in settings registration - Ver 1.5.0
    register_setting('chatbot_ultra_api_model', 'chatbot_ultra_api_key', 'sanitize_api_key');
    register_setting('chatbot_ultra_api_model', 'chatbot_ultra_model_choice');
    register_setting('chatbot_ultra_api_model', 'chatbot_ultra_max_tokens'); // Max Tokens setting options - Ver 1.4.2
    register_setting('chatbot_ultra_api_model', 'chatbot_ultra_conversation_context'); // Covnersation Context - Ver 1.6.1

    add_settings_section(
        'chatbot_ultra_api_model_section',
        'API/Model Settings',
        'chatbot_ultra_api_model_section_callback',
        'chatbot_ultra_api_model'
    );

    add_settings_field(
        'chatbot_ultra_api_key',
        'ChatGPT API Key',
        'chatbot_ultra_api_key_callback',
        'chatbot_ultra_api_model',
        'chatbot_ultra_api_model_section'
    );

    add_settings_field(
        'chatbot_ultra_model_choice',
        'ChatGPT Model Choice',
        'chatbot_ultra_model_choice_callback',
        'chatbot_ultra_api_model',
        'chatbot_ultra_api_model_section'
    );
    
    // Setting to adjust in small increments the number of Max Tokens - Ver 1.4.2
    add_settings_field(
        'chatbot_ultra_max_tokens',
        'Maximum Tokens',
        'chatgpt_max_tokens_callback',
        'chatbot_ultra_api_model',
        'chatbot_ultra_api_model_section'
    );

    // Setting to adjust in small increments the number of Max Tokens - Ver 1.4.2
    add_settings_field(
        'chatbot_ultra_conversation_context',
        'Conversation Context',
        'chatbot_ultra_conversation_context_callback',
        'chatbot_ultra_api_model',
        'chatbot_ultra_api_model_section'
    );

    
    // Settings Custom GPTs tab - Ver 1.7.2
    register_setting('chatbot_ultra_custom_gpts', 'chatbot_ultra_use_custom_gpt_assistant_id'); // Ver 1.6.7
    register_setting('chatbot_ultra_custom_gpts', 'chatbot_ultra_allow_file_uploads'); // Ver 1.7.6
    register_setting('chatbot_ultra_custom_gpts', 'chatbot_ultra_assistant_id'); // Ver 1.6.7
    register_setting('chatbot_ultra_custom_gpts', 'chatbot_ultra_assistant_id_alternate'); // Alternate Assistant - Ver 1.7.2

    add_settings_section(
        'chatbot_ultra_custom_gpts_section',
        'GPT Assistant Settings',
        'chatbot_ultra_gpt_assistants_section_callback',
        'chatbot_ultra_custom_gpts'
    );
    
    // Use GPT Assistant Id (Yes or No) - Ver 1.6.7
    add_settings_field(
        'chatbot_ultra_use_custom_gpt_assistant_id',
        'Use GPT Assistant Id',
        'chatbot_ultra_use_gpt_assistant_id_callback',
        'chatbot_ultra_custom_gpts',
        'chatbot_ultra_custom_gpts_section'
    );

    // Allow file uploads to the Assistant - Ver 1.7.6
    add_settings_field(
        'chatbot_ultra_allow_file_uploads',
        'Allow File Uploads',
        'chatbot_ultra_allow_file_uploads_callback',
        'chatbot_ultra_custom_gpts',
        'chatbot_ultra_custom_gpts_section'
    );

    // CustomGPT Assistant Id - Ver 1.6.7
    add_settings_field(
        'chatbot_ultra_assistant_id',
        'Primary GPT Assistant Id',
        'chatbot_ultra_assistant_id_callback',
        'chatbot_ultra_custom_gpts',
        'chatbot_ultra_custom_gpts_section'
    );

    // CustomGPT Assistant Id Alternate - Ver 1.7.2
    add_settings_field(
        'chatbot_ultra_assistant_id_alternate',
        'Alternate GPT Assistant Id',
        'chatbot_ultra_assistant_id_alternate_callback',
        'chatbot_ultra_custom_gpts',
        'chatbot_ultra_custom_gpts_section'
    );


    // Settings settings tab - Ver 1.3.0
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_bot_name');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_bot_prompt');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_start_status');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_start_status_new_visitor');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_initial_greeting');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_subsequent_greeting');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_disclaimer');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_width');
    register_setting('chatbot_ultra_settings', 'chatbot_ultra_diagnostics');

    add_settings_section(
        'chatbot_ultra_settings_section',
        'Settings',
        'chatbot_ultra_settings_section_callback',
        'chatbot_ultra_settings'
    );

    add_settings_field(
        'chatbot_ultra_bot_name',
        'Bot Name',
        'chatbot_ultra_bot_name_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_start_status',
        'Start Status',
        'chatbot_ultra_start_status_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_start_status_new_visitor',
        'Start Status New Visitor',
        'chatbot_ultra_start_status_new_visitor_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

        add_settings_field(
        'chatbot_ultra_bot_prompt',
        'Chatbot Prompt',
        'chatbot_ultra_bot_prompt_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_initial_greeting',
        'Initial Greeting',
        'chatbot_ultra_initial_greeting_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_subsequent_greeting',
        'Subsequent Greeting',
        'chatbot_ultra_subsequent_greeting_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_disclaimer',
        'Include "As an AI language model" disclaimer',
        'chatbot_ultra_disclaimer_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    add_settings_field(
        'chatbot_ultra_width',
        'Chatbot Width',
        'chatbot_ultra_width_callback',
        'chatbot_ultra_settings',
        'chatbot_ultra_settings_section'
    );

    // Diagnostics settings tab - Ver 1.6.5
    register_setting('chatbot_ultra_diagnostics', 'chatbot_ultra_diagnostics');
    register_setting('chatbot_ultra_diagnostics', 'chatbot_ultra_suppress_notices');
    register_setting('chatbot_ultra_diagnostics', 'chatbot_ultra_suppress_attribution');
    register_setting('chatbot_ultra_diagnostics', 'chatbot_ultra_suppress_learnings');
    register_setting('chatbot_ultra_diagnostics', 'chatbot_ultra_custom_learnings_message');

    add_settings_section(
        'chatbot_ultra_diagnostics_section',
        'Diagnostics Settings',
        'chatbot_ultra_diagnostics_section_callback',
        'chatbot_ultra_diagnostics'
    );

    // Option to check API status - Ver 1.6.5
    add_settings_field(
        'chatbot_ultra_api_test',
        'API Test',
        'chatbot_ultra_api_test_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );

    // Option to set diagnostics on/off - Ver 1.5.0
    add_settings_field(
        'chatbot_ultra_diagnostics',
        'Chatbot Diagnostics',
        'chatbot_ultra_diagnostics_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );

    // Option to suppress notices and warnings - Ver 1.6.5
    add_settings_field(
        'chatbot_ultra_suppress_notices',
        'Suppress Notices and Warnings',
        'chatbot_ultra_suppress_notices_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );

    // Option to suppress learnings messages - Ver 1.7.1
    add_settings_field(
        'chatbot_ultra_suppress_learnings',
        'Suppress Learnings Messages',
        'chatbot_ultra_suppress_learnings_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );

    // Option to set custom learnings message - Ver 1.7.1
    add_settings_field(
        'chatbot_ultra_custom_learnings_message',
        'Custom Learnings Message',
        'chatbot_ultra_custom_learnings_message_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );

    // Option to suppress attribution - Ver 1.6.5
    add_settings_field(
        'chatbot_ultra_suppress_attribution',
        'Suppress Attribution',
        'chatbot_ultra_suppress_attribution_callback',
        'chatbot_ultra_diagnostics',
        'chatbot_ultra_diagnostics_section'
    );
    
    // Premium settings tab - Ver 1.3.0
    register_setting('chatbot_ultra_premium', 'chatgpt_premium_key');

    add_settings_section(
        'chatbot_ultra_premium_section',
        'Premium Settings',
        'chatbot_ultra_premium_section_callback',
        'chatbot_ultra_premium'
    );

    add_settings_field(
        'chatgpt_premium_key',
        'Premium Options',
        'chatbot_ultra_premium_key_callback',
        'chatbot_ultra_premium',
        'chatbot_ultra_premium_section'
    );

    // Support settings tab - Ver 1.3.0
    register_setting('chatbot_ultra_support', 'chatgpt_support_key');

    add_settings_section(
        'chatbot_ultra_support_section',
        'Support',
        'chatbot_ultra_support_section_callback',
        'chatbot_ultra_support'
    );

    // Avatar settings tab - Ver 1.5.0
    register_setting('chatbot_ultra_avatar', 'chatbot_ultra_avatar_icon');
    register_setting('chatbot_ultra_avatar', 'chatbot_ultra_avatar_icon_url');
    register_setting('chatbot_ultra_avatar', 'chatbot_ultra_custom_avatar_icon');
    register_setting('chatbot_ultra_avatar', 'chatbot_ultra_avatar_greeting');
    register_setting('chatbot_ultra_avatar', 'chatbot_ultra_avatar_icon_set');

    // Register a new section in the "chatbot_ultra" page
    add_settings_section(
        'chatbot_ultra_avatar_section', 
        'Avatar Settings', 
        'chatbot_ultra_avatar_section_callback', 
        'chatbot_ultra_avatar'
    );

    // Avatar Greeting
    add_settings_field(
        'chatbot_ultra_avatar_greeting',
        'Avatar Greeting',
        'chatbot_ultra_avatar_greeting_callback',
        'chatbot_ultra_avatar',
        'chatbot_ultra_avatar_section'
    );

    // Avatar Icon Set
    add_settings_field(
        'chatbot_ultra_avatar_icon_set',
        'Avatar Icon Set',
        'chatbot_ultra_avatar_icon_set_callback',
        'chatbot_ultra_avatar',
        'chatbot_ultra_avatar_section'
    );
    
    // Register new fields in the "chatbot_ultra_avatar_section" section, inside the "chatbot_ultra_avatar" page
    add_settings_field(
        'chatbot_ultra_avatar_icon',
        'Avatar Icon',
        'chatbot_ultra_avatar_icon_callback',
        'chatbot_ultra_avatar',
        'chatbot_ultra_avatar_section'
    );

    // Coming in Ver 2.0.0
    add_settings_field(
        'chatbot_ultra_custom_avatar_icon',
        'Custom Avatar URL',
        'chatbot_ultra_custom_avatar_callback',
        'chatbot_ultra_avatar',
        'chatbot_ultra_avatar_section'
    );

    // Knowledge Navigator settings tab - Ver 1.6.1
    register_setting('chatbot_ultra_knowledge_navigator', 'chatbot_ultra_knowledge_navigator');
    register_setting('chatbot_ultra_knowledge_navigator', 'chatbot_ultra_kn_maximum_top_words');
    register_setting('chatbot_ultra_knowledge_navigator', 'chatbot_ultra_kn_results');
    register_setting('chatbot_ultra_knowledge_navigator', 'chatbot_ultra_kn_conversation_context');

    add_settings_section(
        'chatbot_ultra_knowledge_navigator_section',
        'Knowledge Navigator',
        'chatbot_ultra_knowledge_navigator_section_callback',
        'chatbot_ultra_knowledge_navigator'
    );

    add_settings_field(
        'chatbot_ultra_kn_maximum_top_words',
        'Maximum Top Words',
        'chatbot_ultra_kn_maximum_top_words_callback',
        'chatbot_ultra_knowledge_navigator',
        'chatbot_ultra_knowledge_navigator_section'
    );

    add_settings_field(
        'chatbot_ultra_knowledge_navigator',
        'Select Run Schedule',
        'chatbot_ultra_knowledge_navigator_callback',
        'chatbot_ultra_knowledge_navigator',
        'chatbot_ultra_knowledge_navigator_section'
    );

    // Knowledge Navigator Analysis settings tab - Ver 1.6.1
    register_setting('chatbot_ultra_kn_analysis', 'chatbot_ultra_kn_analysis_output');

    add_settings_section(
        'chatbot_ultra_kn_analysis_section',
        'Knowledge Navigator Analysis',
        'chatbot_ultra_kn_analysis_section_callback',
        'chatbot_ultra_kn_analysis'
    );

    add_settings_field(
        'chatbot_ultra_kn_analysis_output',
        'Output Format',
        'chatbot_ultra_kn_analysis_output_callback',
        'chatbot_ultra_kn_analysis',
        'chatbot_ultra_kn_analysis_section'
    );

    // Reporting settings tab - Ver 1.6.1
    register_setting('chatbot_ultra_reporting', 'chatbot_ultra_reporting_period');
    register_setting('chatbot_ultra_reporting', 'chatbot_ultra_enable_conversation_logging');
    register_setting('chatbot_ultra_reporting', 'chatbot_ultra_conversation_log_days_to_keep');

    add_settings_section(
        'chatbot_ultra_reporting_section',
        'Reporting',
        'chatbot_ultra_reporting_section_callback',
        'chatbot_ultra_reporting'
    );

    add_settings_field(
        'chatbot_ultra_reporting_period',
        'Reporting Period',
        'chatbot_ultra_reporting_period_callback',
        'chatbot_ultra_reporting',
        'chatbot_ultra_reporting_section'
    );

    add_settings_field(
        'chatbot_ultra_enable_conversation_logging',
        'Enable Conversation Logging',
        'chatbot_ultra_enable_conversation_logging_callback',
        'chatbot_ultra_reporting',
        'chatbot_ultra_reporting_section'
    );

    add_settings_field(
        'chatbot_ultra_conversation_log_days_to_keep',
        'Conversation Log Days to Keep',
        'chatbot_ultra_conversation_log_days_to_keep_callback',
        'chatbot_ultra_reporting',
        'chatbot_ultra_reporting_section'
    );

    // Custom Buttons settings tab - Ver 1.6.5
    register_setting('chatbot_ultra_custom_buttons', 'chatbot_ultra_enable_custom_buttons');
    register_setting('chatbot_ultra_custom_buttons', 'chatbot_ultra_custom_button_name_1');
    register_setting('chatbot_ultra_custom_buttons', 'chatbot_ultra_custom_button_url_1');
    register_setting('chatbot_ultra_custom_buttons', 'chatbot_ultra_custom_button_name_2');
    register_setting('chatbot_ultra_custom_buttons', 'chatbot_ultra_custom_button_url_2');

    add_settings_section(
        'chatbot_ultra_custom_button_section',
        'Custom Buttons',
        'chatbot_ultra_custom_button_section_callback',
        'chatbot_ultra_custom_buttons'
    );

    add_settings_field(
        'chatbot_ultra_enable_custom_buttons',
        'Custom Buttons (On/Off)',
        'chatbot_ultra_enable_custom_buttons_callback',
        'chatbot_ultra_custom_buttons',
        'chatbot_ultra_custom_button_section'
    );

    add_settings_field(
        'chatbot_ultra_custom_button_name_1',
        'Custom Button 1 Name',
        'chatbot_ultra_custom_button_name_1_callback',
        'chatbot_ultra_custom_buttons',
        'chatbot_ultra_custom_button_section'
    );

    add_settings_field(
        'chatbot_ultra_custom_button_url_1',
        'Custom Button 1 Link',
        'chatbot_ultra_custom_button_link_1_callback',
        'chatbot_ultra_custom_buttons',
        'chatbot_ultra_custom_button_section'
    );

    add_settings_field(
        'chatbot_ultra_custom_button_name_2',
        'Custom Button 2 Name',
        'chatbot_ultra_custom_button_name_2_callback',
        'chatbot_ultra_custom_buttons',
        'chatbot_ultra_custom_button_section'
    );

    add_settings_field(
        'chatbot_ultra_custom_button_url_2',
        'Custom Button 2 Link',
        'chatbot_ultra_custom_button_link_2_callback',
        'chatbot_ultra_custom_buttons',
        'chatbot_ultra_custom_button_section'
    );

}

add_action('admin_init', 'chatbot_ultra_settings_init');
