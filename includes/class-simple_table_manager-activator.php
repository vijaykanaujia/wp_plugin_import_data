<?php

/**
 * Fired during plugin activation
 *
 * @link       https://xyz.me/
 * @since      1.0.0
 *
 * @package    Simple_table_manager
 * @subpackage Simple_table_manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Simple_table_manager
 * @subpackage Simple_table_manager/includes
 * @author     Sanjay Singh <sajays442@gmail.com>
 */
class Simple_table_manager_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		global $wpdb;
		$table_name = "portal_category_list";
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			`id` int(11) NOT NULL AUTO_INCREMENT,
  			`category_list_tag` varchar(30) NOT NULL,
  			`name` TEXT(100) NOT NULL,
  			`value` TEXT NOT NULL,
 			`parent_id` int(11) NOT NULL,
			`sub_tag` TEXT(100) NULL,
  			PRIMARY KEY (`id`),
			INDEX `name` (`name`),
			INDEX `value` (`value`)
		  ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}
