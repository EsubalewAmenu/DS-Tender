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
class DS_tender_admin_company
{

	public function __construct()
	{
	}


	function wp_ajax_ds_tender_get_company_id()
	{
		global $table_prefix, $wpdb;
		$wp_table = $table_prefix . "ds_tender_companies";

		$company = $wpdb->get_row("SELECT id, company_name FROM $wp_table WHERE two_merkato_id = '" . $_POST['company_2merkato_id'] . "'");
		// print_r($company);
		echo(json_encode($company));
		die();
	}
	function wp_ajax_ds_tender_save_company()
	{

		global $table_prefix, $wpdb;
		$wp_table = $table_prefix . "ds_tender_companies";



		$company_name = $_POST['company_name'];
		$phone = $_POST['phone'];

		$website = $_POST['website'];
		$email = $_POST['email'];
		$fax = $_POST['fax'];
		$address = $_POST['address'];
		$two_merkato_id = $_POST['two_merkato_id'];
		$enabled = 1; //$_POST['enabled'];

		if ($_POST['edit_company_id'] > 0) {
			$wpdb->query($wpdb->prepare("UPDATE $wp_table SET company_name='" .
				$company_name . "', phone='" . $phone .  "', website='" . $website .  "', email='" . $email .
				"', fax='" . $fax .   "', address='" . $address .   "', two_merkato_id='" . $two_merkato_id .
				"', enabled='" . $enabled .   "' WHERE `id`=" . $_POST['edit_company_id']));
		} else {

			$wpdb->insert($wp_table, array(

				'company_name' => $company_name,

				'phone' => $phone,
				'website' => $website,

				'email' => $email,
				'fax' => $fax,
				'address' => $address,
				'two_merkato_id' => $two_merkato_id,
				'enabled' => 1,
				'user_id' => get_current_user_id(),
			));

			// echo "company ID : " . $wpdb->insert_id;
		}
		echo "Completed!";
		die();
	}
}
