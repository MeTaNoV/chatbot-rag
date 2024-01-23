jQuery(document).ready(function ($) {

    // DIAG - Diagnostics = Ver 1.4.2
    // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
    //     console.log('Chatbot Ultra: NOTICE: Entering chatbot-ultra.js');
    // }

    var chatbotUltra = $('#chatbot-ultra').hide();

    messageInput = $('#chatbot-ultra-message');

    var chatbotUltraConversation = $('#chatbot-ultra-conversation');

    submitButton = $('#chatbot-ultra-submit-btn');
    uploadfileButton = $('#chatbot-ultra-upload-file-btn');
    openButton = $('#chatbot-ultra-open-btn');

    chatbot_ultra_start_status = localStorage.getItem('chatbot_ultra_start_status') || 'closed';
    chatbot_ultra_start_status_new_visitor = localStorage.getItem('chatbot_ultra_start_status_new_visitor') || 'closed';
    chatbot_ultra_initial_greeting = localStorage.getItem('chatbot_ultra_initial_greeting') || 'Hello! How can I help you today?';
    chatbot_ultra_subsequent_greeting = localStorage.getItem('chatbot_ultra_subsequent_greeting') || 'Hello again! How can I help you?';
    chatbot_ultra_disclaimer = localStorage.getItem('chatbot_ultra_disclaimer') || 'Yes';
    chatbot_ultra_bot_prompt = localStorage.getItem('chatbot_ultra_bot_prompt') || 'Enter your question ...';
    chatbot_ultra_width = localStorage.getItem('chatbot_ultra_width') || 'Narrow';

    localStorage.setItem('chatbot_ultra_start_status', chatbot_ultra_start_status);
    localStorage.setItem('chatbot_ultra_start_status_new_visitor', chatbot_ultra_start_status_new_visitor);
    localStorage.setItem('chatbot_ultra_initial_greeting', chatbot_ultra_initial_greeting);
    localStorage.setItem('chatbot_ultra_subsequent_greeting', chatbot_ultra_subsequent_greeting);
    localStorage.setItem('chatbot_ultra_disclaimer', chatbot_ultra_disclaimer);
    localStorage.setItem('chatbot_ultra_bot_prompt', chatbot_ultra_bot_prompt);
    localStorage.setItem('chatbot_ultra_width', chatbot_ultra_width);

    pluginUrl = plugin_vars.pluginUrl;

    // Determine the shortcode styling where default is 'floating' or 'embedded' - Ver 1.7.1
    chatbot_ultra_display_style = localStorage.getItem('chatbot_ultra_display_style') || 'floating';
    chatbot_ultra_assistant_alias = localStorage.getItem('chatbot_ultra_assistant_alias') || 'original';

    // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
    // console.log('Chatbot Ultra: NOTICE: chatbot_ultra_display_style: ' + chatbot_ultra_display_style);
    // console.log('Chatbot Ultra: NOTICE: chatbot_ultra_assistant_alias: ' + chatbot_ultra_assistant_alias);
    // }

    // Determine the shortcode styling where default is 'floating' or 'embedded' - Ver 1.7.1
    // var site-header = document.querySelector("#site-header");
    // var site-footer = document.querySelector("#site-footer");

    // if(header && footer) {
    //     var headerBottom = site-header.getBoundingClientRect().bottom;
    //     var footerTop = site-footer.getBoundingClientRect().top;

    //     var visible-distance = footerTop - headerBottom;
    //     console.log('Chatbot Ultra: NOTICE: Distance:  + distance + 'px');
    // }

    if (chatbot_ultra_display_style === 'embedded') {
        // Apply configurations for embedded style
        $('#chatbot-ultra').addClass('embedded-style').removeClass('floating-style');
        // Other configurations specific to embedded style
        chatbot_ultra_start_status = 'open'; // Force the chatbot to open if embedded
        chatbot_ultra_start_status_new_visitor = 'open'; // Force the chatbot to open if embedded
        localStorage.setItem('chatbot_ultra_start_status', chatbot_ultra_start_status);
        localStorage.setItem('chatbot_ultra_start_status_new_visitor', chatbot_ultra_start_status_new_visitor);
        chatbotUltra.addClass('embedded-style').removeClass('floating-style');
    } else {
        // Apply configurations for floating style
        $('#chatbot-ultra').addClass('floating-style').removeClass('embedded-style');
        // Other configurations specific to floating style
        if (chatbot_ultra_width === 'Wide') {
            chatbotUltra.addClass('wide');
        } else {
            // chatbotUltra.removeClass('wide').css('display', 'none');
            chatbotUltra.removeClass('wide');
        }
    }

    // Removed css from here into the .css file - Refactored for Ver 1.7.3
    // Initially hide the chatbot
    if (chatbot_ultra_start_status === 'closed') {
        chatbotUltra.hide();
        openButton.show();
    } else {
        if (chatbot_ultra_display_style === 'floating') {
            if (chatbot_ultra_width === 'Wide') {
                $('#chatbot-ultra').removeClass('chatbot-narrow chatbot-full').addClass('chatbot-wide');
            } else {
                $('#chatbot-ultra').removeClass('chatbot-wide chatbot-full').addClass('chatbot-narrow');
            }
            chatbotUltra.show();
            openButton.hide();
        } else {
            $('#chatbot-ultra').removeClass('chatbot-wide chatbot-narrow').addClass('chatbot-full');
        }
    }

    chatbotContainer = $('<div></div>').addClass('chatbot-container');
    chatbotCollapseBtn = $('<button></button>').addClass('chatbot-collapse-btn').addClass('dashicons dashicons-format-chat'); // Add a collapse button
    chatbotCollapsed = $('<div></div>').addClass('chatbot-collapsed'); // Add a collapsed chatbot icon dashicons-format-chat f125

    // Avatar and Custom Message - Ver 1.5.0
    selectedAvatar = localStorage.getItem('chatbot_ultra_avatar_icon');

    if (selectedAvatar && selectedAvatar !== 'icon-000.png') {
        // Construct the path to the avatar
        avatarPath = pluginUrl + '/assets/icons/' + selectedAvatar;

        // If an avatar is selected and it's not 'icon-000.png', use the avatar
        avatarImg = $('<img>').attr('id', 'chatbot_ultra_avatar_icon').attr('class', 'chatbot-avatar').attr('src', avatarPath);

        // Get the stored greeting message. If it's not set, default to a custom value.
        chatbot_ultra_avatar_greeting = localStorage.getItem('chatbot_ultra_avatar_greeting') || 'Howdy!!! Great to see you today! How can I help you?';

        // Revised to address cross-site scripting - Ver 1.6.4
        // // Create a bubble with the greeting message
        // var bubble = $('<div>').text(avatarGreeting).addClass('chatbot-bubble');

        // // Append the avatar and the bubble to the button and apply the class for the avatar icon
        // openButton.empty().append(avatarImg, bubble).addClass('avatar-icon');

        // IDEA - Add option to suppress avatar greeting in setting options page
        // IDEA - If blank greeting, don't show the bubble
        // IDEA - Add option to suppress avatar greeting if clicked on

        // Sanitize the chatbot_ultra_avatar_greeting variable
        sanitizedGreeting = $('<div>').text(chatbot_ultra_avatar_greeting).html();

        // Create a bubble with the sanitized greeting message
        bubble = $('<div>').html(sanitizedGreeting).addClass('chatbot-bubble');

        // Append the avatar and the bubble to the button and apply the class for the avatar icon
        openButton.empty().append(avatarImg, bubble).addClass('avatar-icon');

    } else {
        // If no avatar is selected or the selected avatar is 'icon-000.png', use the dashicon
        // Remove the avatar-icon class (if it was previously added) and add the dashicon class
        openButton.empty().removeClass('avatar-icon').addClass('dashicons dashicons-format-chat dashicon');
    }

    // Append the collapse button and collapsed chatbot icon to the chatbot container
    $('#chatbot-ultra-header').append(chatbotCollapseBtn);
    chatbotContainer.append(chatbotCollapsed);

    // Add initial greeting to the chatbot
    chatbotUltraConversation.append(chatbotContainer);

    function initializeChatbot() {

        isFirstTime = !localStorage.getItem('chatbot_ultra_opened') || false;

        // Remove any legacy conversations that might be store in local storage for increased privacy - Ver 1.4.2
        localStorage.removeItem('chatbot_ultra_conversation');

        if (isFirstTime) {
            // DIAG - Logging for Diagnostics
            // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
            //     console.log('Chatbot Ultra: NOTICE: initializeChatbot at isFirstTime');
            // }
            chatbot_ultra_initial_greeting = localStorage.getItem('chatbot_ultra_initial_greeting') || 'Hello! How can I help you today?';

            // Don't append the greeting if it's already in the conversation
            if (chatbotUltraConversation.text().includes(chatbot_ultra_initial_greeting)) {
                return;
            }

            lastMessage = chatbotUltraConversation.children().last().text();

            // Don't append the subseqent greeting if it's already in the converation - Ver 1.5.0
            if (lastMessage === chatbot_ultra_subsequent_greeting) {
                return;
            }

            appendMessage(chatbot_ultra_initial_greeting, 'bot', 'chatbot_ultra_initial_greeting');
            localStorage.setItem('chatbot_ultra_opened', 'true');
            // Save the conversation after the initial greeting is appended - Ver 1.2.0
            sessionStorage.setItem('chatbot_ultra_conversation', chatbotUltraConversation.html());

        } else {
            // DIAG - Logging for Diagnostics - Ver 1.4.2
            // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
            //     console.log('Chatbot Ultra: NOTICE: initializeChatbot at else');
            // }
            chatbot_ultra_subsequent_greeting = localStorage.getItem('chatbot_ultra_subsequent_greeting') || 'Hello again! How can I help you?';

            // Don't append the greeting if it's already in the conversation
            if (chatbotUltraConversation.text().includes(chatbot_ultra_subsequent_greeting)) {
                return;
            }

            appendMessage(chatbot_ultra_subsequent_greeting, 'bot', 'chatbot_ultra_subsequent_greeting');
            localStorage.setItem('chatbot_ultra_opened', 'true');
            // Save the conversation after the subsequent greeting is appended - Ver 1.2.0
            sessionStorage.setItem('chatbot_ultra_conversation', chatbotUltraConversation.html());
        }

        return;

    }

    if (chatbot_ultra_display_style === 'floating') {

        // Add chatbot header, body, and other elements
        chatbotHeader = $('<div></div>').addClass('chatbot-header');
        chatbotUltra.append(chatbotHeader);

        // Add the chatbot button to the header
        $('#chatbot-ultra-header').append(chatbotCollapseBtn);
        chatbotHeader.append(chatbotCollapsed);

        // Attach the click event listeners for the collapse button and collapsed chatbot icon
        chatbotCollapseBtn.on('click', toggleChatbot);
        chatbotCollapsed.on('click', toggleChatbot);
        openButton.on('click', toggleChatbot);

    } else {

        // Embedded style - Do not add the collapse button and collapsed chatbot icon
        chatbotHeader = $('<div></div>');

    }

    function appendMessage(message, sender, cssClass) {

        messageElement = $('<div></div>').addClass('chat-message');
        // Use HTML for the response so that links are clickable - Ver 1.6.3
        textElement = $('<span></span>').html(message);

        // Add initial greetings if first time
        if (cssClass) {
            textElement.addClass(cssClass);
        }

        if (sender === 'user') {
            messageElement.addClass('user-message');
            textElement.addClass('user-text');
        } else if (sender === 'bot') {
            messageElement.addClass('bot-message');
            textElement.addClass('bot-text');
        } else {
            messageElement.addClass('error-message');
            textElement.addClass('error-text');
        }

        messageElement.append(textElement);
        chatbotUltraConversation.append(messageElement);

        // Add space between user input and bot response
        if (sender === 'user' || sender === 'bot') {
            spaceElement = $('<div></div>').addClass('message-space');
            chatbotUltraConversation.append(spaceElement);
        }

        // Ver 1.2.4
        chatbotUltraConversation[0].scrollTop = chatbotUltraConversation[0].scrollHeight;
        // Scroll to bottom if embedded - Ver 1.7.1
        // window.scrollTo(0, document.body.scrollHeight);

        // Save the conversation locally between bot sessions - Ver 1.2.0
        sessionStorage.setItem('chatbot_ultra_conversation', chatbotUltraConversation.html());

    }

    function showTypingIndicator() {
        typingIndicator = $('<div></div>').addClass('typing-indicator');
        dot1 = $('<span>.</span>').addClass('typing-dot');
        dot2 = $('<span>.</span>').addClass('typing-dot');
        dot3 = $('<span>.</span>').addClass('typing-dot');

        typingIndicator.append(dot1, dot2, dot3);
        chatbotUltraConversation.append(typingIndicator);
        chatbotUltraConversation.scrollTop(chatbotUltraConversation[0].scrollHeight);
    }

    function removeTypingIndicator() {
        $('.typing-indicator').remove();
    }

    submitButton.on('click', function () {
        message = messageInput.val().trim();

        if (!message) {
            return;
        }

        messageInput.val('');
        appendMessage(message, 'user');

        var user_id = php_vars.user_id;
        var page_id = php_vars.page_id;

        $.ajax({
            url: chatbot_ultra_params.ajax_url,
            method: 'POST',
            data: {
                action: 'chatbot_ultra_send_message',
                message: message,
                user_id: user_id, // pass the user ID here
                page_id: page_id, // pass the page ID here
            },
            beforeSend: function () {
                showTypingIndicator();
                submitButton.prop('disabled', true);
            },
            success: function (response) {
                removeTypingIndicator();
                // console.log('Chatbot Ultra: SUCCESS: ' + JSON.stringify(response));
                if (response.success) {
                    botResponse = response.data;
                    // Revision to how disclaimers are handled - Ver 1.5.0
                    if (localStorage.getItem('chatbot_ultra_disclaimer') === 'No') {
                        const prefixes = [
                            "As an AI, ",
                            "As an AI language model, ",
                            "I am an AI language model and ",
                            "As an artificial intelligence, ",
                            "As an AI developed by OpenAI, ",
                            "As an artificial intelligence developed by OpenAI, "
                        ];
                        for (let prefix of prefixes) {
                            if (botResponse.startsWith(prefix)) {
                                botResponse = botResponse.slice(prefix.length);
                                break;
                            }
                        }
                    }
                    // IDEA Check for a URL
                    if (botResponse.includes('[URL: ')) {
                        // DIAG - Diagnostics - Ver 1.6.3
                        // console.log('Chatbot Ultra: ERROR: URL found in bot response");
                        link = '';
                        urlRegex = /\[URL: (.*?)\]/g;
                        match = botResponse.match(urlRegex);
                        if (match && match.length > 0) {
                            link = match[0].replace(/\[URL: /, '').replace(/\]/g, '');
                            // DAIG - Diagnostics - Ver 1.6.3
                            // console.log('Chatbot Ultra: NOTICE: link: ' + link);
                        }

                        linkElement = document.createElement('a');
                        linkElement.href = link;
                        linkElement.textContent = 'here';
                        text = botResponse.replace(urlRegex, '');
                        textElement = document.createElement('span');
                        textElement.textContent = text;
                        botResponse = document.createElement('div');
                        botResponse.appendChild(textElement);
                        botResponse.appendChild(linkElement);
                        botResponse.innerHTML += '.';
                        botResponse = botResponse.outerHTML;
                    }

                    // Check for double asterisks suggesting a "bold" response
                    // Check for linefeeds suggesting paragraphs response
                    botResponse = botResponse.replace(/\n/g, "<br>");
                    botResponse = botResponse.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>");

                    // Return the response
                    appendMessage(botResponse, 'bot');
                } else {
                    appendMessage('Error: ' + response.data, 'error');
                }
            },
            error: function () {
                removeTypingIndicator();
                // DIAG - Log the error - Ver 1.6.7
                // console.log('Chatbot Ultra: ERROR: response: ' + response);
                // console.log('Chatbot Ultra: ERROR: Unable to send message');
                appendMessage('Oops! Something went wrong on our end. Please try again later.', 'error');
            },
            complete: function () {
                removeTypingIndicator();
                submitButton.prop('disabled', false);
            },
        });
    });

    // Add the keydown event listener to the message input - Ver 1.7.6
    messageInput.on('keydown', function (e) {
        if (e.keyCode === 13 && !e.shiftKey) {
            e.preventDefault();
            submitButton.trigger('click');
        }
    });

    // Add the keydown event listerner to the upload file button - Ver 1.7.6
    $('#chatbot-ultra-upload-file-btn').on('keydown', function (e) {
        if (e.keyCode === 13 && !e.shiftKey) {
            e.preventDefault();
            // console.log('Chatbot Ultra: NOTICE: Enter key pressed on upload file button');
            $response = chatbot_ultra_upload_file_to_assistant();
            $('#chatbot-ultra-upload-file-input').click();
        }
    });

    // Add the change event listener to the file input field
    $('#chatbot-ultra-upload-file-input').on('change', function (e) {
        // console.log('Chatbot Ultra: NOTICE: File selected');

        showTypingIndicator();

        var fileField = e.target;

        // Check if a file is selected
        if (!fileField.files.length) {
            // console.log('Chatbot Ultra: WARNING: No file selected');
            return;
        }

        var formData = new FormData();
        formData.append('file', fileField.files[0]);
        // console.log('Chatbot Ultra: NOTICE: File selected ', fileField.files[0]);
        formData.append('action', 'chatbot_ultra_upload_file_to_assistant');

        $.ajax({
            url: chatbot_ultra_params.ajax_url,
            method: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (response) {
                // console.log('Chatbot Ultra: NOTICE: Response from server', response);
                $('#chatbot-ultra-upload-file-input').val('');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // console.log('AJAX error:', textStatus, errorThrown);
            }
        });

        removeTypingIndicator();

        appendMessage('File uploaded.', 'bot');

    });

    // Moved the css to the .css file - Refactored for Ver 1.7.3
    // Add the toggleChatbot() function - Ver 1.1.0
    function toggleChatbot() {
        if (chatbotUltra.is(':visible')) {
            chatbotUltra.hide();
            openButton.show();
            localStorage.setItem('chatbot_ultra_start_status', 'closed');
        } else {
            if (chatbot_ultra_display_style === 'floating') {
                if (chatbot_ultra_width === 'Wide') {
                    $('#chatbot-ultra').removeClass('chatbot-narrow chatbot-full').addClass('chatbot-wide');
                } else {
                    $('#chatbot-ultra').removeClass('chatbot-wide chatbot-full').addClass('chatbot-narrow');
                }
                chatbotUltra.show();
                openButton.hide();
            } else {
                $('#chatbot-ultra').removeClass('chatbot-wide chatbot-narrow').addClass('chatbot-full');
            }
            chatbotUltra.show();
            openButton.hide();
            localStorage.setItem('chatbot_ultra_start_status', 'open');
            loadConversation();
            scrollToBottom();
        }
    }

    // Add this function to maintain the chatbot status across page refreshes and sessions - Ver 1.1.0 and updated for Ver 1.4.1
    function loadChatbotStatus() {
        chatbot_ultra_start_status = localStorage.getItem('chatbot_ultra_start_status');
        chatbot_ultra_start_status_new_visitor = localStorage.getItem('chatbot_ultra_start_status_new_visitor');

        // Nuclear option to clear session conversation - Ver 1.5.0
        // Do not use unless alsolutely needed
        // DIAG - Diagnostics - Ver 1.5.0
        // nuclearOption = 'Off';
        // if (nuclearOption === 'On') {
        //     console.log('Chatbot Ultra: NOTICE: ***** NUCLEAR OPTION IS ON ***** ');
        //     sessionStorage.removeItem('chatbot_ultra_conversation');
        //     // Removed in Ver 1.6.1
        //     sessionStorage.removeItem('chatgpt_last_response');
        // }

        // DIAG - Diagnostics - Ver 1.5.0
        // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
        //     console.log('Chatbot Ultra: NOTICE: loadChatbotStatus - BEFORE DECISION');
        // }

        // Decide what to do for a new visitor - Ver 1.5.0
        if (chatbotSettings.chatbot_ultra_start_status_new_visitor === 'open') {
            if (chatbot_ultra_start_status_new_visitor === null) {
                // Override initial status
                chatbot_ultra_start_status = 'open';
                chatbot_ultra_start_status_new_visitor = 'closed';
                localStorage.setItem('chatbot_ultra_start_status_new_visitor', 'closed');
            } else {
                // Override initial status
                chatbot_ultra_start_status_new_visitor = 'closed';
                localStorage.setItem('chatbot_ultra_start_status_new_visitor', 'closed');
            }
        }

        // DIAG - Diagnostics - Ver 1.5.0
        // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
        //     console.log('Chatbot Ultra: NOTICE: loadChatbotStatus - AFTER DECISION');
        // }

        // If the chatbot status is not set in local storage, use chatbot_ultra_start_status - Ver 1.5.1
        if (chatbot_ultra_start_status === 'closed') {
            chatbotUltra.hide();
            openButton.show();
        } else {
            chatbotUltra.show();
            openButton.hide();
            // Load the conversation if the chatbot is open on page load
            loadConversation();
            scrollToBottom();
        }

    }

    // Add this function to scroll to the bottom of the conversation - Ver 1.2.1
    function scrollToBottom() {
        setTimeout(() => {
            // DIAG - Diagnostics - Ver 1.5.0
            // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
            //     console.log('Chatbot Ultra: NOTICE: scrollToBottom");
            // }
            chatbotUltraConversation.scrollTop(chatbotUltraConversation[0].scrollHeight);
        }, 100);  // delay of 100 milliseconds  

    }

    // Load conversation from local storage if available - Ver 1.2.0
    function loadConversation() {
        storedConversation = sessionStorage.getItem('chatbot_ultra_conversation');
        localStorage.setItem('chatbot_ultra_start_status_new_visitor', 'closed');

        // DIAG - Diagnostics - Ver 1.5.0
        // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
        //     console.log('Chatbot Ultra: NOTICE: loadConversation');
        // }

        if (storedConversation) {
            // DIAG - Diagnostics - Ver 1.5.0
            // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
            //     console.log('Chatbot Ultra: NOTICE: loadConversation - IN THE IF STATEMENT');
            // }

            // Check if current conversation is different from stored conversation
            if (chatbotUltraConversation.html() !== storedConversation) {
                chatbotUltraConversation.html(storedConversation);  // Set the conversation HTML to stored conversation
            }

            // Use setTimeout to ensure scrollToBottom is called after the conversation is rendered
            setTimeout(scrollToBottom, 0);
        } else {
            // DIAG - Diagnostics - Ver 1.5.0
            // if (chatbotSettings.chatbot_ultra_diagnostics === 'On') {
            //     console.log('Chatbot Ultra: NOTICE: loadConversation - IN THE ELSE STATEMENT');
            // }
            initializeChatbot();
        }

    }

    // Call the loadChatbotStatus function here - Ver 1.1.0
    loadChatbotStatus();

    // Load the conversation when the chatbot is shown on page load - Ver 1.2.0
    // Let the convesation stay persistent in session storage for increased privacy - Ver 1.4.2
    // loadConversation();

});