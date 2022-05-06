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
            register_rest_route(ds_tender . '/v1', '/tenders/(?P<offset>\d+)/(?P<limit>\d+)/(?P<categories>[0-9][0-9,]+[0-9])', array( // where categories are 1,2,23,56
                'methods' => 'GET',
                'callback' => function (WP_REST_Request $request) {

                    $categories = $request->get_param('categories');
                    $offset = $request->get_param('offset');
                    $limit = $request->get_param('limit');

                    global $table_prefix, $wpdb;
                    $wp_table = $table_prefix . "ds_tenders";
                    $wp_tender_categories_table = $table_prefix . "ds_tender_tender_categories";
                    $wp_ds_tender_sources_table = $table_prefix . "ds_tender_sources";
                    $wp_ds_b_regions_table = $table_prefix . "ds_b_regions";

                    $tenders = $wpdb->get_results("SELECT DISTINCT tend.id, title, closing_date, source_name, IF(closing_date>NOW(), 'Open', 'Closed') as tender_status, DATEDIFF(closing_date, NOW()) as days_left FROM ".$wp_table." as tend ".
                    "INNER JOIN " . $wp_tender_categories_table . " as tend_cats ON tend.id = tender_id ".
                    "INNER JOIN " . $wp_ds_tender_sources_table . " as tend_source ON tend_source.id = source_id ".
                    // "INNER JOIN " . $wp_ds_b_regions_table . " as tend_region ON tend_region.id = region_id ".
                    "WHERE category_id IN (" . $categories . ") ORDER BY id DESC LIMIT " . $offset . ", " . $limit);

                    return array(
                        "success" => true,
                        "offset" => $offset + count($tenders),
                        "tenders" => $tenders
                    );
                },
                'permission_callback' => function () {
                    return self::is_user_verified();
                }
            ));
        });
    }
    function rest_tender()
    {
        // test with https://tezt.localhost/api/ds_tender/v1/tender/1

        add_action('rest_api_init', function () {
            register_rest_route(ds_tender . '/v1', '/tender/(?P<tender_id>\d+)', array(
                'methods' => 'GET',
                'callback' => function (WP_REST_Request $request) {

                    $tender_id = $request->get_param('tender_id');

                    global $table_prefix, $wpdb;
                    $wp_table = $table_prefix . "ds_tenders";
                    $wp_tender_categories_table = $table_prefix . "ds_tender_tender_categories";

                    $tender = $wpdb->get_row("SELECT DISTINCT tend.id, content, opening_date FROM $wp_table as tend INNER JOIN " .
                        $wp_tender_categories_table . " as tend_cats ON tend.Id = tender_id WHERE tend.id=" . $tender_id . "");

                    return array(
                        "success" => true,
                        "tender" => $tender
                    );
                },
                'permission_callback' => function () {

                    return self::is_user_verified();
                }
            ));
        });
    }
    public function is_user_verified()
    {
        $auth = apache_request_headers();
        if (isset($auth['username']) && isset($auth['password'])) {

            $username = $auth['username'];
            $password = $auth['password'];

            $check = wp_authenticate_username_password(NULL, $username, $password);

            return !is_wp_error($check);
        } else return false;
    }
}
