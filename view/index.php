<?php 
include(dirname(__FILE__).'/head.php');
include_once(dirname(__DIR__).'/class/Ecocup.class.php');
$ecocups = Ecocup::getEcocups();
 ?>
        <div class="page-header">
            <h1>Bienvenue sur Troc'Écocup <i>v2</i></h1>
            <p>Quoi de neuf <?php echo $_SESSION['user']?> ?</p>
        </div>
        <div class="row">
            <div class="well">
                <h3 class="text-left">Si toi aussi …</h3>
                <div class="text-center">
                    <p>Tu as une (ou plusieurs écocups) dont tu veux te débarasser</p>
                    <p>Tu souhaites les échanger contre d'autres</p>
                </div>
                <h3 class="text-right">… alors tu es au bon endroit !</h3>
            </div>
            <form method="post" action="form.php">
                <div class="span6 text-center">
                    <h4>Quelles écocup(s) possèdes-tu ?</h4>
                    <?php echo Ecocup::genSelectList("dons"); ?>
                </div>
                <div class="span6 text-center">
                    <h4>Quelles écocup(s) désires-tu ?</h4>
                    <?php echo Ecocup::genSelectList("desirs"); ?>
                </div>
                <div class="row">
                    <div class="span12 text-center">
                        <button type="submit">Rechercher</button>
                    </div>
                </div>
            </form>


        </div>
<?php include(dirname(__FILE__).'/tail.php'); ?>
