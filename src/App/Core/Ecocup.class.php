<?php

namespace App\Core;

include_once(dirname(dirname(dirname(__DIR__))).'/conf.php');

/* Classe de gestion des requêtes concernant les écocups
 */

class Ecocup {
    
    /**
     * Retourne un array des écocups présentes dans la table de la forme "$assos $semestre"
     * 
     */
     
    public static function getEcocups()
    {
        global $_CONF;
        
        $bd = new \App\Utils\Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare("SELECT * FROM ecocups");
        $success = $bd->execute($request, array());
        $array = $request->fetchAll(\PDO::FETCH_ASSOC);
        $bd = NULL;
        $finishedArray = array();
        foreach($array as $ecocup) {
            if (!empty($ecocup["commentaire"])) {
                $finishedArray[] = array("id"=>$ecocup["id"], "text"=>$ecocup["asso"]." ".$ecocup["semestre"]." (".$ecocup["commentaire"].")");
            } else {
                $finishedArray[] = array("id"=>$ecocup["id"], "text"=>$ecocup["asso"]." ".$ecocup["semestre"]);
            }
        }
        return $finishedArray;
    }
    /* Renvoie le nom ($asso $semestre ($commentaires)) de l'écocup d'id $id, renvoie -1 si l'écocup n'est pas trouvée
     * @params int $id
     * @return string $nom
     */
    public static function getEcocupByID($id)
    {
        global $_CONF;
        
        $bd = new \App\Utils\Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
        $request = $bd->prepare("SELECT asso, semestre, commentaire FROM ecocups WHERE id = :id LIMIT 0,1");
        $success = $bd->execute($request, array("id"=>intval($id)));
        $array = $request->fetchAll(\PDO::FETCH_ASSOC);
        $bd = NULL;
        if (!$success) {
            return -1;
        }
        $ecocup = $array[0];
        if (!empty($ecocup["commentaire"])) {
            $nom = $ecocup["asso"]." ".$ecocup["semestre"]." (".$ecocup["commentaire"].")";
        } else {
            $nom = $ecocup["asso"]." ".$ecocup["semestre"];
        }
        return $nom;
    }
    
    /* Crée le code HTML d'un select de name $name des écocups présentes dans la base
     * 
     * 
     */
     
    public static function genCheckList($name)
    {
        $ecocups = self::getEcocups();
        foreach($ecocups as $ecocup) {
            $htmlCode = $htmlCode.'<input type="checkbox" name="ecocupCherche" value="'.$ecocup["id"].'">'.$ecocup["text"].'</input><br>';            
        }
        return $htmlCode;
    }
    
    public static function genRadioList($name)
    {
        $ecocups = self::getEcocups();
        foreach($ecocups as $ecocup) {
            $htmlCode = $htmlCode.'<input type="radio" name="ecocupDon" value="'.$ecocup["id"].'">'.$ecocup["text"].'</input><br>';            
        }
        return $htmlCode;
    }
} 
