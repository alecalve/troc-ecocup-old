<?php

include_once(dirname(__DIR__).'/utils/BDD.class.php');
include_once(dirname(__DIR__).'/conf.php');


class Troc {
    
    /**
     * Retourne un array id_ecocup => login des personnes qui proposent l'écocup ecocup_cherche contre l'écocup ecocup_donne
     * 
     */
     
    public static function getOffers($ecocup_cherche, $ecocup_donne) {
        global $_CONF;
        
        $bd = new BDD($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare("SELECT login FROM propositions WHERE ecocup_donne_id = :donne_id AND ecocup_cherche_id = :cherche_id AND NOW() < propositions.expires_at LIMIT 0,1");
        $success = $bd->execute($request, array("donne_id"=>intval($ecocup_cherche), "cherche_id"=>intval($ecocup_donne)));
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        $bd = NULL;
        if (!$success) {
            throw Exception("Erreur dans la récupération des offres");
        }
        return $array[0];
    }
} 
