<?php include(dirname(__FILE__).'/head.php'); 

use App\Core\GenHtml as GenHtml;
?>
        <div class="row">
          <div class="span10 offset1">
            <?php echo GenHtml::genResumeOffers($_SESSION['user']); ?>
          </div>
          <div class="well span12">
            <h3 class="text-left">Si toi aussi …</h3>
              <div class="text-center">
                <p>Tu as une (ou plusieurs écocups) dont tu veux te débarasser</p>
                <p>Tu souhaites les échanger contre d'autres</p>
              </div>
            <h3 class="text-right">… alors tu es au bon endroit !</h3>
          </div>
					<form class="form-inline" method="post" action="index.php">
              <div class="span6">
                <p>Écocup que tu souhaites donner</p>
                <select id="donInput" name="input">
                  <?php echo GenHtml::genSelectList(); ?>
                </select>
              </div>
              <div class="span6">
                  <p>Écocup(s) que tu souhaites recevoir<br><small>(Maintiens CTRL pour en sélectionner plusieurs)</small></p>
                  <select size="5" multiple name="output[]">
                  <?php echo GenHtml::genSelectList(); ?>
                  </select>
              </div>
              <div class="span6 offset3 text-center">
                <button class="btn btn-primary" type="submit">Envoyer</button>
              </div>
					</form>
        </div>
<?php include(dirname(__FILE__).'/tail.php'); ?>
