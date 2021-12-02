<!-- La vue des questions -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h1 class="display-4 text-center">Listes des questions</h1>
            </div>
            <div class="col-sm-2">
                <a style="color: black;" href="../controler/index.php?pg=<?= md5('askform'); ?>"><button type="button" class="btn btn-outline-warning" style="color: black;">Poser une question</button></a>
            </div>
        </div>
        <?php
        if (isset($_REQUEST['erreurQuestionExisite'])) {
        ?>
            <hr>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <p class="alert alert-danger">Désolé cette question à déjà été posée</p>
                </div>
            </div>
        <?php
        }
        ?>
        <hr>
        <div class="row">
            <?php
            foreach (get_post_question() as $key => $value) {
                $id_question = $value['id_post'];
            ?>
                <div class="col-sm-6">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <a href="../controler/index.php?pg=<?= md5('showask') . '&' . md5('id_question') . '=' . $id_question; ?>">
                                <p><?= get_question_title($id_question) ?></p>
                            </a>
                            <footer class="blockquote-footer">Publié le : <cite title="Date"><?= get_question_date($id_question); ?></cite> <br> ___Par : <cite title="Date"><?= get_question_user_name($id_question); ?></cite></footer>
                        </blockquote>
                        <?php
                                    if (isset($_SESSION['id_user']))
                                        if (admin( clean_champs( $_SESSION['id_user'] ) )) {
                                    ?>
                                            <form method="POST" action="../module/askMod/askformMod.php">
                                                <input type="hidden" value="<?= $id_question; ?>" name="id_question" id="id_question">
                                                <input type="hidden" name="actionAsk" value="deleteAsk">
                                                <button type="submit" class="btn btn-outline-danger">Supprimer la question</button></button>
                                            </form>
                                    <?php
                                        }
                                    ?>
                    </div>
                    <hr>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>