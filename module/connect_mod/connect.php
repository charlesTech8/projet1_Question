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

if (isset($_POST['actionCon'])) {
    if ($_POST['actionCon'] == 'connexion') {
        $email = clean_champs($_POST['email']);
        $pwd = clean_pass($_POST['pwd']);

        if (($id_us = connectMail($email, $pwd)) != -1) {
            $_SESSION['id_user'] = $id_us;
            redirect_page('accueil');
        } else {
            errorRedirect('connexion','', 'erreurCon');
            exit;
        }
    } else if ($_POST['actionCon'] == 'inscrip') {
        if (isset($_POST['email']) && isset($_POST['pwd'])) {
            $url = 'nom=' . $_POST['nom'] . '&prenom=' . $_POST['prenom'] . '&email=' . $_POST['email'];
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['confirmPwd'])) {
                errorRedirect('connexion', $url, 'erreurChamps');
                exit;
            } else {
                $nom = clean_champs( $_POST['nom'] );
                $prenom = clean_champs( $_POST['prenom'] );
                $email = clean_champs( $_POST['email'] );
                $pwd1 = clean_pass( clean_champs( $_POST['pwd'] ) );
                $pwd2 = clean_pass( clean_champs( $_POST['confirmPwd'] ) );
                if( $pwd1 != $pwd2 ){
                    errorRedirect('connexion', $url, 'erreurPass');
                    exit;
                }else{
                    if( mailExist( $email ) == TRUE ){
                        errorRedirect('connexion',$url, 'erreurIns');
                        exit;
                    }else{
                        $sql_ins = $connexion->prepare(
                            'INSERT INTO inscris( 
                                id_author, nom_author, prenom_author, email_author, password_author, id_niveau, tmp 
                                ) 
                            VALUES ( 
                                :id_user, :nom, :prenom, :email, :pwd, :id_niveau, :tmp 
                            )'
                        );
                        $sql_ins->execute(
                            array(
                                'id_user'   => NULL,
                                'nom'       => $nom,
                                'prenom'    => $prenom,
                                'email'     => $email,
                                'pwd'       => $pwd1,
                                'id_niveau' => 2,
                                'tmp'       => 'n'
                            )
                        );
                        $sql_ins->closeCursor();
                        setcookie('email', $email, time() + 365*24*3600, null, null, false, true);
                        redirect_page( 'validationMail' );
                    }
                }
            }
        }
    } else {
        errorRedirect('connexion','', 'erreurC');
        exit;
    }
} else {
    redirect_page('connexion');
    exit;
}