<?php

include_once(dirname(__DIR__).'/utils/BDD.class.php');
include_once(dirname(__DIR__).'/conf.php');

/* Classe de gestion des requêtes concernant les écocups
 */

class Ecocup {
    
    /**
     * Retourne un array des écocups présentes dans la table de la forme "$assos $semestre"
     * 
     */
     
    public static function getEcocups() {
        global $_CONF;
        
        $bd = new BDD($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare("SELECT * FROM ecocups");
        $success = $bd->execute($request);
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        $bd = NULL;
        $finishedArray = array();
        foreach($array as $ecocup) {
            if (!empty($ecocup["commentaire"])) {
                $finishedArray[] = array("id"=>$ecocup["id"], "text"=>$ecocup["asso"]." ".$ecocup["semestre"]." (".$ecocup["commentaire"].")");
            }
            else {
                $finishedArray[] = array("id"=>$ecocup["id"], "text"=>$ecocup["asso"]." ".$ecocup["semestre"]);
            }
        }
        return $finishedArray;
    }
    
    /* Crée le code HTML d'un select de name $name des écocups présentes dans la base
     * 
     * 
     */
     
    public static function genSelectList($name) {
        $ecocups = self::getEcocups();
        $htmlCode = '<select name="'.$name.'" multiple=yes size='.count($ecocups).'>';
        foreach($ecocups as $ecocup) {
            $htmlCode = $htmlCode.'<option name="'.$ecocup["id"].'">'.$ecocup["text"].'</option>';            
        }
        $htmlCode = $htmlCode.'</select>';
        return $htmlCode;
    }
} 
