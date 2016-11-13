<?php

/**
 * @author era
 * 
 * Description of Utils:
 * Utility class.
 */
class Utils {

    /**
     * Returns json encoded response.
     * @param string $response
     */
    public static function sendResponse($response) {
        echo json_encode(array("response" => $response, "success" => true));
    }
    
    /**
     * Echo debug message.
     * @param type $text
     */
    public static function echoDebug ($text) {
        echo "[DEBUG] ".$text."<br>";
    }

}
