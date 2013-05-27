<?php

namespace App\Core;

class GenHtml 
{
    /* Crée le code HTML d'une lise de checkbox des écocups présentes dans la base
     * 
     * @return String $htmlCode
     */
     
    public static function genCheckList()
    {
        $EManager = new \App\Core\EcocupManager();
        $ecocups = $EManager->getEcocups();
        $htmlCode = "";
        foreach($ecocups as $ecocup) {
            $htmlCode = $htmlCode.'<input id="don" class="ui-widget-content ui-corner-all" type="checkbox" name="ecocupCherche" value="'.$ecocup["id"].'"> '.$ecocup["text"].'<br>';            
        }
        return $htmlCode;
    }
    
    /* Crée le code HTML d'une lise de checkbox des écocups présentes dans la base
     * 
     * @return String $htmlCode
     */
     
    public static function genSelectList()
    {
        $EManager = new \App\Core\EcocupManager();
        $ecocups = $EManager->getEcocups();
        $htmlCode = "";
        foreach($ecocups as $ecocup) {
            $htmlCode = $htmlCode.'<option value="'.$ecocup["id"].'">'.$ecocup["text"].'</option>';            
        }
        return $htmlCode;
    }
    
    /* Crée un tableau récapitulatif des offres d'une personne */
    public static function genResumeOffers($login)
    {
        $TManager = new \App\Core\TrocManager();
        $EManager = new \App\Core\EcocupManager();
        $offers = $TManager->getOffersByLogin($login);
        $htmlCode = "";
        if (!empty($offers)) {
            $htmlCode = "<h5>Tes offres actives</h5><table class='table table-bordered table-striped'>
                         <tr><th>Tu donnes</th><th>Tu cherche</th><th>Date de dépôt</th></tr>";
            foreach($offers as $offer) {
                $htmlCode = $htmlCode."<tr><td>".$EManager->getEcocupByID($offer["ecocup_donne_id"])."</td><td>".$EManager->getEcocupByID($offer["ecocup_cherche_id"])."</td><td>".$offer["created_at"]."</td></tr>";
            }
            
            $htmlCode = $htmlCode."</table>";
        }
        
        return $htmlCode;
    }
}
