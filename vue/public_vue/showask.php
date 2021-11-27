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
                            <h5 class="card-title"><?= stripslashes(get_question_title($id_question)); ?></h5>
                            <p class="card-text">
                                <?php
                                    $contenu =  unserialize( (get_question_contenu($id_question)) );
                                    if( $contenu['details'] != "" ){
                                        echo stripslashes( nl2br( $contenu['details'] ) );
                                    }
                                    //stripslashes(get_question_contenu($id_question)); 
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-8">
                                    <footer class="blockquote-footer">Publié le : <cite title="Date"><?= get_question_date($id_question); ?></cite> <br> ___Par : <cite title="Date"><?= get_question_user_name($id_question); ?></cite></footer>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <?php
                                    if (isset($_SESSION['id_user']))
                                        if (get_question_user_id($id_question) == $_SESSION['id_user']) {
                                            if (close_question($id_question) != '_close') {
                                    ?>
                                            <form method="POST" action="../module/askMod/askformMod.php">
                                                <input type="hidden" value="<?= $id_question; ?>" name="id_question" id="id_question">
                                                <input type="hidden" name="actionAsk" value="closeAsk">
                                                <button type="submit" class="btn btn-outline-primary">Fermer la question</button></button>
                                            </form>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    if( $contenu['code'] != "" ){
                        ?>
                        <div class="form-group">
                          <textarea disabled class="form-control" id="code_form" name="code_form" style="font-size:small;color:antiquewhite; background-color: black;" placeholder="</ >" rows="12"><?=stripslashes(( $contenu['code'] ) ) ;?></textarea>
                        </div>
                                    
                        <?php
                    }
                    if( get_ling_img( $id_question ) != "" ){
                        ?>
                            <div class="row">
                                <div class="col-sm-10"></div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Voir l'image</button>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            <h4 class="text-center alert alert-primary">Les commentaires</h4>
            <div class="row pt-5">
                <?php
                $i = 1;
                foreach (get_post_quest_answ($id_question) as $key => $value) {
                ?>
                    <div class="col-sm-2"><button class="btn btn-danger" style="border-radius: 50%;"><?= $i++; ?></button></div>
                    <div class="col-sm-10">
                        <p> <?=nl2br( stripslashes($value['contenu_q_r']) ); ?> </p>
                        <p><cite title="Date">Publié le : <?= nl2br($value['date_send']); ?> </cite></p>
                        <hr class="pt-3">
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
            if (close_question($id_question) == '_close') {
            ?>
                <p class="alert alert-warning text-center" style="color:black;">
                    La discussion est fermée.
                </p>
            <?php
            } else {
            ?>
                <div class="row pt-5">
                    <div class="col-sm-12">
                        <form action="../module/askMod/askformMod.php" method="post">
                            <div class="form-group">
                                <label for="commenter_form">COMMENTER ...</label>
                                <textarea class="form-control" name="commenter_form" id="commenter_form" placeholder="Votre commentaire ..." rows="8"></textarea>
                            </div>
                            <input type="hidden" name="actionAsk" value="commenter">
                            <input type="hidden" name="id_post" value="<?= $id_question; ?>">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Commenter</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>
        <div class="col-sm-4">
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
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <img src="../documents/<?=get_ling_img( $id_question ) ;?>" title="">
    </div>
  </div>
</div>