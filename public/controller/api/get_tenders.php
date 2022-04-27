<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_CF
 * @subpackage Mp_CF/admin
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mp_CF
 * @subpackage Mp_CF/admin
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class DS_tender_public_get_tender_api
{

    public function __construct()
    {
    }

    function rest_tenders()
    {
        // test with https://tezt.localhost/api/ds_tender/v1/tenders/0/1,2,4

        add_action('rest_api_init', function () {
            register_rest_route(ds_tender . '/v1', '/tenders/(?P<offset>\d+)/(?P<categories>[1-9][1-9,]+[1-9])', array( // where categories are 1,2,23,56
                'methods' => 'GET',
                'callback' => function (WP_REST_Request $request) {

                    $categories = $request->get_param('categories');
                    $offset = $request->get_param('offset');

                    global $table_prefix, $wpdb;
                    $wp_table = $table_prefix . "ds_tenders";
                    $wp_tender_categories_table = $table_prefix . "ds_tender_tender_categories";

                    $tenders = $wpdb->get_results("SELECT DISTINCT tend.id, title, closing_date FROM $wp_table as tend INNER JOIN " .
                        $wp_tender_categories_table . " as tend_cats ON tend.id = tender_id WHERE category_id IN (" . $categories . ") ORDER BY id DESC LIMIT " . $offset . ", 10");

                    return array(
                        "success" => true,
                        "offset" => $offset + count($tenders),
                        "tenders" => $tenders
                    );
                },
                'permission_callback' => function () {
                    return true; //current_user_can('edit_others_posts');
                }
            ));
        });
    }
}
