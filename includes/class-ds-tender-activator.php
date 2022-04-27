<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Ds_Tender
 * @subpackage Ds_Tender/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ds_Tender
 * @subpackage Ds_Tender/includes
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Ds_Tender_Activator
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
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		//region, users from ds base services plugin

		self::ds_tenders_create_table();
		self::ds_tender_docs_create_table();
		self::ds_tender_companies_create_table();
		self::ds_tender_categories_create_table();
		self::ds_tender_tender_categories_create_table();
		self::ds_tender_sources_create_table();
		self::ds_bt_settings_create_table();
	}

	public static function ds_tenders_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tenders";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `title` text NOT NULL, ";
			$sql .= "  `content` text NOT NULL, ";

			$sql .= "  `opening_date` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `closing_date` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `source_id`  int(10) NULL, ";
			$sql .= "  `published_date` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `bid_doc_price` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `bid_bond` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `region_id` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";

			$sql .= "  `company_id`  int(10) NOT NULL, ";
			$sql .= "  `two_merkato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `enabled` int(10) DEFAULT 1, ";
			$sql .= "  `user_id`  int(10) NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}
	public static function ds_tender_sources_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_sources";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `source_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `two_merkato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `enabled` int(10) DEFAULT 1, ";
			$sql .= "  `user_id`  int(10) NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
			$sql = "INSERT INTO " . $wp_ds_bt_table . " (`source_name`, `two_merkato_id`, `user_id`) VALUES ";
			$sql .= "('2merkato', '1', '1'),";
			$sql .= "('herald', '2', '1'),";
			$sql .= "('reporter', '3', '1')";

			dbDelta($sql);
		}
	}
	public static function ds_tender_docs_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_docs";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `tender_id`  int(10) NULL, ";
			$sql .= "  `doc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `url` text NOT NULL, ";

			$sql .= "  `two_merkato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `enabled` int(10) DEFAULT 1, ";
			$sql .= "  `user_id`  int(10) NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}
	public static function ds_tender_companies_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_companies";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `website` varchar(255) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `email` varchar(50) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NULL, ";
			$sql .= "  `address` text NULL, ";

			$sql .= "  `two_merkato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `enabled` int(10) DEFAULT 1, ";
			$sql .= "  `user_id`  int(10) NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}
	public static function ds_tender_categories_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_categories";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `main_category`  int(10) DEFAULT 0, ";
			$sql .= "  `sub_category`  int(10) DEFAULT 0, ";
			$sql .= "  `third_category`  int(10) DEFAULT 0, ";

			$sql .= "  `two_merkato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `enabled` int(10) DEFAULT 1, ";
			$sql .= "  `user_id`  int(10) NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);

			$sql = "INSERT INTO " . $wp_ds_bt_table . " (`id`, `category_name`, `main_category`, `sub_category`, `two_merkato_id`, `user_id`) VALUES ";
			$sql .= "('1', 'Accounting and Auditing, Accounting System Design', '1', '0', '0', '1'),";
			$sql .= "('2', 'Advertising and Promotion', '1', '0', '0', '1'),";
			$sql .= "('3', 'Public Address Systems', '0', '2', '0', '1'),";
			$sql .= "('4', 'Event Organizing and Planning', '0', '2', '0', '1'),";
			$sql .= "('5', 'Public Relations', '0', '2', '0', '1'),";
			$sql .= "('6', 'Promotional Items', '0', '2', '0', '1'),";
			$sql .= "('7', 'Graphic Design', '0', '2', '0', '1'),";
			$sql .= "('8', 'Billboards and Digital Advertising', '0', '2', '0', '1'),";
			$sql .= "('9', 'Printed Advertising Materials', '0', '2', '0', '1')";

			dbDelta($sql);
		}
	}
	public static function ds_tender_tender_categories_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_tender_categories";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `tender_id`  int(10) DEFAULT 0, ";
			$sql .= "  `category_id`  int(10) DEFAULT 0, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}

	public static function ds_bt_settings_create_table()
	{

		global $table_prefix, $wpdb;

		$wp_ds_bt_table = $table_prefix . "ds_tender_settings";

		if ($wpdb->get_var("show tables like '$wp_ds_bt_table'") != $wp_ds_bt_table) {
			$sql = "CREATE TABLE `" . $wp_ds_bt_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";
			$sql .= "  `_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `value1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `value2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);

			$sql = "INSERT INTO " . $wp_ds_bt_table . " (`_key`, `value1`, `value2`) VALUES ";
			$sql .= "('2merkato_last_updated', '02-02-22', ''),";
			$sql .= "('2merkato_username', 'email', ''),";
			$sql .= "('2merkato_password', 'pazzword', '')";
			// $sql .= "('', '', ''),";

			dbDelta($sql);
		}
	}
}
