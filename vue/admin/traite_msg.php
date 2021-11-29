<div class="card-body col-sm-12">
    <?php
    require_once( '../../module/general/generalFonction.php' );
    $id_user = clean_champs( $_REQUEST['iduser'] );
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