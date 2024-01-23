<?php
/**
 * Chatbot Ultra for WordPress - Settings Page
 *
 * This file contains the code for the Chatbot Ultra settings page.
 * It allows users to configure the bot name, start status, and greetings.
 * 
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

function chatbot_ultra_settings_page() {
    add_options_page('Chatbot Ultra Settings', 'Chatbot Ultra', 'manage_options', 'chatbot-ultra', 'chatbot_ultra_settings_page_html');
}
add_action('admin_menu', 'chatbot_ultra_settings_page');

function chatbot_ultra_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    chatbot_ultra_localize();

    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'bot_settings';

    if (isset($_GET['settings-updated'])) {
        add_settings_error('chatbot_ultra_messages', 'chatbot_ultra_message', 'Settings Saved', 'updated');
    }

    ?>
    <div class="wrap">
        <h1><span class="dashicons dashicons-format-chat"></span> <?php echo esc_html(get_admin_page_title()); ?></h1>

        <div id="message-box-container"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chatgptSettingsForm = document.getElementById('chatgpt-settings-form');
                const chatbot_ultra_start_statusInput = document.getElementById('chatbot_ultra_start_status');
                const chatbot_ultra_start_status_new_visitorInput = document.getElementById('chatbot_ultra_start_status_new_visitor');
                const reminderCount = localStorage.getItem('reminderCount') || 0;

                if (reminderCount % 25 === 0 && reminderCount <= 200) {
                    const messageBox = document.createElement('div');
                    messageBox.id = 'rateReviewMessageBox';
                    messageBox.innerHTML = `
                    <div id="rateReviewMessageBox" style="background-color: white; border: 1px solid black; padding: 10px; position: relative;">
                        <div class="message-content" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>If you and your visitors are enjoying having this chatbot on your site, please take a moment to <a href="https://wordpress.org/support/plugin/chatbot-ultra/reviews/" target="_blank">rate and review this plugin</a>. Thank you!</span>
                            <button id="closeMessageBox" class="dashicons dashicons-dismiss" style="background: none; border: none; cursor: pointer; outline: none; padding: 0; margin-left: 10px;"></button>
                            
                        </div>
                    </div>
                    `;

                    document.querySelector('#message-box-container').insertAdjacentElement('beforeend', messageBox);

                    document.getElementById('closeMessageBox').addEventListener('click', function() {
                        messageBox.style.display = 'none';
                        localStorage.setItem('reminderCount', parseInt(reminderCount, 10) + 1);
                    });
                } else {
                    let reminderCount = +localStorage.getItem('reminderCount') || 0;
                    if (reminderCount < 200) {
                        reminderCount++;
                        localStorage.setItem('reminderCount', reminderCount);
                    }
                }
            });
        </script>
    
        <script>
            jQuery(document).ready(function($) {
                var chatgptSettingsForm = document.getElementById('chatgpt-settings-form');

                if (chatgptSettingsForm) {

                    chatgptSettingsForm.addEventListener('submit', function() {

                        // Get the input elements by their ids
                        var chatbot_ultra_bot_nameInput = document.getElementById('chatbot_ultra_bot_name');
                        var chatbot_ultra_bot_promptInput = document.getElementById('chatbot_ultra_bot_prompt');
                        var chatbot_ultra_initial_greetingInput = document.getElementById('chatbot_ultra_initial_greeting');
                        var chatbot_ultra_subsequent_greetingInput = document.getElementById('chatbot_ultra_subsequent_greeting');
                        var chatbot_ultra_start_statusInput = document.getElementById('chatbot_ultra_start_status');
                        var chatbot_ultra_start_status_new_visitorInput = document.getElementById('chatbot_ultra_start_status_new_visitor');
                        var chatbot_ultra_disclaimerInput = document.getElementById('chatbot_ultra_disclaimer');
                        var chatbot_ultra_max_tokensInput = document.getElementById('chatbot_ultra_max_tokens');
                        var chatbot_ultra_widthInput = document.getElementById('chatbot_ultra_width');
                        var chatbot_ultra_diagnoticsInput = document.getElementById('chatbot_ultra_diagnostics');
                        let chatbot_ultra_avatar_iconInput = document.getElementById('chatbot_ultra_avatar_icon');
                        let chatbot_ultra_custom_avatar_iconInput = document.getElementById('chatbot_ultra_custom_avatar_icon');
                        let chatbot_ultra_avatar_greetingInput = document.getElementById('chatbot_ultra_avatar_greeting');
                        let chatbot_ultra_enable_custom_buttonsInput = document.getElementById('chatbot_ultra_enable_custom_buttons');
                        let chatbot_ultra_custom_button_name_1Input = document.getElementById('chatbot_ultra_custom_button_name_1');
                        let chatbot_ultra_custom_button_url_1Input = document.getElementById('chatbot_ultra_custom_button_url_1');
                        let chatbot_ultra_custom_button_name_2Input = document.getElementById('chatbot_ultra_custom_button_name_2');
                        let chatbot_ultra_custom_button_url_2Input = document.getElementById('chatbot_ultra_custom_button_url_2');
                        let chatbot_ultra_allow_file_uploadsInput = document.getElementById('chatbot_ultra_allow_file_uploads');

                        // Update the local storage with the input values, if inputs exist
                        if(chatbot_ultra_bot_nameInput) localStorage.setItem('chatbot_ultra_bot_name', chatbot_ultra_bot_nameInput.value);
                        if(chatbot_ultra_bot_promptInput) localStorage.setItem('chatbot_ultra_bot_prompt', chatbot_ultra_bot_promptInput.value);
                        if(chatbot_ultra_initial_greetingInput) localStorage.setItem('chatbot_ultra_initial_greeting', chatbot_ultra_initial_greetingInput.value);
                        if(chatbot_ultra_subsequent_greetingInput) localStorage.setItem('chatbot_ultra_subsequent_greeting', chatbot_ultra_subsequent_greetingInput.value);
                        if(chatbot_ultra_start_statusInput) localStorage.setItem('chatbot_ultra_start_status', chatbot_ultra_start_statusInput.value);
                        if(chatbot_ultra_start_status_new_visitorInput) localStorage.setItem('chatbot_ultra_start_status_new_visitor', chatbot_ultra_start_status_new_visitorInput.value);
                        if(chatbot_ultra_disclaimerInput) localStorage.setItem('chatbot_ultra_disclaimer', chatbot_ultra_disclaimerInput.value);
                        if(chatbot_ultra_max_tokensInput) localStorage.setItem('chatbot_ultra_max_tokens', chatbot_ultra_max_tokensInput.value);
                        if(chatbot_ultra_widthInput) localStorage.setItem('chatbot_ultra_width', chatbot_ultra_widthInput.value);
                        if(chatbot_ultra_diagnoticsInput) localStorage.setItem('chatbot_ultra_diagnostics', chatbot_ultra_diagnoticsInput.value);
                        if(chatbot_ultra_avatar_iconInput) localStorage.setItem('chatbot_ultra_avatar_icon', chatbot_ultra_avatar_iconInput.value);
                        if(chatbot_ultra_custom_avatar_iconInput) localStorage.setItem('chatbot_ultra_custom_avatar_icon', chatbot_ultra_custom_avatar_iconInput.value);
                        if(chatbot_ultra_avatar_greetingInput) localStorage.setItem('chatbot_ultra_avatar_greeting', chatbot_ultra_avatar_greetingInput.value);
                        if(chatbot_ultra_enable_custom_buttonsInput) localStorage.setItem('chatbot_ultra_enable_custom_buttons', chatbot_ultra_enable_custom_buttonsInput.value);
                        if(chatbot_ultra_custom_button_name_1Input) localStorage.setItem('chatbot_ultra_custom_button_name_1', chatbot_ultra_custom_button_name_1Input.value);
                        if(chatbot_ultra_custom_button_url_1Input) localStorage.setItem('chatbot_ultra_custom_button_url_1', chatbot_ultra_custom_button_url_1Input.value);
                        if(chatbot_ultra_custom_button_name_2Input) localStorage.setItem('chatbot_ultra_custom_button_name_2', chatbot_ultra_custom_button_name_2Input.value);
                        if(chatbot_ultra_custom_button_url_2Input) localStorage.setItem('chatbot_ultra_custom_button_url_2', chatbot_ultra_custom_button_url_2Input.value);
                        if(chatbot_ultra_allow_file_uploadsInput) localStorage.setItem('chatbot_ultra_allow_file_uploads', chatbot_ultra_allow_file_uploadsInput.value);
                    });
                }
            });
        </script>

        <script>
            window.onload = function() {
                // Assign the function to the window object to make it globally accessible
                window.selectIcon = function(id) {
                    var chatbot_ultra_avatar_iconInput = document.getElementById('chatbot_ultra_avatar_icon');
                    if(chatbot_ultra_avatar_iconInput) {
                        // Clear border from previously selected icon
                        var previousIconId = chatbot_ultra_avatar_iconInput.value;
                        var previousIcon = document.getElementById(previousIconId);
                        if(previousIcon) previousIcon.style.border = "none";  // Change "" to "none"

                        // Set border for new selected icon
                        var selectedIcon = document.getElementById(id);
                        if(selectedIcon) selectedIcon.style.border = "2px solid red";

                        // Set selected icon value in hidden input
                        chatbot_ultra_avatar_iconInput.value = id;

                        // Save selected icon in local storage
                        localStorage.setItem('chatbot_ultra_avatar_icon', id);
                    }
                }

                // If no icon has been selected, select the first one by default
                var iconFromStorage = localStorage.getItem('chatbot_ultra_avatar_icon');
                var chatbot_ultra_avatar_iconInput = document.getElementById('chatbot_ultra_avatar_icon');
                if(chatbot_ultra_avatar_iconInput) {
                    if (iconFromStorage) {
                        window.selectIcon(iconFromStorage);
                    } else if (chatbot_ultra_avatar_iconInput.value === '') {
                        window.selectIcon('icon-001.png');
                    }
                }
            }
        </script>

        <h2 class="nav-tab-wrapper">
            <a href="?page=chatbot-ultra&tab=bot_settings" class="nav-tab <?php echo $active_tab == 'bot_settings' ? 'nav-tab-active' : ''; ?>">Settings</a>
            <a href="?page=chatbot-ultra&tab=api_model" class="nav-tab <?php echo $active_tab == 'api_model' ? 'nav-tab-active' : ''; ?>">API/Model</a>
            <a href="?page=chatbot-ultra&tab=gpt_assistants" class="nav-tab <?php echo $active_tab == 'gpt_assistants' ? 'nav-tab-active' : ''; ?>">GPT Assistants</a>
            <a href="?page=chatbot-ultra&tab=avatar" class="nav-tab <?php echo $active_tab == 'avatar' ? 'nav-tab-active' : ''; ?>">Avatars</a>
            <a href="?page=chatbot-ultra&tab=custom_buttons" class="nav-tab <?php echo $active_tab == 'custom_buttons' ? 'nav-tab-active' : ''; ?>">Buttons</a>
            <a href="?page=chatbot-ultra&tab=kn_acquire" class="nav-tab <?php echo $active_tab == 'kn_acquire' ? 'nav-tab-active' : ''; ?>">Knowledge Navigator</a>
            <a href="?page=chatbot-ultra&tab=kn_analysis" class="nav-tab <?php echo $active_tab == 'kn_analysis' ? 'nav-tab-active' : ''; ?>">Analysis</a>
            <a href="?page=chatbot-ultra&tab=reporting" class="nav-tab <?php echo $active_tab == 'reporting' ? 'nav-tab-active' : ''; ?>">Reporting</a>
            <a href="?page=chatbot-ultra&tab=diagnostics" class="nav-tab <?php echo $active_tab == 'diagnostics' ? 'nav-tab-active' : ''; ?>">Messages</a>
            <a href="?page=chatbot-ultra&tab=support" class="nav-tab <?php echo $active_tab == 'support' ? 'nav-tab-active' : ''; ?>">Support</a>
            <a href="?page=chatbot-ultra&tab=premium" class="nav-tab <?php echo $active_tab == 'premium' ? 'nav-tab-active' : ''; ?>">Premium</a>
        </h2>

        <form id="chatgpt-settings-form" action="options.php" method="post">
            <?php
            if ($active_tab == 'bot_settings') {
                settings_fields('chatbot_ultra_settings');
                do_settings_sections('chatbot_ultra_settings');

            } elseif ($active_tab == 'api_model') {
                settings_fields('chatbot_ultra_api_model');
                do_settings_sections('chatbot_ultra_api_model');

            } elseif ($active_tab == 'gpt_assistants') {
                settings_fields('chatbot_ultra_custom_gpts');
                do_settings_sections('chatbot_ultra_custom_gpts');

            } elseif ($active_tab == 'avatar') {
                settings_fields('chatbot_ultra_avatar');
                do_settings_sections('chatbot_ultra_avatar');

            } elseif ($active_tab == 'custom_buttons') {
                settings_fields('chatbot_ultra_custom_buttons');
                do_settings_sections('chatbot_ultra_custom_buttons');

            } elseif ($active_tab == 'kn_acquire') {
                settings_fields('chatbot_ultra_knowledge_navigator');
                do_settings_sections('chatbot_ultra_knowledge_navigator');

            } elseif ($active_tab == 'kn_analysis') {
                settings_fields('chatbot_ultra_kn_analysis');
                do_settings_sections('chatbot_ultra_kn_analysis');

            } elseif ($active_tab == 'reporting') {
                settings_fields('chatbot_ultra_reporting');
                do_settings_sections('chatbot_ultra_reporting');

            } elseif ($active_tab == 'diagnostics') {
                settings_fields('chatbot_ultra_diagnostics');
                do_settings_sections('chatbot_ultra_diagnostics');

            } elseif ($active_tab == 'premium') {
                settings_fields('chatbot_ultra_premium');
                do_settings_sections('chatbot_ultra_premium');

            } elseif ($active_tab == 'support') {
                settings_fields('chatbot_ultra_support');
                do_settings_sections('chatbot_ultra_support');            
        }

            submit_button('Save Settings');
            ?>
        </form>
    </div>
    </body>
    </html>
    <?php
}
