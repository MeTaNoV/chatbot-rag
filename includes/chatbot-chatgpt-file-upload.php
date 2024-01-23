<?php
/**
 * Chatbot Ultra for WordPress - File Uploads - Ver 1.7.6
 *
 * This file contains the code for uploading files as part
 * in support of Custom GPT Assistants via the Chatbot Ultra.
 *
 * @package chatbot-ultra
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Upload Files to the Assistant
function chatbot_ultra_upload_file_to_assistant() {

    // DIAG - Diagnostic - Ver 1.7.6
    // chatbot_ultra_back_trace( 'NOTICE', "Entering chatbot_ultra_upload_file_to_assistant()" );

    $upload_dir = WP_CONTENT_DIR . '/plugins/chatbot-ultra/uploads/';
    $file_path = $upload_dir . basename($_FILES['file']['name']);

    // DIAG - Diagnostic - Ver 1.7.6
    // chatbot_ultra_back_trace( 'NOTICE', $upload_dir );
    // chatbot_ultra_back_trace( 'NOTICE', $file_path );

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Check if there was an error during the file upload
    if ($_FILES['file']['error'] > 0) {
        chatbot_ultra_back_trace('ERROR', "Error during file upload: " . $_FILES['file']['error']);
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
            // File is successfully uploaded
            // Diagnostic - Ver 1.7.6
            // chatbot_ultra_back_trace( 'SUCCESS', "File is successfully uploaded" );
        } else {
            // Handle error
            // Diagnostic - Ver 1.7.6
            chatbot_ultra_back_trace( 'ERROR', "Error uploading file" );
        }
    }

    // Get the API key
    $api_key = esc_attr(get_option('chatbot_ultra_api_key'));
    if (empty($api_key)) {
        // If the API key is empty, then return an error
        $response = array(
            'status' => 'error',
            'message' => 'API key is missing. Please enter your API key in the Chatbot Ultra settings.'
        );
        return $response;
    }

    // Check if the file is empty or there is an error
    if (empty($file_path) || $_FILES['file']['error']) {
        // If the file is empty or there is an error, then return an error
        $response = array(
            'status' => 'error',
            'message' => 'Please select a file to upload.'
        );
        return $response;
    }

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/files');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $api_key
    ));

    // Add the file to upload and the purpose
    // One of answers, classifications, serach, converations, or fine-tune
    $postFields = array(
        'file' => new CURLFile($file_path),
        'purpose' => 'assistants'
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    // Execute the cURL session
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

    // Check for cURL error before closing the session
    if (curl_errno($ch)) {
        // Retrieve the error message before closing the cURL handle
        $errorMessage = 'Error:' . curl_error($ch);
        // DIAG - Diagnostic - Ver 1.7.6
        chatbot_ultra_back_trace( 'ERROR', $errorMessage );
        curl_close($ch); // Make sure to close the cURL session after getting the error message
        return array(
            'status' => 'error',
            'http_status' => $http_status,
            'message' => $errorMessage
        );
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    // Check the decoded response and http status here
    if ($http_status != 200 || isset($responseData['error'])) {
        $errorMessage = $responseData['error']['message'] ?? 'Unknown error occurred.';
        // DIAG - Diagnostic - Ver 1.7.6
        chatbot_ultra_back_trace( 'ERROR', $errorMessage );
        return array(
            'status' => 'error',
            'http_status' => $http_status,
            'message' => $errorMessage
        );
    } else {
        // DAIG - Diagnostic - Ver 1.7.6
        // chatbot_ultra_back_trace( 'SUCCESS', "File uploaded successfully." );
        // DIAG - Diagnostic - Ver 1.7.6
        // chatbot_ultra_back_trace( 'SUCCESS', 'file_id ' . $responseData['id'] );
        // Set the transient for the file id
        set_chatbot_ultra_transients('file_id', $responseData['id']);
        return array(
            'status' => 'success',
            'http_status' => $http_status,
            'file_id' => $responseData['id'],
            'message' => 'File uploaded successfully.'
        );
    }

    // DIAG - Diagnostic - Ver 1.7.6
    // chatbot_ultra_back_trace( 'NOTICE', "Exiting chatbot_ultra_upload_file_to_assistant()" );

    return;

}
