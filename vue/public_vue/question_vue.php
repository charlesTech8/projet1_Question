<!-- La vue des questions -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h1 class="display-4 text-center">Listes des questions</h1>
            </div>
            <div class="col-sm-2">
            <a style="color: black;" href="../controler/index.php?pg=<?php echo md5('askform');?>"><button type="button" class="btn btn-warning">Poser une question</button></a>
            </div>
        </div>
        <div class="row">
            <?php
            foreach (get_post_question() as $key => $value) {
                $id_question = $value['id_post'];
            ?>
                <div class="col-sm-6">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <a href="../controler/index.php?pg=<?php echo md5('showask').'&'.md5('id_question').'='.$id_question; ?>">
                                <p><?php echo get_question_title( $id_question ) ?></p>
                            </a>
                            <footer class="blockquote-footer">Publié le : <cite title="Date"><?php echo get_question_date($id_question); ?></cite> <br> ___Par : <cite title="Date"><?php echo get_question_user_name( $id_question ) ; ?></cite></footer>
                        </blockquote>
                    </div>
                    <hr>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>