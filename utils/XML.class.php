<?php 

class XML {
    
    public static function parseCASReturn($data) {
        $xmlParsed = simplexml_load_string($data);
        $authentication = (array) $xmlParsed->children("cas", TRUE);
        try {
            $user = (array) $authentication["authenticationSuccess"];
        }
        catch (Exception $e) {
            return -1;
        }
        return $user["user"];
    }
}
