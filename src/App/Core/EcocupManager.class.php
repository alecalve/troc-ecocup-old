<?php

namespace App\Core;

class EcocupManager extends \App\Core\BaseManager
{

    public function getEcocups()
    {
        $array = self::getRequest("SELECT * FROM ecocups", array(), "Impossible de récupèrer la liste des écocups");
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
    public function getEcocupByID($id)
    {
        $array = self::getRequest("SELECT asso, semestre, commentaire FROM ecocups WHERE id = ? LIMIT 0,1", 
                                  array($id), 
                                  "Impossible de récupèrer l'écocup");
        $ecocup = $array[0];
        if (!empty($ecocup["commentaire"])) {
            $nom = $ecocup["asso"]." ".$ecocup["semestre"]." (".$ecocup["commentaire"].")";
        } else {
            $nom = $ecocup["asso"]." ".$ecocup["semestre"];
        }
        return $nom;
    }
} 
