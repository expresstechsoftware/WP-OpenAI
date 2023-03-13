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

		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/connect-ai-discord-admin.css', array(), $this->version, 'all' );

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

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/connect-ai-discord-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function ets_ai_discord_menu() {
		add_menu_page( esc_html__( 'WP OpenAI', 'connect-ai-discord' ), esc_html__( 'WP-OpenAI', 'connect-ai-discord' ), 'manage_options', 'connect-ai-discord', array( $this, 'display_ai_discord_page' ) );
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function display_ai_discord_page() {

		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_script( $this->plugin_name );

	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function ets_settings_sub_menu() {
		add_submenu_page( 'connect-ai-discord', esc_html__( 'Settings', 'connect-ai-discord' ), esc_html__( 'Settings', 'connect-ai-discord' ), 'manage_options', 'ai-settings', array( $this, 'display_settings_page' ) );
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function display_settings_page() {
		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_script( $this->plugin_name );
		require_once plugin_dir_path( __FILE__ ) . '/partials/pages/settings.php';
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function save_settings(){

		if ( ! current_user_can( 'administrator' ) ) {
			wp_send_json_error( 'You do not have sufficient rights 1', 403 );
			exit();
		}

		if ( ! wp_verify_nonce( $_POST['ets-wp-openai-settings-nonce'], 'ets_wp_openai_settings_nonce' ) ) {
			wp_send_json_error( 'You do not have sufficient rights 2', 403 );
			exit();

		}
		$api_keys = sanitize_text_field( $_POST['api_keys'] );
		$end_point = sanitize_text_field( $_POST['endpoint_url'] );
		$model_engine = sanitize_text_field( $_POST['model_engine'] );
		$current_url = sanitize_text_field( $_POST['current_url'] );


		if ( isset( $_POST['action'] ) && $_POST['action'] == 'ets_wp_openai_save_settings' ) {
	
			if ( isset( $api_keys ) ) {
				update_option( 'ets_wp_openai_api_keys' , $api_keys );
			}

			if( isset( $end_point ) ) {
				update_option( 'ets_wp_openai_end_point' , $end_point );
			}

			if( isset( $model_engine ) ) {
				update_option( 'ets_wp_openai_model_engine' , $model_engine );
			}			

			$message = esc_html__( 'Settings are saved', 'connect-ai-discord' );

			wp_safe_redirect( $current_url . '&ets_settings_saved=' . $message );

		}

	}

}
