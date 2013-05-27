<?php 
include_once(dirname(__FILE__).'/head.php');

use App\Core\EcocupManager as EcocupManager;
use App\Core\TrocManager as TrocManager;

$EManager = new EcocupManager();
$TManager = new TrocManager();
?>
<h3>Résultats</h3>
<?php
$matches = $TManager->getMatchingOffers($_POST['input'], $_POST['output']);

if (!empty($matches)) {
    $matchID = array();
    foreach($matches as $match) {
        $matchID[] = $match["desir"];
    }

    foreach($matches as $offer) {
        $TManager->deleteOffer($offer["desir"], $offer["don"], $offer["login"]);
        $mail = $offer["login"]."@etu.utc.fr";
        echo "<div class='alert alert-success'>".$offer["login"]." donne une ".$EManager->getEcocupByID($offer["desir"])." et cherche une ".
        $EManager->getEcocupByID($offer["don"]).".<br>Envoie-lui un mail à son adresse etu (<a href='mailto:".$mail."'>".$mail."</a>) pour conclure l'échange.</div>";
    }
    
    foreach(array_diff($_POST['output'], $matchID) as $toInsert) {
        $TManager->insertOffer($_POST['input'], $toInsert, $_SESSION['user']);
    }
    
} else { 

    foreach($_POST['output'] as $toInsert) {
        $TManager->insertOffer($_POST['input'], $toInsert, $_SESSION['user']);
    }
  
  ?>
        <div class="row">
            <div class="hero-unit">
                <h5>Pas d'offres correspondantes pour toi</h5>
                <p>Rassures-toi, tes offres sont gardées en mémoire et si quelqu'un pose une offre correspondante, il/elle te contactera.</p>
            </div>
        </div>
<?php
}

include_once(dirname(__FILE__).'/tail.php'); ?>
