<div class="container">
    <div class="row">
        <div class="col-sm-5 pt-4">
            <div class="h_blog_img">
                <img class="img-fluid" src="../vue/font.jpg" alt="Image" />
            </div>
            <p>
                Avec <strong>WE CAN</strong> posez toutes sortes questions
            </p>
            <hr class="colorgraph">
            <strong>Merci pour la confiance</strong>
        </div>
        <div class="col-sm-1"></div>
        <form method="POST" action="../module/connect_mod/connect.php" class="col-sm-6 pt-5">
            <legend><strong>CONNEXION</strong></legend>
            <?php
            if (isset($_REQUEST['error'])) {
                erroExist($_REQUEST['error']);
            } ?>
            <hr class="colorgraph">
            <div class="form-row">
                <div class="col-md-12 mb-4">
                    <label for="prenom">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_COOKIE['email']))  echo clean_champs($_COOKIE['email']); ?>" required>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="prenom">Mot de passe: </label>
                    <input type="password" class="form-control" name="pwd" id="pwd" required>
                </div>
                <input type="hidden" name="actionCon" id="actionCon" value="connexion">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-primary">CONNEXION</button>
                </div>
                <div class="col-md-12 mb-4">
                    <p>
                        Si vous n'avez pas encore un compte,
                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Cliquez ici</a>
                        pour créer votre compte <br>
                        Ou <a href="#" data-toggle="modal" data-target=".validation">Cliquez-ici </a> pour valider votre adresse email
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulaire d'inscription</h5>
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../module/connect_mod/connect.php" enctype="multipart/form-data">
                    <input type="hidden" name="actionCon" id="actionCon" value="inscrip">
                    <fieldset>
                        <div class="form-row">
                            <div class="col-sm-6 mb-4">
                                <label for="nom">Nom *</label>
                                <input type="text" style="<?php if (isset($_REQUEST['nom']) && empty($_REQUEST['nom']))  echo 'border-color: red'; ?>" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom" value="<?php if (isset($_REQUEST['nom']))  echo clean_champs($_REQUEST['nom']); ?>" required>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="prenom">Prénoms *</label>
                                <input type="text" style="<?php if (isset($_REQUEST['prenom']) && empty($_REQUEST['prenom']))  echo 'border-color: red'; ?>" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prénom" value="<?php if (isset($_REQUEST['prenom']))  echo clean_champs($_REQUEST['prenom']); ?>" required>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="email">Entrez votre mail</label>
                                <input type="email" style="<?php if (isset($_REQUEST['email']) && empty($_REQUEST['email']))  echo 'border-color: red'; ?>" class="form-control" name="email" id="email" placeholder="identifiantd@nomdomaine" value="<?php if (isset($_REQUEST['email']))  echo clean_champs($_REQUEST['email']); ?>" required>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="email">Mot de passe *</label>
                                <input type="password" name="pwd" class="form-control" id="pwd" required>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="email">Confirmation *</label>
                                <input onkeyup="checkPass();" type="password" name="confirmPwd" class="form-control" id="confirmPwd" minlength="8" required>
                                <div style="color: red;" id="info"></div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade validation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Validation d'email</h5>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="../module/connect_mod/confirmation.php" enctype="multipart/form-data">
                    <div class="col-sm-12 mb-4">
                        <label for="email">Entrez votre mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="identifiantd@nomdomaine" value="<?php if (isset($_COOKIE['email']))  echo clean_champs($_COOKIE['email']); ?>" required>
                    </div>
                    <div class="col-sm-12 mb-4">
                        <label for="key">Votre code</label>
                        <input type="number" min="0" class="form-control" name="key" id="key" placeholder="0000000000" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <button type="submit" class="btn btn-primary">S'authentifier</button>
                    </div>
            </div>
            </fieldset>
            </form>
        </div>
    </div>
</div>
</div>