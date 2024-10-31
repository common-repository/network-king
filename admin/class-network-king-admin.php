<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sabrinazeidan.com/
 * @since      1.0.0
 *
 * @package    Network_King
 * @subpackage Network_King/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Network_King
 * @subpackage Network_King/admin
 * @author     Sabrina Zeidan <sabrinazeidan@gmail.com>
 */
class Network_King_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		require_once plugin_dir_path( __FILE__ ) . '/includes/class.pages.php';
		add_action( 'network_admin_menu', array( $this, 'network_admin_menu' ) );
	}
	function network_admin_menu() {		
		$this->main_page = add_menu_page( __( 'Network Publishing Stats', 'network-king' ),  __( 'Network King', 'network-king' ),'update_core', 'network_king', '','dashicons-star-filled',3);
		$this->main_page_sub = add_submenu_page('network_king',  __( 'Publishing Stats', 'network-king' ), __( 'Publishing Stats', 'network-king' ),'update_core','network_king', array( 'Network_King_Pages','publishing_stats_page'));
		//('speedguard', __('Speed Tests','speedguard'),  __('Speed Tests','speedguard'), 'update_core', 'speedguard' );
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
		 * defined in Network_King_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Network_King_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();			
		//if ($screen->id == 'toplevel_page_network_king-network') {		
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/network-king-admin.css', array(), $this->version ); 
			//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/network-king-admin.css', array(), $this->version, 'all' );
		//}
		
		

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
		 * defined in Network_King_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Network_King_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/network-king-admin.js', array( 'jquery' ), $this->version, false );

	}

}
