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
class DS_tender_admin_base
{

	public function __construct()
	{
	}


	function ds_tender_admin_menu_section()
	{
		$page_title = "Tender";
		$menu_title = "Tender";
		$capability = "manage_options";
		$menu_slug = "ds_tender-menu";
		$functionCallable = array($this, "ds_tender_list_on_click");
		$icon_url = "";
		$position = 200;
		add_menu_page($page_title, $menu_title, $capability, $menu_slug, $functionCallable, $icon_url, $position);
		add_submenu_page($menu_slug, "Add tender", "Add tender", $capability, $menu_slug . '_add_tender', array($this, "ds_tender_add_on_click"));
		add_submenu_page($menu_slug, "Add company", "Add company", $capability, $menu_slug . '_add_company', array($this, "ds_tender_add_company_on_click"));
	}

	function ds_tender_list_on_click()
	{
		echo "list of tenders :)";
	}
	function ds_tender_add_company_on_click()
	{
		include_once ds_tender_PLAGIN_DIR . '/admin/partials/company/add.php';
	}
	function ds_tender_add_on_click()
	{
		// 	global $table_prefix, $wpdb;
		// 	$wp_table = $table_prefix . "ds_tender";

		// if (isset($_POST['save_question'])) {

		// $question_grade_id = $_POST['subject'];

		//   $question = $_POST['question'];
		//   $chapter = $_POST['chapter'];

		//   $ans_a = $_POST['ans_a'];
		//   $ans_b = $_POST['ans_b'];
		//   $ans_c = $_POST['ans_c'];
		//   $ans_d = $_POST['ans_d'];
		//   $ans_e = $_POST['ans_e'];
		//   $ans_f = $_POST['ans_f'];

		//   $correct_ans = $_POST['correct_ans'];
		//   $details = $_POST['details'];

		// 		if ($_POST['edit_question_id'] > 0) {
		// 			$wpdb->query($wpdb->prepare("UPDATE $wp_table SET question='" . 
		// 			$question . "', ans_a='" . $ans_a .  "', ans_b='" . $ans_b .  "', ans_c='" . $ans_c . 
		// 			"', ans_d='" . $ans_d .   "', ans_e='" . $ans_e .   "', ans_f='" . $ans_f . 
		// 			"', correct_ans='" . $correct_ans .   "', details='" . $details . 
		// 			"' WHERE `id`=" . $_POST['edit_question_id']));
		// 		} else {

		// 			$wpdb->insert($wp_table, array(

		// 				'question_grade_id' => $question_grade_id,

		// 				'question' => $question,
		// 				'chapter' => $chapter,

		// 				'ans_a' => $ans_a,
		// 				'ans_b' => $ans_b,
		// 				'ans_c' => $ans_c,
		// 				'ans_d' => $ans_d,
		// 				'ans_e' => $ans_e,
		// 				'ans_f' => $ans_f,

		// 				'correct_ans' => $correct_ans,
		// 				'details' => $details,

		// 				'enabled' => 1,
		// 				'user_id' => get_current_user_id(),
		// 			));

		// 			echo "Question ID : " . $wpdb->insert_id;
		// 		}
		// 	}
		include_once ds_tender_PLAGIN_DIR . '/admin/partials/tender/add.php';
	}
}
