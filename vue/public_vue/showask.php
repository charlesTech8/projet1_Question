<!-- Voir en details une question et pouvoir commenter -->
<?php
$id_question = clean_champs(($_REQUEST[md5('id_question')]));
?>
<div class="jumbotron">
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-dark mb-3">
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo get_question_title($id_question); ?></h5>
                            <p class="card-text"><?php echo get_question_contenu($id_question); ?></p>
                        </div>
                        <div class="card-footer">
                            <footer class="blockquote-footer">Publié le : <cite title="Date"><?php echo get_question_date($id_question); ?></cite> <br> ___Par : <cite title="Date"><?php echo get_question_user_name($id_question); ?></cite></footer>
                            <a style="color: red;" href="#">
                                <?php
                                if (isset($_SESSION['id_user']))
                                    if (get_question_user_id($id_question) == $_SESSION['id_user'])
                                        echo 'Fermer la question'
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="text-center alert alert-primary">Les commentaires</h4>
            <div class="row pt-5">
                <?php
                $i = 1;
                foreach (get_post_quest_answ($id_question) as $key => $value) {
                ?>
                    <div class="col-sm-2"><button class="btn btn-danger" style="border-radius: 50%;"><?=$i++ ;?></button></div>
                    <div class="col-sm-10">
                        <p> <?=$value['contenu_q_r']; ?> </p>
                        <p><cite title="Date">Publié le :  <?=nl2br( $value['date_send'] ); ?> </cite></p>
                        <hr class="pt-3">
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row pt-5">
                <div class="col-sm-12">
                    <form action="../module/askMod/askformMod.php" method="post">
                        <div class="form-group">
                            <label for="commenter_form">COMMENTER ...</label>
                            <textarea class="form-control" id="commenter_form" placeholder="Votre commentaire ..." rows="8"></textarea>
                        </div>
                        <input type="hidden" name="actionAsk" value="commenter">
                        <input type="hidden" name="id_post" value="<?= $id_question; ?>">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Commenter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-light mb-3">
                <div class="card-header">
                    <strong>LES QUESTIONS</strong><br>
                    <a href="../controler/index.php?pg=<?php echo md5('askform'); ?>">Poser une question</a>
                </div>
                <div class="card-body">
                    <?php
                    foreach (get_last_question() as $key => $value) {
                        $id_question1 = $value['id_post'];
                    ?>
                        <a style="color: purple;" href="../controler/index.php?pg=<?php echo md5('showask') . '&' . md5('id_question') . '=' . $id_question1; ?>">
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