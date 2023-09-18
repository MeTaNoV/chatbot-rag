<?php
/**
 * Chatbot ChatGPT for WordPress - TF-IDF Analyzer
 *
 * This file contains the code for the Chatbot ChatGPT settings page.
 * 
 * 
 *
 * @package chatbot-chatgpt
 */

 // TODO If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
die;

// Knowledge Navigator Analysis section callback - Ver 1.6.2
function chatbot_chatgpt_kn_analysis_section_callback($args) {
    ?>
    <p>Use the 'Download Data' button to retrieve the Knowledge Navigator results.</p>
    <?php
    if (is_admin()) {
        $header = " ";
        $header .= '<a class="button button-primary" href="' . esc_url(admin_url('admin-post.php?action=chatbot_chatgpt_kn_analysis_download_csv')) . '">Download Data</a>';
        echo $header;
    }
}


// Knowledge Navigator Analysis section callback - Ver 1.6.2
function chatbot_chatgpt_kn_analysis_output_callback($args) {
    // Get the saved chatbot_chatgpt_kn_analysis_choice value or default to "CSV"
    $output_choice = esc_attr(get_option('chatbot_chatgpt_kn_analysis_output', 'CSV'));
    // error_log('chatbot_chatgpt_kn_analysis_output' . $output_choice);
    ?>
    <select id="chatbot_chatgpt_kn_analysis_output" name="chatbot_chatgpt_kn_analysis_output">
        <option value="<?php echo esc_attr( 'CSV' ); ?>" <?php selected( $output_choice, 'CSV' ); ?>><?php echo esc_html( 'CSV' ); ?></option>
    </select>
    <?php
}


// Download the TF-IDF data
function chatbot_chatgpt_kn_analysis_download_csv() {
    // Generate the results directory path
    $results_dir_path = dirname(plugin_dir_path(__FILE__)) . '/results/';

    // Specify the output file's path
    $results_csv_file = $results_dir_path . 'results.csv';

    // Exit early if the file doesn't exist
    if (!file_exists($results_csv_file)) {
        wp_die('File not found!');
    }

    // Read the file
    $csv_data = file_get_contents($results_csv_file);

    // Exit early if reading fails
    if ($csv_data === false) {
        wp_die('Error reading file.');
    }

    // Deliver the file for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=Knowledge Navigator Results.csv');
    echo $csv_data;
    exit;
}
add_action('admin_post_chatbot_chatgpt_kn_analysis_download_csv', 'chatbot_chatgpt_kn_analysis_download_csv');
