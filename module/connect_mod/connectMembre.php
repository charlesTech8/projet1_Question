<?php

/**
 * Appel à la fonction de la connexion et des autres fonctions
 */
require_once('../general/generalFonction.php');

if (!empty($_POST['pwd']) && !empty($_POST['nom'])) {
    $nom = clean_champs($_POST['nom']);
    $prenom = clean_champs($_POST['prenom']);
    $id_user = clean_champs($_POST['id_aut']);
    $pass = clean_pass($_POST['pwd']);

    $sql_upd = $connexion->prepare(
        'UPDATE inscris SET nom_author = :nom, prenom_author = :prenom, password_author = :pass, tmp = :tmp WHERE id_author = ' . $id_user
    );
    try {
        $sql_upd->execute(
            array(
                'nom'       => $nom,
                'prenom'    => $prenom,
                'pass'      => $pass,
                'tmp'       => -1
            )
        );
    } catch (\Throwable $th) {
        errorRedirect('connexion', '', 'erreurC');
        exit;
    }
    $sql_upd->closeCursor();
    errorRedirect('connexion', '', 'mailValide');
    exit;
}else{
    errorRedirect('connexion', '', 'erreurC');
    exit;
}
