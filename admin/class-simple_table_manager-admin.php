<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://xyz.me/
 * @since      1.0.0
 *
 * @package    Simple_table_manager
 * @subpackage Simple_table_manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_table_manager
 * @subpackage Simple_table_manager/admin
 * @author     Sanjay Singh <sajays442@gmail.com>
 */
class Simple_table_manager_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_table_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_table_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/simple_table_manager-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_table_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_table_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/simple_table_manager-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Register the top menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_top_menu()
	{
		add_menu_page(
			'Simple table manager',
			'Simple table manager',
			'manage_options',
			plugin_dir_path(__FILE__) . 'partials/simple_table_manager-admin-display.php',
			null,
			plugin_dir_url(__FILE__) . 'images/miniorange.png',
			3
		);
	}

	public function admin_sub_menu()
	{
		add_submenu_page(
			plugin_dir_path(__FILE__) . 'partials/simple_table_manager-admin-display.php',
			'Add Table',
			'Add Simple table manager',
			'manage_options',
			plugin_dir_path(__FILE__) . 'partials/simple_table_manager-admin-add.php',
			null
		);
	}
}
