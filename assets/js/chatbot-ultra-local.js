jQuery(document).ready(function ($) {
    
    function chatbot_ultra_localize() {

        // Replaced with this statement - Ver 1.6.6 - 2023 11 10
        // FIXME - WORKING - Ver 1.6.6
        // let chatbotSettings = " . json_encode($chatbot_settings) . ";
    
        // console.log('Chatbot Ultra: NOTICE: Entering chatbot_ultra_localize');

        // Access the variables passed from PHP using the chatbotSettings object - Ver 1.4.1
        var chatbot_ultra_bot_name = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_bot_name) ? chatbotSettings.chatbot_ultra_bot_name : 'Chatbot Ultra';
        var chatbot_ultra_bot_prompt = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_bot_prompt) ? chatbotSettings.chatbot_ultra_bot_prompt : 'Enter your question ...';
        var chatbot_ultra_initial_greeting = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_initial_greeting) ? chatbotSettings.chatbot_ultra_initial_greeting : 'Hello! How can I help you today?';
        var chatbot_ultra_subsequent_greeting = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_subsequent_greeting) ? chatbotSettings.chatbot_ultra_subsequent_greeting : 'Hello again! How can I help you?';
        var chatbot_ultra_display_style = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_display_style) ? chatbotSettings.chatbot_ultra_display_style : 'floating';
        var chatbot_ultra_assistant_alias = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_assistant_alias) ? chatbotSettings.chatbot_ultra_assistant_alias : 'primary';
        var chatbot_ultra_start_status = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_start_status) ? chatbotSettings.chatbot_ultra_start_status : 'closed';
        var chatbot_ultra_start_status_new_visitor = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_start_status_new_visitor) ? chatbotSettings.chatbot_ultra_start_status_new_visitor : 'closed';
        var chatbot_ultra_disclaimer = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_disclaimer) ? chatbotSettings.chatbot_ultra_disclaimer : 'Yes';
        var chatbot_ultra_max_tokens = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_max_tokens) ? chatbotSettings.chatbot_ultra_max_tokens : '150';
        var chatbot_ultra_width = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_width) ? chatbotSettings.chatbot_ultra_width : 'Narrow';
        var chatbot_ultra_diagnotics = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_diagnotics) ? chatbotSettings.chatbot_ultra_diagnotics : 'Off';
        // Avatar Setting - Ver 1.5.0
        var chatbot_ultra_avatar_icon = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_avatar_icon) ? chatbotSettings.chatbot_ultra_avatar_icon : 'icon-001.png';
        var chatbot_ultra_avatar_icon_url = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_avatar_icon_url) ? chatbotSettings.chatbot_ultra_avatar_icon_url : 'icon-001.png';
        var chatbot_ultra_custom_avatar_icon = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_custom_avatar_icon) ? chatbotSettings.chatbot_ultra_custom_avatar_icon : 'icon-001.png';
        var chatbot_ultra_avatar_greeting = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_avatar_greeting) ? chatbotSettings.chatbot_ultra_avatar_greeting : 'Great to see you today! How can I help you?';
        // Custom Buttons - Ver 1.6.5
        var chatbot_ultra_enable_custom_buttons = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_enable_custom_buttons) ? chatbotSettings.chatbot_ultra_enable_custom_buttons : 'Off';
        var chatbot_ultra_custom_button_name_1 = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_custom_button_name_1) ? chatbotSettings.chatbot_ultra_custom_button_name_1 : '';
        var chatbot_ultra_custom_button_url_1 = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_custom_button_url_1) ? chatbotSettings.chatbot_ultra_custom_button_url_1 : '';
        var chatbot_ultra_custom_button_name_2 = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_custom_button_name_2) ? chatbotSettings.chatbot_ultra_custom_button_name_2 : '';
        var chatbot_ultra_custom_button_url_2 = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_custom_button_url_2) ? chatbotSettings.chatbot_ultra_custom_button_url_2 : '';
        // Allow file uploads - Ver 1.7.6
        var chatbot_ultra_allow_file_uploads = (typeof chatbotSettings !== 'undefined' && chatbotSettings.chatbot_ultra_allow_file_uploads) ? chatbotSettings.chatbot_ultra_allow_file_uploads : 'No';

        // THIS STATEMENT WAS ALREADY REMOVED - Ver 1.6.6 - 2023 11 10
        // FIXME - WORKING - Ver 1.6.6
        // let chatbotSettings = " . json_encode($chatbot_settings) . ";
    
        Object.keys(chatbotSettings).forEach((key) => {
            if(!localStorage.getItem(key)) {
                // DIAG - Log the key and value
                // console.log('Chatbot Ultra: NOTICE: Setting ' + key + ' in localStorage');
                localStorage.setItem(key, chatbotSettings[key]);
            } else {
                // DIAG - Log the key and value
                // console.log('Chatbot Ultra: NOTICE: ' key + ' is already set in localStorage');
            }
        });

        // Get the input elements
        var chatbot_ultra_bot_nameInput = document.getElementById('chatbot_ultra_bot_name');
        var chatbot_ultra_bot_promptInput = document.getElementById('chatbot_ultra_bot_prompt');
        var chatbot_ultra_initial_greetingInput = document.getElementById('chatbot_ultra_initial_greeting');
        var chatbot_ultra_subsequent_greetingInput = document.getElementById('chatbot_ultra_subsequent_greeting');
        var chatbot_ultra_display_styleInput = document.getElementById('chatbot_ultra_display_style');
        var chatbot_ultra_assistant_aliasInput = document.getElementById('chatbot_ultra_assistant_alias');
        var chatbot_ultra_start_statusInput = document.getElementById('chatbot_ultra_start_status');
        var chatbot_ultra_start_status_new_visitorInput = document.getElementById('chatbot_ultra_start_status_new_visitor');
        var chatbot_ultra_disclaimerInput = document.getElementById('chatbot_ultra_disclaimer');
        var chatbot_ultra_max_tokensInput = document.getElementById('chatbot_ultra_max_tokens');
        var chatbot_ultra_widthInput = document.getElementById('chatbot_ultra_width');
        var chatbot_ultra_diagnoticsInput = document.getElementById('chatbot_ultra_diagnostics');
        // Avatar Setting - Ver 1.5.0
        var chatbot_ultra_avatar_iconInput = document.getElementById('chatbot_ultra_avatar_icon');
        var chatbot_ultra_avatar_icon_urlInput = document.getElementById('chatbot_ultra_avatar_icon_url');
        var chatbot_ultra_custom_avatar_iconInput = document.getElementById('chatbot_ultra_custom_avatar_icon');
        var chatbot_ultra_avatar_greetingInput = document.getElementById('chatbot_ultra_avatar_greeting');
        var chatbot_ultra_enable_custom_buttonsInput = document.getElementById('chatbot_ultra_enable_custom_buttons');
        var chatbot_ultra_custom_button_name_1Input = document.getElementById('chatbot_ultra_custom_button_name_1');
        var chatbot_ultra_custom_button_url_1Input = document.getElementById('chatbot_ultra_custom_button_url_1');
        var chatbot_ultra_custom_button_name_2Input = document.getElementById('chatbot_ultra_custom_button_name_2');
        var chatbot_ultra_custom_button_url_2Input = document.getElementById('chatbot_ultra_custom_button_url_2');
        // Allow file uploads - Ver 1.7.6
        var chatbot_ultra_allow_file_uploadsInput = document.getElementById('chatbot_ultra_allow_file_uploads');

        if(chatbot_ultra_bot_nameInput) {
            chatbot_ultra_bot_nameInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_bot_name', this.value);
            });
        }

        if(chatbot_ultra_bot_promptInput) {
            chatbot_ultra_bot_promptInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_bot_prompt', this.value);
            });
        }

        if(chatbot_ultra_initial_greetingInput) {
            chatbot_ultra_initial_greetingInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_initial_greeting', this.value);
            });
        }

        if(chatbot_ultra_subsequent_greetingInput) {
            chatbot_ultra_subsequent_greetingInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_subsequent_greeting', this.value);
            });
        }

        if(chatbot_ultra_display_styleInput) {
            chatbot_ultra_display_styleInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_display_style', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_assistant_aliasInput) {
            chatbot_ultra_assistant_aliasInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_assistant_alias', this.options[this.selectedIndex].value);
            });
        }
        
        if(chatbot_ultra_start_statusInput) {
            chatbot_ultra_start_statusInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_start_status', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_start_status_new_visitorInput) {
            chatbot_ultra_start_status_new_visitorInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_start_status_new_visitor', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_disclaimerInput) {
            chatbot_ultra_disclaimerInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_disclaimer', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_avatar_iconInput) {
            chatbot_ultra_avatar_iconInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_avatar_icon', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_custom_avatar_iconInput) {
            chatbot_ultra_custom_avatar_iconInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_avatar_icon', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_avatar_icon_urlInput) {
            chatbot_ultra_avatar_icon_urlInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_avatar_icon_url', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_avatar_greetingInput) {
            chatbot_ultra_avatar_greetingInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_avatar_greeting', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_max_tokensInput) {
            chatbot_ultra_max_tokensInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_max_tokens', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_widthInput) {
            chatbot_ultra_widthInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_width', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_diagnoticsInput) {
            chatbot_ultra_diagnoticsInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_diagnostics', this.options[this.selectedIndex].value);
            });
        }

        if(chatbot_ultra_enable_custom_buttonsInput) {
            chatbot_ultra_enable_custom_buttonsInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_enable_custom_buttons', this.options[this.selectedIndex].value);
            });
        }
        
        if(chatbot_ultra_custom_button_name_1Input) {
            chatbot_ultra_custom_button_name_1Input.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_name_1', this.value);
            });
        }

        if(chatbot_ultra_custom_button_url_1Input) {
            chatbot_ultra_custom_button_url_1Input.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_url_1', this.value);
            });
        }

        if(chatbot_ultra_custom_button_name_2Input) {
            chatbot_ultra_custom_button_name_2Input.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_name_2', this.value);
            });
        }

        if(chatbot_ultra_custom_button_url_2Input) {
            chatbot_ultra_custom_button_url_2Input.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_url_2', this.value);
            });
        }

        if(chatbot_ultra_allow_file_uploadsInput) {
            chatbot_ultra_allow_file_uploadsInput.addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_allow_file_uploads', this.value);
            });
        }
        
        // Avatar Settings - Ver 1.5.0
        if(document.getElementById('chatbot_ultra_avatar_icon')) {
            document.getElementById('chatbot_ultra_avatar_icon').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_avatar_icon', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_custom_avatar_icon')) {
            document.getElementById('chatbot_ultra_custom_avatar_icon').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_avatar_icon', this.value);
            });
        }
        
        if(document.getElementById('chatbot_ultra_avatar_greeting')) {
            document.getElementById('chatbot_ultra_avatar_greeting').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_avatar_greeting', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_diagnostics')) {
            document.getElementById('chatbot_ultra_diagnostics').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_diagnostics', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_enable_custom_buttons')) {
            document.getElementById('chatbot_ultra_enable_custom_buttons').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_enable_custom_buttons', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_custom_button_name_1')) {
            document.getElementById('chatbot_ultra_custom_button_name_1').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_name_1', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_custom_button_url_1')) {
            document.getElementById('chatbot_ultra_custom_button_url_1').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_url_1', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_custom_button_name_2')) {
            document.getElementById('chatbot_ultra_custom_button_name_2').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_name_2', this.value);
            });
        }

        if(document.getElementById('chatbot_ultra_custom_button_url_2')) {
            document.getElementById('chatbot_ultra_custom_button_url_2').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_custom_button_url_2', this.value);
            });
        }

        // Allow file uploads - Ver 1.7.6
        if(document.getElementById('chatbot_ultra_allow_file_uploads')) {
            document.getElementById('chatbot_ultra_allow_file_uploads').addEventListener('change', function() {
                localStorage.setItem('chatbot_ultra_allow_file_uploads', this.value);
            });
        }

        // Update the localStorage values when the form is submitted - Ver 1.4.1
        // chatgpt-settings-form vs. your-form-id
        var chatgptSettingsForm = document.getElementById('chatgpt-settings-form');

        if (chatgptSettingsForm) {
            chatgptSettingsForm.addEventListener('submit', function(event) {

                event.preventDefault(); // Prevent form submission

                // Changed const to var - Ver 1.5.0
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
                // Avatar Settings - Ver 1.5.0
                var chatbot_ultra_avatar_iconInput = document.getElementById('chatbot_ultra_avatar_icon');
                var chatbot_ultra_custom_avatar_iconInput = document.getElementById('chatbot_ultra_custom_avatar_icon');
                var chatbot_ultra_avatar_greetingInput = document.getElementById('chatbot_ultra_avatar_greeting');
                // Custom Buttons - Ver 1.6.5
                var chatbot_ultra_enable_custom_buttonsInput = document.getElementById('chatbot_ultra_enable_custom_buttons');
                var chatbot_ultra_custom_button_name_1Input = document.getElementById('chatbot_ultra_custom_button_name_1');
                var chatbot_ultra_custom_button_url_1Input = document.getElementById('chatbot_ultra_custom_button_url_1');
                var chatbot_ultra_custom_button_name_2Input = document.getElementById('chatbot_ultra_custom_button_name_2');
                var chatbot_ultra_custom_button_url_2Input = document.getElementById('chatbot_ultra_custom_button_url_2');
                // Allow file uploads - Ver 1.7.6
                var chatbot_ultra_allow_file_uploadsInput = document.getElementById('chatbot_ultra_allow_file_uploads');

                if(chatbot_ultra_bot_nameInput) {
                    localStorage.setItem('chatbot_ultra_bot_name', chatbot_ultra_bot_nameInput.value);
                }

                if(chatbot_ultra_bot_promptInput) {
                    localStorage.setItem('chatbot_ultra_bot_prompt', chatbot_ultra_bot_promptInput.value);
                }

                if(chatbot_ultra_initial_greetingInput) {
                    localStorage.setItem('chatbot_ultra_initial_greeting', chatbot_ultra_initial_greetingInput.value);
                }

                if(chatbot_ultra_subsequent_greetingInput) {
                    localStorage.setItem('chatbot_ultra_subsequent_greeting', chatbot_ultra_subsequent_greetingInput.value);
                }

                if(chatbot_ultra_start_statusInput) {
                    localStorage.setItem('chatbot_ultra_start_status', chatbot_ultra_start_statusInput.value);
                }

                if(chatbot_ultra_start_status_new_visitorInput) {
                    localStorage.setItem('chatbot_ultra_start_status_new_visitor', chatbot_ultra_start_status_new_visitorInput.value);
                }

                if(chatbot_ultra_disclaimerInput) {
                    localStorage.setItem('chatbot_ultra_disclaimer', chatbot_ultra_disclaimerInput.value);
                }

                if(chatbot_ultra_max_tokensInput) {
                    localStorage.setItem('chatbot_ultra_max_tokens', chatbot_ultra_max_tokensInput.value);
                }

                if(chatbot_ultra_widthInput) {
                    localStorage.setItem('chatbot_ultra_width', chatbot_ultra_widthInput.value);
                }

                if(chatbot_ultra_diagnoticsInput) {
                    localStorage.setItem('chatbot_ultra_diagnostics', chatbot_ultra_diagnoticsInput.value)
                }

                // Avatar Settings - Ver 1.5.0
                if(chatbot_ultra_avatar_iconInput) {
                    localStorage.setItem('chatbot_ultra_avatar_icon', chatbot_ultra_avatar_iconInput.value);
                }

                // Avatar Settings - Ver 1.5.0
                if(chatbot_ultra_custom_avatar_iconInput) {
                    localStorage.setItem('chatbot_ultra_custom_avatar_icon', chatbot_ultra_custom_avatar_iconInput.value);
                }
                
                // Avatar Settings - Ver 1.5.0
                if(chatbot_ultra_avatar_greetingInput) {
                    localStorage.setItem('chatbot_ultra_avatar_greeting', chatbot_ultra_avatar_greetingInput.value);
                }

                // Custom Buttons
                if(chatbot_ultra_enable_custom_buttonsInput) {
                    localStorage.setItem('chatbot_ultra_enable_custom_buttons', chatbot_ultra_enable_custom_buttonsInput.value);
                }

                if(chatbot_ultra_custom_button_name_1Input) {
                    localStorage.setItem('chatbot_ultra_custom_button_name_1', chatbot_ultra_custom_button_name_1Input.value);
                }

                if(chatbot_ultra_custom_button_url_1Input) {
                    localStorage.setItem('chatbot_ultra_custom_button_url_1', chatbot_ultra_custom_button_url_1Input.value);
                }

                if(chatbot_ultra_custom_button_name_2Input) {
                    localStorage.setItem('chatbot_ultra_custom_button_name_2', chatbot_ultra_custom_button_name_2Input.value);
                }

                if(chatbot_ultra_custom_button_url_2Input) {
                    localStorage.setItem('chatbot_ultra_custom_button_url_2', chatbot_ultra_custom_button_url_2Input.value);
                }

                // Allow file uploads - Ver 1.7.6
                if(chatbot_ultra_allow_file_uploadsInput) {
                    localStorage.setItem('chatbot_ultra_allow_file_uploads', chatbot_ultra_allow_file_uploadsInput.value);
                }

            });
        }

        // DIAG - Log exiting the function
        // console.log('Chatbot Ultra: NOTICE: Exiting chatbot_ultra_localize');
        
    }

    chatbot_ultra_localize();

});
