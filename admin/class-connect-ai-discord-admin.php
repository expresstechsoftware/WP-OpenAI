<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Connect_Ai_Discord
 * @subpackage Connect_Ai_Discord/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Connect_Ai_Discord
 * @subpackage Connect_Ai_Discord/admin
 * @author     ExpressTech Softwares Solutions Pvt Ltd <younesdro@gmail.com>
 */
class Connect_Ai_Discord_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Connect_Ai_Discord_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Connect_Ai_Discord_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/connect-ai-discord-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Connect_Ai_Discord_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Connect_Ai_Discord_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/connect-ai-discord-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function ets_ai_discord_menu() {
		add_menu_page( esc_html__( 'AI Discord', 'connect-ai-discord' ), esc_html__( ' AI Dis', 'connect-ai-discord' ), 'manage_options', 'connect-ai-discord', array( $this, 'display_ai_discord_page' ) );
	}

	public function display_ai_discord_page() {

		$ai_token = '';
		$discord_bot_token ='';
		$dm_channel_id ='';


		// Set the API endpoint URL
		$url = 'https://api.openai.com/v1/engines/davinci/completions';

		// Set the API request data
		$data = array(
			'prompt' => 'Write me an aticle about wordpress in 5 lines',
			'max_tokens' => 1024,
			'temperature' => 0.7,
			'n' => 1,
			'stop' => ['\n\n'],
		);

		// Set the API request headers
		$headers = array(
			'Content-Type' => 'application/json',
			'Authorization' => 'Bearer ' . $ai_token,
		);

		// Make the API request using wp_remote_post()
		$response = wp_remote_post(
			$url,
			array(
				'body' => wp_json_encode( $data ),
				'headers' => $headers,
			)
		);

		// Check for errors in the API response
		if ( is_wp_error( $response ) ) {
			// Handle error
			var_dump( $response);
		} else {
			// Decode the API response
			$response_data = json_decode($response['body'], true);

			// Get the completed text from the response
			$completed_text = $response_data['choices'][0]['text'];
			echo '<pre>';
			var_dump( $response_data);
			echo '<pre>';

			return;

			// Send the completed text to the Discord bot
			$creat_dm_url = 'https://discord.com/api/v10/channels/' . $dm_channel_id . '/messages';
			$dm_args = array(
				'method'  => 'POST',
				'headers' => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Bot ' . $discord_bot_token,
				),
				'body'    => json_encode(
					array(
						'content' => sanitize_text_field( trim( wp_unslash( $completed_text ) ) ),
					)
				),
			);
		}
		$dm_response = wp_remote_post( $creat_dm_url, $dm_args );
		

	
	
	
	}

}
