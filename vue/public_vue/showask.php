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
                            <footer class="blockquote-footer">Publié le : <cite title="Date"><?php echo get_question_date($id_question); ?></cite> <br> ___Par : <cite title="Date"><?php echo get_question_user_name( $id_question ) ; ?></cite></footer>
                        </div>
                        <div class="card-footer">Commentaires_____________________
                            <a style="color: red;" href="#">
                                <?php
                                    if(isset( $_SESSION['id_user'] ))
                                        if (get_question_user_id($id_question) == $_SESSION['id_user']) 
                                            echo 'Fermer la question' 
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="" method="">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">COMMENTER ...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Commentaire ..." rows="8"></textarea>
                        </div>
                    </form>
                </div>
            </div>
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