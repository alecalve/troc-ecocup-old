<?php 
include_once(dirname(__FILE__).'/head.php');

use App\Core\Ecocup as Ecocup;
use App\Core\Troc as Troc;

?>
<h3>Résultats</h3>
<?php
$match = Troc::getMatchingOffers($_POST['dons'], $_POST['desirs']);

if (!empty($match)) {
    echo "      <h2>Tadam !</h2>";
    echo "<ul>";
    foreach($match as $offer) {
        echo "<li>".$offer["login"]." propose l'écocup ".Ecocup::getEcocupByID($offer["desir"])." et recherche l'écocup ".Ecocup::getEcocupByID($offer["don"]).". Envoie lui un mail à son adresse etu pour conclure l'échange.</li>";
    }
    echo "</ul>";
} else { ?>
        <div class="row">
            <div class="hero-unit">
                <h5>Pas d'offres correspondantes pour toi</h5>
                <p>Rassures-toi, tes offres sont gardées en mémoire et si quelqu'un pose une offre correspondante, il/elle te contactera.</p>
            </div>
        </div>
<?php
}

include_once(dirname(__FILE__).'/tail.php'); ?>