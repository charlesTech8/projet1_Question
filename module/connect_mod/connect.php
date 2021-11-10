<?php
/**
 * Ici nous alors faire le traitement des formulaire de
 * connexion et d'inscription
 */

/**
 * Appel à la fonction de la connexion et des autres fonctions
 */
require_once( '../general/generalFonction.php' );

//IDEE
//Pour l'email je dois utiliser les cockier pour enregistre l'email d'un utilisateur deja inscris

if( isset( $_POST['actionCon'] ) ){
    if( $_POST['actionCon'] == 'connexion' ){
        $email = clean_champs( $_POST['email'] );
        $pwd = clean_pass( $_POST['pwd'] );

        if( ( $id_us = connectMail( $email, $pwd ) ) != -1 ){
            $_SESSION['id_user'] = $id_us;
        }else{
            errorRedirect( '../../controler/index.php','erreurCon' );
            exit;
        }
        
    }else if( $_POST['actionCon'] == 'inscrip' ){
        
    }else{
        errorRedirect( '../../controler/index.php','erreurC' );
        exit;
    }
}else{
    redirect_page( '../../controler/index.php' );
    exit;
}