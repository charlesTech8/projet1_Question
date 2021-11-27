<?php
//Nous allons procéder à la confirmation du mail d'un utilisateur;
require_once('../general/generalFonction.php');
if( isset( $_GET['email'], $_GET['key'] ) AND !empty( $_GET['email'] ) AND !empty( $_GET['key'] ) ){
    $email = clean_champs( urldecode( $_GET['email'] ) );
    $key = clean_champs( $_GET['key'] );

    $sql_requete = $connexion->prepare(
        "SELECT email_author, tmp FROM inscris WHERE email_author = :email AND tmp = :tmp"
    );
    $sql_requete->execute(
        array(
            'email' => $email,
            'tmp'   => $key
        )
    );
    $userExist = $sql_requete->rowCount();
    if($userExist == 1){
        $user = $sql_requete->fetch();
        if($user['tmp'] != -1){
            $userUpdate = $connexion->prepare(
                'UPDATE inscris SET tmp = -1 WHERE email_author = :email AND tmp = :tmp'
            );
            $userUpdate->execute(
                array(
                    'email' => $email,
                    'tmp'   => $key
                )
            );
            $userUpdate->closeCursor();
            errorRedirect('connexion','','mailValide');
            exit;
        }else{
            errorRedirect('connexion','','errorMailNonExist');
            exit;
        }
    }else{
        errorRedirect('connexion','','errorMailNonExist');
        exit;
    }
}
