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
}
