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

			$sql .= "  `opening_date` DATETIME NULL, ";
			$sql .= "  `closing_date` DATETIME NULL, ";
			$sql .= "  `source_id`  int(10) NULL, ";
			$sql .= "  `published_date` DATE NULL, ";
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
			$sql .= "('9', 'Printed Advertising Materials', '0', '2', '0', '1'),";

			$sql .= "('10', 'Agriculture and Farming', '1', '0', '0', '1'),";
			$sql .= "('11', 'Raw Materials and Supplies', '0', '10', '0', '1'),";
			$sql .= "('12', 'Flora and Horticulture', '0', '10', '0', '1'),";
			$sql .= "('13', 'Animal Feed', '0', '10', '0', '1'),";
			$sql .= "('14', 'Live Animals', '0', '10', '0', '1'),";
			$sql .= "('15', 'Products and Services', '0', '10', '0', '1'),";
			$sql .= "('16', 'Poultry, Bee and Animal Husbandry', '0', '10', '0', '1'),";
			$sql .= "('17', 'Machinery and Equipment', '0', '10', '0', '1'),";

			$sql .= "('18', 'Air conditioning and Refrigeration', '1', '0', '0', '1'),";

			$sql .= "('19', 'Art', '1', '0', '0', '1'),";
			$sql .= "('20', 'Musical Instruments', '0', '19', '0', '1'),";
			$sql .= "('21', 'Audio Visual, Photography and Filming Service and Equipment', '0', '19', '0', '1'),";
			$sql .= "('22', 'Music and Entertainment', '0', '19', '0', '1'),";
			$sql .= "('23', 'Fine Art, Antiques, Crafts', '0', '19', '0', '1'),";

			$sql .= "('24', 'Banking Equipment and Services', '1', '0', '0', '1'),";
			$sql .= "('25', 'Bid Modification, Amendment and Cancellation', '1', '0', '0', '1'),";
			$sql .= "('26', 'Catering and Cafeteria Services', '1', '0', '0', '1'),";
			$sql .= "('27', 'Chemicals and Reagents', '1', '0', '0', '1'),";
			$sql .= "('28', 'Cleaning and Janitorial Equipment and Service', '1', '0', '0', '1'),";

			$sql .= "('29', 'Construction and Water Works', '1', '0', '0', '1'),";
			$sql .= "('30', 'Building Construction', '0', '29', '0', '1'),";
			$sql .= "('31', 'Road and Bridge Construction', '0', '29', '0', '1'),";
			$sql .= "('32', 'Water System Installation', '0', '29', '0', '1'),";
			$sql .= "('33', 'Water Well and Pool Cleaning', '0', '29', '0', '1'),";
			$sql .= "('34', 'Architectural and Construction Design', '0', '29', '0', '1'),";
			$sql .= "('35', 'Water Construction', '0', '29', '0', '1'),";
			$sql .= "('36', 'Irrigation Works', '0', '29', '0', '1'),";
			$sql .= "('37', 'Sewerage', '0', '29', '0', '1'),";
			$sql .= "('38', 'Water Engineering Machinery and Equipment', '0', '29', '0', '1'),";
			$sql .= "('39', 'Water Well Drilling', '0', '29', '0', '1'),";
			$sql .= "('40', 'Building and Finishing Materials', '0', '29', '0', '1'),";
			$sql .= "('41', 'Contract Administration and Supervision', '0', '29', '0', '1'),";
			$sql .= "('42', 'Finishig Works', '0', '29', '0', '1'),";
			$sql .= "('43', 'Water Proofing Works', '0', '29', '0', '1'),";
			$sql .= "('44', 'Water Pipes and Fittings', '0', '29', '0', '1'),";
			$sql .= "('45', 'Construction Machinery and Equipment', '0', '29', '0', '1'),";

			$sql .= "('46', 'Consultancy', '1', '0', '0', '1'),";
			$sql .= "('47', 'Engineering', '0', '46', '0', '1'),";
			$sql .= "('48', 'Financial', '0', '46', '0', '1'),";
			$sql .= "('49', 'Environmental', '0', '46', '0', '1'),";
			$sql .= "('50', 'Agricultural', '0', '46', '0', '1'),";
			$sql .= "('51', 'Other', '0', '46', '0', '1'),";
			$sql .= "('52', 'ICT', '0', '46', '0', '1'),";
			$sql .= "('53', 'Health Related', '0', '46', '0', '1'),";
			$sql .= "('54', 'Legal', '0', '46', '0', '1'),";
			$sql .= "('55', 'Academic', '0', '46', '0', '1'),";
			$sql .= "('56', 'Organizational', '0', '46', '0', '1'),";
			$sql .= "('57', 'Social and Public Policy', '0', '46', '0', '1'),";

			$sql .= "('58', 'Consumable Goods', '1', '0', '0', '1'),";

			$sql .= "('59', 'Courier Services', '1', '0', '0', '1'),";

			$sql .= "('60', 'Distribution of Different products', '1', '0', '0', '1'),";

			$sql .= "('61', 'Education and Training', '1', '0', '0', '1'),";
			$sql .= "('62', 'Services', '0', '61', '0', '1'),";
			$sql .= "('63', 'Materials', '0', '61', '0', '1'),";

			$sql .= "('64', 'Electrical, Electromechanical and Electronics', '1', '0', '0', '1'),";
			$sql .= "('65', 'Equipment and Accessories', '0', '64', '0', '1'),";
			$sql .= "('66', 'Installation, Maintenance and Other Engineering Services', '0', '64', '0', '1'),";
			$sql .= "('67', 'Pumps, Motors and Compressors', '0', '64', '0', '1'),";

			$sql .= "('68', 'Energy, Power and Electricity', '1', '0', '0', '1'),";
			$sql .= "('69', 'Hydro Power', '0', '68', '0', '1'),";
			$sql .= "('70', 'Solar and Photovoltaic', '0', '68', '0', '1'),";
			$sql .= "('71', 'Coal', '0', '68', '0', '1'),";
			$sql .= "('72', 'Firewood', '0', '68', '0', '1'),";
			$sql .= "('73', 'Generators', '0', '68', '0', '1'),";

			$sql .= "('74', 'Food Items and Drinks', '1', '0', '0', '1'),";
			$sql .= "('75', 'Food and Beverage', '1', '0', '0', '1'),";
			$sql .= "('76', 'Fuel and Lubricants', '1', '0', '0', '1'),";

			$sql .= "('77', 'Furniture and Furnishing', '1', '0', '0', '1'),";
			$sql .= "('78', 'Home Appliance and Supplies', '0', '77', '0', '1'),";
			$sql .= "('79', 'House Furniture', '0', '77', '0', '1'),";
			$sql .= "('80', 'Office Furniture', '0', '77', '0', '1'),";
			$sql .= "('81', 'Carpets and Curtains', '0', '77', '0', '1'),";

			$sql .= "('82', 'Gardening and Landscaping', '1', '0', '0', '1'),";
			$sql .= "('83', 'General Service Provision', '1', '0', '0', '1'),";
			$sql .= "('84', 'Geotechnical Investigation & Laboratory Testing', '1', '0', '0', '1'),";
			$sql .= "('85', 'Government Treasury Bill', '1', '0', '0', '1'),";
			$sql .= "('86', 'Hand Tools and Workshop Equipment', '1', '0', '0', '1'),";

			$sql .= "('87', 'Health Care, Medical Industry', '1', '0', '0', '1'),";
			$sql .= "('88', 'Pharmaceutical Products', '0', '87', '0', '1'),";
			$sql .= "('89', 'Health Related Services and Materials', '0', '87', '0', '1'),";
			$sql .= "('90', 'Veterinary Equipment and Supplies', '0', '87', '0', '1'),";
			$sql .= "('91', 'Medical Equipment and Supplies', '0', '87', '0', '1'),";

			$sql .= "('92', 'Hospitality, Tour and Travel', '1', '0', '0', '1'),";
			$sql .= "('93', 'Tour and Travel', '0', '92', '0', '1'),";
			$sql .= "('94', 'Air Ticket', '0', '92', '0', '1'),";
			$sql .= "('95', 'Hotel Service Provision', '0', '92', '0', '1'),";

			$sql .= "('96', 'Humanitarian Aid Supply, Relief Items', '1', '0', '0', '1'),";

			$sql .= "('97', 'IT and Telecom', '1', '0', '0', '1'),";
			$sql .= "('98', 'Telecommunication Service', '0', '97', '0', '1'),";
			$sql .= "('99', 'Software Provision, Development and Web Design', '0', '97', '0', '1'),";
			$sql .= "('100', 'Computer and Accessories', '0', '97', '0', '1'),";
			$sql .= "('101', 'Telecommunication  Equipment', '0', '97', '0', '1'),";
			$sql .= "('102', 'Networking Equipment and Installation', '0', '97', '0', '1'),";

			$sql .= "('103', 'Industrial Machinery Provision and Installation', '1', '0', '0', '1'),";
			$sql .= "('104', 'Insurance Service', '1', '0', '0', '1'),";
			$sql .= "('105', 'Interior Design Service and Material', '1', '0', '0', '1'),";
			$sql .= "('106', 'International Competitive Bidding (ICB)', '1', '0', '0', '1'),";
			$sql .= "('107', 'Kitchen Equipment', '1', '0', '0', '1'),";
			$sql .= "('108', 'Laboratory Equipment and Chemicals', '1', '0', '0', '1'),";
			$sql .= "('109', 'Labour Outsourcing Services', '1', '0', '0', '1'),";
			$sql .= "('110', 'Land Lease & Real Estate', '1', '0', '0', '1'),";

			$sql .= "('111', 'Maintenance and Repair', '1', '0', '0', '1'),";
			$sql .= "('112', 'Others', '0', '111', '0', '1'),";
			$sql .= "('113', 'Machinery', '0', '111', '0', '1'),";
			$sql .= "('114', 'Office Machines and Computers', '0', '111', '0', '1'),";
			$sql .= "('115', 'Vehicle (garage service)', '0', '111', '0', '1'),";
			$sql .= "('116', 'Furniture', '0', '111', '0', '1'),";
			$sql .= "('117', 'House and Building', '0', '111', '0', '1'),";

			$sql .= "('118', 'Materials', '1', '0', '0', '1'),";

			$sql .= "('119', 'Mechanical', '1', '0', '0', '1'),";
			$sql .= "('120', 'Installation, Maintenance and Other Engineering Services', '0', '121', '0', '1'),";
			$sql .= "('121', 'Equipment and Accessories', '0', '121', '0', '1'),";

			$sql .= "('122', 'Metal and Metal Working', '1', '0', '0', '1'),";
			$sql .= "('123', 'Mineral and Natural Resources', '1', '0', '0', '1'),";

			$sql .= "('124', 'Office Supplies and Services', '1', '0', '0', '1'),";
			$sql .= "('125', 'Stationery', '0', '124', '0', '1'),";
			$sql .= "('126', 'Secretarial Service', '0', '124', '0', '1'),";
			$sql .= "('127', 'Office Machines and Accessories', '0', '124', '0', '1'),";

			$sql .= "('128', 'Packaging and Labelling', '1', '0', '0', '1'),";
			$sql .= "('129', 'Personal Care Products and Services', '1', '0', '0', '1'),";

			$sql .= "('130', 'Pest Control and Fumigants', '1', '0', '0', '1'),";
			$sql .= "('131', 'Pest Control and Fumigation', '0', '130', '0', '1'),";
			$sql .= "('132', 'Pesticides, Insecticides and Herbicides', '0', '130', '0', '1'),";

			$sql .= "('133', 'Plastic Raw Materials and Products', '1', '0', '0', '1'),";
			$sql .= "('134', 'Foam Mattress', '0', '133', '0', '1'),";
			$sql .= "('135', 'Plastic Products', '0', '133', '0', '1'),";
			$sql .= "('136', 'Plastic Raw Materials', '0', '133', '0', '1'),";

			$sql .= "('137', 'Printing and Publishing', '1', '0', '0', '1'),";
			$sql .= "('138', 'Privatization', '1', '0', '0', '1'),";
			$sql .= "('139', 'Quality Assurance Services', '1', '0', '0', '1'),";
			$sql .= "('140', 'Raw materials', '1', '0', '0', '1'),";

			$sql .= "('141', 'Rent', '1', '0', '0', '1'),";
			$sql .= "('142', 'Others', '0', '141', '0', '1'),";
			$sql .= "('143', 'Vehicle', '0', '141', '0', '1'),";
			$sql .= "('144', 'Machinery and Equipment', '0', '141', '0', '1'),";
			$sql .= "('145', 'Construction Machinery', '0', '141', '0', '1'),";
			$sql .= "('146', 'House, Building and Warehouse', '0', '141', '0', '1'),";

			$sql .= "('147', 'Safety and Security', '1', '0', '0', '1'),";
			$sql .= "('148', 'Service', '0', '147', '0', '1'),";
			$sql .= "('149', 'Equipment', '0', '147', '0', '1'),";
			$sql .= "('150', 'Disposal of Hazardous Waste', '0', '147', '0', '1'),";

			$sql .= "('151', 'Sales, Disposals and Foreclosure', '1', '0', '0', '1'),";
			$sql .= "('152', 'Other Sales', '0', '151', '0', '1'),";
			$sql .= "('153', 'Shares and Others Foreclosure', '0', '151', '0', '1'),";
			$sql .= "('154', 'Disposal Sale', '0', '151', '0', '1'),";
			$sql .= "('155', 'Business, Industry and Factory Foreclosure', '0', '151', '0', '1'),";
			$sql .= "('156', 'Vehicle and Machinery Foreclosure', '0', '151', '0', '1'),";
			$sql .= "('157', 'House and Building Foreclosure', '0', '151', '0', '1'),";
			$sql .= "('158', 'Vehicle and Machinery Sale', '0', '151', '0', '1'),";
			$sql .= "('159', 'House and Building Sale', '0', '151', '0', '1'),";

			$sql .= "('160', 'Sanitary and Ceramics', '1', '0', '0', '1'),";
			$sql .= "('161', 'Spare Parts and Car Decoration Materials', '1', '0', '0', '1'),";
			$sql .= "('162', 'Sport Materials and Equipment', '1', '0', '0', '1'),";

			$sql .= "('163', 'Steel, Metals and Aluminium', '1', '0', '0', '1'),";
			$sql .= "('164', 'Aluminium Products', '0', '163', '0', '1'),";
			$sql .= "('165', 'Aluminium Works and Installation', '0', '163', '0', '1'),";
			$sql .= "('166', 'Other Metals', '0', '163', '0', '1'),";
			$sql .= "('167', 'Steel Raw Materials and Products', '0', '163', '0', '1'),";

			$sql .= "('168', 'Tender Award Notice', '1', '0', '0', '1'),";
			$sql .= "('169', 'Tents and Camping Equipment', '1', '0', '0', '1'),";
			$sql .= "('170', 'Test & Measurement Tools', '1', '0', '0', '1'),";

			$sql .= "('171', 'Textile, Garment and Leather', '1', '0', '0', '1'),";
			$sql .= "('172', 'Shoes and Other Leather Products', '0', '171', '0', '1'),";
			$sql .= "('173', 'Textile, Garments and Uniforms', '0', '171', '0', '1'),";

			$sql .= "('174', 'Translation, Editing and Writing', '1', '0', '0', '1'),";
			$sql .= "('175', 'Tri Wheeler, Motorcycles and Bicycles Purchase', '1', '0', '0', '1'),";
			$sql .= "('176', 'Vehicles Purchase', '1', '0', '0', '1'),";

			$sql .= "('177', 'Warehousing, Transit and Transport Service', '1', '0', '0', '1'),";
			$sql .= "('178', 'Warehouse and Storage Service', '0', '177', '0', '1'),";
			$sql .= "('179', 'Transit, Customs Clearing, Packing and Forwarding', '0', '177', '0', '1'),";
			$sql .= "('180', 'Transportation Service', '0', '177', '0', '1'),";
			$sql .= "('181', 'Freight Transport', '0', '177', '0', '1'),";
			$sql .= "('182', 'Air Cargo Service', '0', '177', '0', '1'),";

			$sql .= "('183', 'Wood and Wood Working', '1', '0', '0', '1')";


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
