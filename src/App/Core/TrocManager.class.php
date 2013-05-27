<?php

namespace App\Core;

class TrocManager extends \App\Core\BaseManager
{ 

    public function getMatchingOffers($ecocupDon, $arrayCherche)
    {
        $match = array();
        
        foreach($arrayCherche as $ecocupCherche) {
            $offer = self::getOffer($ecocupCherche, $ecocupDon);
            if (NULL != $offer) {
                $match[] = array("don" => $ecocupDon, "desir" => $ecocupCherche, "login" => $offer['login']);
            }
        }
        return $match;
    }

    public function getOffer($cherche, $donne)
    {
        $request = "SELECT login FROM propositions p 
                    WHERE ecocup_donne_id = ? AND ecocup_cherche_id = ?
                    AND NOW() < p.expires_at AND p.active = 1 
                    LIMIT 0,1";
        $array = self::getRequest($request, array($cherche, $donne), "Impossible de trouver les offres");
        return $array[0];
    }
    
    public function getOffersByLogin($login)
    {
        $request = "SELECT * FROM propositions p 
                    WHERE p.login = ? 
                    AND NOW() < p.expires_at AND p.active = 1";
        $array = self::getRequest($request, array($login), "Impossible de trouver tes offres");
        return $array;
    }
    
    public function deleteOffer($donne, $cherche, $login)
    {
        $request = "UPDATE propositions SET active = 0 WHERE ecocup_donne_id = ? AND ecocup_cherche_id = ? AND login = ?";
        self::updateRequest($request, array($donne, $cherche, $login), "Impossible de supprimer l'offre");
    }
    
    public function insertOffer($donne, $cherche, $login)
    {
        $request = "INSERT INTO propositions (ecocup_donne_id, ecocup_cherche_id, login, expires_at)
                    VALUES(?, ?, ?, TIMESTAMPADD(YEAR, 1, NOW()))";
        self::insertRequest($request, array($donne, $cherche, $login), "Impossible d'insérer l'offre");
    }
} 
