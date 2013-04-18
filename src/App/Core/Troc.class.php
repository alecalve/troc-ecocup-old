<?php

namespace App\Core;

include_once(dirname(dirname(dirname(__DIR__))).'/conf.php');

class Troc 
{ 
    public static function getMatchingOffers($arrayDon, $arrayCherche)
    {
        $match = array();

        foreach($arrayDon as $ecocupDon) {
            foreach($arrayCherche as $ecocupDesir) {
                $offer = self::getOffer($ecocupDon, $ecocupDesir);
                if (NULL != $offer) {
                    $match[] = array("don" => $ecocupDon, "desir" => $ecocupDesir, "login" => $offer['login']);
                }
            }
        }
        
        return $match;
    
    }
    /**
     * Retourne un array id_ecocup => login des personnes qui proposent l'écocup ecocup_cherche contre l'écocup ecocup_donne
     * 
     */
     
    public static function getOffer($ecocup_cherche, $ecocup_donne)
    {
        global $_CONF;
        
        $bd = new \App\Utils\Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare(
            "SELECT login FROM propositions WHERE ecocup_donne_id = :cherche_id and ecocup_cherche_id = :donne_id and NOW() < propositions.expires_at and propositions.active = 1 LIMIT 0,1"
        );
        $success = $bd->execute($request, array("cherche_id"=>intval($ecocup_cherche), "donne_id"=>intval($ecocup_donne)));
        $array = $request->fetchAll(\PDO::FETCH_ASSOC);
        $bd = NULL;
        if (!$success) {
            return NULL;
        }
        return $array[0];
    }
    
    public static function deleteOffer($donne_id, $cherche_id, $login)
    {
        global $_CONF;
        
        $bd = new \App\Utils\Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare(
            "UPDATE propositions SET active = 0 WHERE ecocup_donne_id = :donne_id and ecocup_cherche_id = :cherche_id and login = :login"
        );
        $success = $bd->execute($request, array("cherche_id"=>intval($ecocup_cherche), "donne_id"=>intval($ecocup_donne), "login"=>$login));
        $array = $request->fetchAll(\PDO::FETCH_ASSOC);
        $bd = NULL;
        if (!$success) {
            return NULL;
        }
    }
} 
