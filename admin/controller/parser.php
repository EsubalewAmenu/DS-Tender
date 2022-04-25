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
class Ds_tender_admin_parser
{

    public function __construct()
    {
    }
    public function checkUpdate()
    {
        echo "from check updated test working";
        $Ds_tender_admin_common = new Ds_tender_admin_common();

        $url = "https://tender.2merkato.com/tenders/6260f8ca664f5e521ee5e467";
        $response = $Ds_tender_admin_common->callGet($url);
        echo "RESPONSE IS";
        print_r($response['result']);


        
        $dom = new DomDocument();

        $dom->loadHTML($response['result']);
        $xpath = new DOMXpath($dom);
        $heading = self::parseToArray($xpath, 'border-end align-middle');
        $content = self::parseToArray($xpath, 'breadcrumb-item');
echo "dom pars started";
        var_dump($heading);
        echo "<br/>";
        var_dump($content);
        echo "<br/>";
    }

    function parseToArray($xpath, $class)
    {
        $xpathquery = "//li[@class='" . $class . "']";
        $elements = $xpath->query($xpathquery);

        if (!is_null($elements)) {
            $resultarray = array();
            foreach ($elements as $element) {
                $nodes = $element->childNodes;
                foreach ($nodes as $node) {
                    $resultarray[] = $node->nodeValue;
                }
            }
            return $resultarray;
        }
    }
}
