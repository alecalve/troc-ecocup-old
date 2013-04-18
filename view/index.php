<?php include(dirname(__FILE__).'/head.php'); 

use App\Core\Ecocup as Ecocup;


?>
        <div class="row">
            <div class="well">
                <h3 class="text-left">Si toi aussi …</h3>
                <div class="text-center">
                    <p>Tu as une (ou plusieurs écocups) dont tu veux te débarasser</p>
                    <p>Tu souhaites les échanger contre d'autres</p>
                </div>
                <h3 class="text-right">… alors tu es au bon endroit !</h3>
            </div>
            <form method="post" action="index.php">
                <div class="span6">
                    <h4>Quelle(s) écocup(s) possèdes-tu ?</h4>
                    <?php echo Ecocup::genRadioList("dons"); ?>
                </div>
                <div class="span6">
                    <h4>Quelle(s) écocup(s) désires-tu ?</h4>
                    <?php echo Ecocup::genCheckList("desirs"); ?>
                </div>
                <div class="row">
                    <div class="span12 text-center">
                        <button id="add">Ajouter l'écocup à ma liste</button>
                        <button type="submit">Valider ma liste</button>
                    </div>
                </div>
            </form>


        </div>
<?php include(dirname(__FILE__).'/tail.php'); ?>
