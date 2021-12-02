<?php
if (!isset($_SESSION['id_user'])) {
} else {
    $id_user = $_SESSION['id_user']; ?>
    <div class="jumbotron container-fluid">
        <div class="pt-4 page-heading">
            <h3>Profile Statistics</h3>
            <hr class="colorgraph">
        </div>
        <?php
        if (get_tmp_user($id_user) == -1) {
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
                                                    <th>
                                                        <?php
                                                            if( $value['tmp'] == 2 ) echo '<p style="font-size: 15px;">(Des)</p>';
                                                            if( $value['tmp'] == 3 ) echo '<p style="font-size: 15px;">(Arc)</p> ';
                                                        ?>
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
                                        <button data-toggle="modal" data-target=".membreAdd" class="btn btn-outline-info">
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
                                                        <form method="POST" id="supForm" action="../module/connect_mod/admin_mod.php">
                                                            <input type="hidden" name="supAction" id="supAction">
                                                            <input type="hidden" name="id_m" id="id_m" value="<?= $value['id_author']; ?>">
                                                            <button id="button" class="btn btn-outline-danger">Sup</button>
                                                        </form>
                                                    </th>
                                                    <th>

                                                        <?php
                                                        if ($value['tmp'] == 2) {
                                                        ?>
                                                            <form method="POST" id="actForm" action="../module/connect_mod/admin_mod.php">
                                                                <input type="hidden" name="actAction" id="actAction" value="actAction">
                                                                <input type="hidden" name="id_author" id="id_author" value="<?= $value['id_author']; ?>">
                                                                <button id="button" class="btn btn-outline-warning">Activ</button>
                                                            </form>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <form method="POST" id="descForm" action="../module/connect_mod/admin_mod.php">
                                                                <input type="hidden" name="actAction" id="descAction" value="descAction">
                                                                <input type="hidden" name="id_author" id="id_author" value="<?= $value['id_author']; ?>">
                                                                <button id="button" class="btn btn-outline-warning">Desc</button>
                                                            </form>
                                                        <?php
                                                        }

                                                        ?>
                                                    </th>
                                                    <th>
                                                        <?php
                                                        if ($value['tmp'] == 3) {
                                                        ?>
                                                            <form method="POST" id="arcForm" action="../module/connect_mod/admin_mod.php">
                                                                <input type="hidden" name="actAction" id="arcAction" value="desarchi">
                                                                <input type="hidden" name="id_author" id="id_author" value="<?= $value['id_author']; ?>">
                                                                <button id="button" class="btn btn-outline-success">DesArchi</button>
                                                            </form>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <form method="POST" id="arcForm" action="../module/connect_mod/admin_mod.php">
                                                                <input type="hidden" name="actAction" id="arcAction" value="arcAction">
                                                                <input type="hidden" name="id_author" id="id_author" value="<?= $value['id_author']; ?>">
                                                                <button id="button" class="btn btn-outline-success">Archiv</button>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
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
                    <div class="row container card" id="messages">
                        <div class="card-body col-sm-12">
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
                    <script>
                        setInterval('load_messages()', 100);

                        function load_messages() {
                            var loadmsg = '../vue/admin/traite_msg.php?iduser=<?= $id_user ?>'
                            $('#messages').load(loadmsg);
                        }
                    </script>
                    <div class="row container card">
                        <div class="col-sm-12 pt-2">
                            <form id="msgForm" name="msgForm" action="" method="POST">
                                <div class="form-group">
                                    <textarea class="form-control" id="msg" name="msg" placeholder="Votre message ..." rows="5"></textarea>
                                </div>
                                <input type="hidden" name="id_author" id="id_author" value="<?= $id_user; ?>">
                                <input type="hidden" name="sendMes" id="sendMsg" value="sendMes">
                                <div class="form-group pt-2">
                                    <button type="submit" id="bouton" class="btn btn-primary">Soumettre</button>
                                </div>
                            </form>
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
            if (get_tmp_user($id_user) == 2) {
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
<?php
}
?>

<!-- Modal -->
<div class="modal fade membreAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nouvelle Membre</h5>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../module/connect_mod/admin_mod.php" enctype="multipart/form-data">
                    <div class="col-sm-12 mb-4">
                        <label for="email">Entrez votre mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="identifiantd@nomdomaine" required>
                    </div>
                    <div class="col-sm-12 mb-4">
                        <label for="key">Votre code</label>
                        <select class="form-control" name="niveau" id="niveau" required>
                            <option></option>
                            <?php
                                foreach (get_niveau() as $key => $value) {
                                    ?>
                                        <option value="<?= $value['id_niveau'] ?>"><?= $value['lib_niveau'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="membreAdd" id="membreAdd">
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