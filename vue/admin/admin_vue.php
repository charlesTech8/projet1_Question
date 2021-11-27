<?php $id_user = $_SESSION['id_user']; ?>
<div class="jumbotron container-fluid">
    <div class="pt-4 page-heading">
        <h3>Profile Statistics</h3>
        <hr class="colorgraph">
    </div>
    <?php
    if (get_niveau_user($id_user) == -1) {
    ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= get_user_prenom($id_user) . ' @ ' . get_user_nom($id_user); ?></h5>
                                <hr>
                            </div>
                        </div>
                        <h6 style="text-align: center;" class="text-muted mb-0"><?= get_email($id_user) ?></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Membres</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="px-4 py-3">
                            <table class="table table-hover">
                                <tbody>
                                    <?php
                                    foreach (get_membre() as $key => $value) {
                                    ?>
                                        <div class="name ms-4">
                                            <tr>
                                                <th scope="row">
                                                    <?= $value['prenom_author'] . ' @ ' . text_maj($value['nom_author']); ?>
                                                </th>
                                            </tr>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row card">
                    <div class="col-sm-12 pt-4">
                        <div class="row">
                            <div class="col-sm-4 text-left">
                                <h4><span>Nombre Inscris <span style="color:deeppink;"><strong><?= get_number_user(); ?></strong></span></span></h4>
                            </div>
                            <?php
                            if (isAdmin($id_user) == TRUE) {
                            ?>
                                <div class="col-sm-4 text-right">
                                    <button class="btn btn-outline-info">
                                        Ajouter un membre
                                    </button>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <input class="btn btn-outline-warning" style="color: blue;" type="button" value="Membre Action" onclick="hideThis('membres')" />
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                </div>
                <?php
                if (isAdmin($id_user) == TRUE) {
                ?>
                    <div class="row card" id="membres" style="display: none;">
                        <table class="table table-hover table-dark">
                            <th colspan="4" class="text-center"><strong>Membres</strong></th>
                            <tbody>
                                <?php
                                foreach (get_membre() as $key => $value) {
                                    if ($value['id_niveau'] != 1) {
                                ?>
                                        <div class="name ms-4">
                                            <tr>
                                                <th scope="row">
                                                    <?= $value['prenom_author'] . ' @ ' . text_maj($value['nom_author']); ?>
                                                </th>
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-outline-danger">Sup</button>
                                                    </a>
                                                </th>
                                                <th>

                                                    <?php
                                                    if ($value['tmp'] == 1) {
                                                    ?>
                                                        <a href="" ><button class="btn btn-outline-warning">Act</button></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href=""><button class="btn btn-outline-warning">Desc</button></a>
                                                    <?php
                                                    }

                                                    ?>
                                                </th>
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-outline-success">Arc</button>
                                                    </a>
                                                </th>
                                            </tr>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 text-center">
                        <h3>Discussion Générale</h3>
                    </div>
                </div>
                <div class="row container card">
                    <div class="card-body">
                        <?php
                        foreach (get_general_chat() as $key => $value) {
                            if ($value['id_author'] == $id_user) {
                        ?>
                                <div class="text-right">
                                    <div class="ms-3 name">
                                        <footer class="blockquote-footer">Envoyé: <cite title="Date"><?= $value['date_send'] . ' | ' . get_user_prenom($value['id_author']) . '@' . text_maj(get_user_nom($value['id_author'])); ?></cite> </footer>
                                        <p style="font-size: 20px;color:blue"><?= $value['contenu_q_r']; ?></p>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="text-left">
                                    <div class="ms-3 name">
                                        <footer class="blockquote-footer">Envoyé: <cite title="Date"><?= $value['date_send'] . ' | ' . get_user_prenom($value['id_author']) . '@' . text_maj(get_user_nom($value['id_author'])); ?></cite> </footer>
                                        <p style="font-size: 20px;color:indigo"><?= $value['contenu_q_r']; ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <strong>LES QUESTIONS</strong><br>
                        <a href="../controler/index.php?pg=<?= md5('askform'); ?>">Poser une question</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                                <?php
                                foreach (get_last_question() as $key => $value) {
                                    $id_question1 = $value['id_post'];
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <a style="color: purple;" href="../controler/index.php?pg=<?= md5('showask') . '&' . md5('id_question') . '=' . $id_question1; ?>">
                                                <p><?= stripslashes(get_question_title($id_question1)); ?></p>
                                            </a>
                                        </th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        if (get_niveau_user($id_user) == 2) {
        ?>
            <div class="row">
                <p class="alert alert-danger">
                    Votre compte a été désactiver. Ecrivez à l'administracteur.
                </p>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <p class="alert alert-danger">
                    Compte archiver ou désactiver. Ecrivez à l'administracteur.
                </p>
            </div>
    <?php
        }
    }
    ?>
</div>