<?php
if (isset($_REQUEST['email'], $_REQUEST['key']) && !empty($_REQUEST['email']) && !empty($_REQUEST['key'])) {
    $email = $_REQUEST['email'];
    $key = $_REQUEST['key'];

    $id_auth = isMembre($email, $key);
    if ($id_auth != -1) {

?>
<div class="container pt-5">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            <h4>Bienvenue chère membre</h4>
            <hr>
            <form method="POST" action="../module/connect_mod/connectMembre.php" enctype="multipart/form-data">
            <input type="hidden" name="actionCon" id="actionCon" value="inscrip">
            <fieldset>
                <div class="form-row">
                    <div class="col-sm-6 mb-4">
                        <label for="nom">Nom *</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom" required>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="prenom">Prénoms *</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prénom" required>
                    </div>
                    <div class="col-sm-12 mb-4">
                        <label for="email">Entrez votre mail</label>
                        <input type="email" disabled class="form-control" name="email" id="email" value="<?=$email; ?>" required>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="email">Mot de passe *</label>
                        <input type="password" name="pwd" class="form-control" id="pwd" required>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="email">Confirmation *</label>
                        <input type="password" name="confirmPwd" class="form-control" id="confirmPwd" required>
                    </div>
                    <input type="hidden" name="id_aut" id="id_aut" value="<?= $id_auth ;?>">
                    <div class="col-md-6 mb-4">
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        </div>
</div>
<?php
    } else {
        exit;
    }
}
