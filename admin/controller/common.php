<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Ds_tender
 * @subpackage Ds_tender/friendship
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ds_tender
 * @subpackage Ds_tender/friendship
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Ds_tender_admin_common
{

	public function __construct()
	{
	}

    public static function callGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        $header = array();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // $header[] = "com-id: " . get_option('mp_rep_community_id');
        // $header[] = 'X-API-Key:' . get_option('mp_rep_community_api_key');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return array("code" => $http_code, "result" => $result);
    }
}
