<?php
namespace App\Service;

use Spatie\ArrayToXml\ArrayToXml; // tömbből XML-be konvertál

class ResponseFormatter {
    public static function format($data, $acceptHeader) {
        if (strpos($acceptHeader, "application/xml") !== false) {
            header("Content-type: application/xml");
            return ArrayToXml::convert($data, "root", true, "UTF-8");
        } else {
            header("Content-type: application/json");
            return json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}