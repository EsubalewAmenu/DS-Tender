<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Ds_tender
 * @subpackage Ds_tender/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ds_tender
 * @subpackage Ds_tender/admin
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class DS_tender_admin_tender
{

	public function __construct()
	{
	}


	function wp_ajax_ds_tender_check_if_added()
	{
		global $table_prefix, $wpdb;
		$wp_table = $table_prefix . "ds_tenders";

		$company = $wpdb->get_row("SELECT id, user_id FROM $wp_table WHERE two_merkato_id = '" . $_POST['two_merkato_id'] . "'");
		// print_r($company);
		echo (json_encode($company));
		die();
	}
	function wp_ajax_ds_tender_save_tender()
	{

		global $table_prefix, $wpdb;
		$wp_table = $table_prefix . "ds_tenders";
		$wp_categories_table = $table_prefix . "ds_tender_tender_categories";



		$title = $_POST['title'];
		$content = $_POST['content'];

		$opening_date = $_POST['opening_date'];
		$closing_date = $_POST['closing_date'];
		$source_id = $_POST['source'];
		$published_date = $_POST['published_date'];
		$bid_doc_price = $_POST['bid_doc_price'];
		$bid_bond = $_POST['bid_bond'];
		$region_id = $_POST['region'];
		$company_id = $_POST['company_id'];
		$two_merkato_id = $_POST['two_merkato_id'];
		$categories = explode(",", $_POST['categories']);
		$enabled = 1; //$_POST['enabled'];

		if ($_POST['edit_tender_id'] > 0) {
			$wpdb->query($wpdb->prepare("UPDATE $wp_table SET title='" .
				$title . "', content='" . $content .  "', opening_date='" . $opening_date .  "', closing_date='" . $closing_date .
				"', source_id='" . $source_id .   "', published_date='" . $published_date .   "', bid_doc_price='" . $bid_doc_price .
				"', bid_bond='" . $bid_bond . "', region_id='" . $region_id . "', company_id='" . $company_id .
				"', enabled='" . $enabled .   "' WHERE `id`=" . $_POST['edit_tender_id']));
		} else {

			$wpdb->insert($wp_table, array(

				'title' => $title,

				'content' => $content,
				'opening_date' => $opening_date,
				'closing_date' => $closing_date,
				'source_id' => $source_id,
				'published_date' => $published_date,
				'bid_doc_price' => $bid_doc_price,
				'bid_bond' => $bid_bond,
				'region_id' => $region_id,
				'company_id' => $company_id,
				'two_merkato_id' => $two_merkato_id,
				'enabled' => 1,
				'user_id' => get_current_user_id(),
			));

			$tender_id = $wpdb->insert_id;
			foreach ($categories as $category_id) {
				$wpdb->insert($wp_categories_table, array(
					'tender_id' => $tender_id,
					'category_id' => $category_id,
				));
			}
		}
		echo "Completed!";
		die();
	}
}
