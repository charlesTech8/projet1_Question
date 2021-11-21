<!-- Formulaire des questions -->
<?php
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
  errorRedirect1('connexion', 'error');
  exit;
}
?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3>Votre question</h3>
        <p class="alert alert-primary text-center" role="alert">
          NB: Posez votre question tout en permettant autres membres de vous comprendre afin de vous aider à trouver une solution à votre problème.
        </p>
        <form action="../module/askMod/askformMod.php" method="post" enctype="multipart/form-data">
          <p>
            <input type="text" class="form-control" name="titre_ask" id="titre_ask" placeholder="Votre question" required>
          </p>
          <div class="form-group">
            <textarea class="form-control" id="askform" name="askform" placeholder="Les détails de la question ..." rows="8"></textarea>
          </div>
          <div id="code_ask" style="display:none;" class="form-group">
            <div class="form-group">
              <textarea class="form-control" id="code_form" name="code_form" style="background-color: black;" placeholder="</ >" rows="8"></textarea>
            </div>
          </div>
          <div id="img_ask" style="display: none;" class="form-group">
            <p class="alert alert-primary text-left"> <strong>NB: </strong> Ajouter une image claire et nette au format .PNG </p>
            <label>Ajouter une image</label>
            <input type="file" name="img" id="img">
          </div>
          <input style="color: blue;" type="button" value="Ajouter du code" onclick="hideThis('code_ask')" />
          <input style="color: blue;" type="button" value="Ajouter une image" onclick="hideThis('img_ask')" />
          <input type="hidden" name="id_author" id="id_author" value="<?= $_SESSION['id_user']; ?>">
          <input type="hidden" name="actionAsk" value="newAsk">
          <div class="form-group pt-2">
            <button type="submit" class="btn btn-primary">Soumettre</button>
          </div>
        </form>
      </div>
      <div class="col-sm-4">
        <div class="card border-light mb-3">
          <div class="card-header"><strong>LES QUESTIONS</strong></div>
          <div class="card-body">
            <?php
            foreach (get_last_question() as $key => $value) {
              $id_question1 = $value['id_post'];
            ?>
              <a href="../controler/index.php?pg=<?php echo md5('showask') . '&' . md5('id_question') . '=' . $id_question1; ?>">
                <p><?php echo get_question_title($id_question1) ?></p>
              </a>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>