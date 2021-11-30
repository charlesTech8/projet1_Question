<?php
/**
 * Ici nous alors faire le traitement des formulaire de
 * connexion et d'inscription
 */

require 'vendor/autoload.php';
use \Mailjet\Resources;

/**
 * Appel à la fonction de la connexion et des autres fonctions
 */
require_once( '../general/generalFonction.php' );

//IDEE
//Pour l'email je dois utiliser les cookie pour enregistre l'email d'un utilisateur deja inscris

//connection pour un utilisateur possédant un compte
if (isset($_POST['actionCon'])) {
    if ($_POST['actionCon'] == 'connexion') {
        //forcer l'utilisateur à entrer un email et un mot de pass valide en interdisant les injections sql
        $email = clean_champs($_POST['email']);
        $pwd = clean_pass($_POST['pwd']);
        
        //récupéré l'id de l'utilisateur pour vérifier si ce dernier a un compte
        if (($id_us = connectMail($email, $pwd)) != -1) {
            $_SESSION['id_user'] = $id_us;
            redirect_page('accueil');
        } else {
            errorRedirect('connexion','', 'erreurCon');
            exit;
        }
    } else if ($_POST['actionCon'] == 'inscrip') {
        //si les variables email et mot de pass exitent et sont vident alors le programme renvoie une erreur si non on récupère les informations
        if (isset($_POST['email']) && isset($_POST['pwd'])) {
            $url = 'nom=' . $_POST['nom'] . '&prenom=' . $_POST['prenom'] . '&email=' . $_POST['email'];
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['confirmPwd'])) {
                errorRedirect('connexion', $url, 'erreurChamps');
                exit;
            } else {
                //on vérifie si l'email exite puis on envoie un mail de confirmation. Si non l'utilisateur sera obligé de créer un compte
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
                        $key = cleActivation(); //Récupération de la clé d'activation

                        //Confirmation de mail*********************************************************************

                        
                        $mj = new \Mailjet\Client('93496347bcb32d8cef5550f93bd26e72','dfd117c0a2620031a8a564831d792961',true,['version' => 'v3.1']);
                        $ma = urlencode($email);
                        $body = [
                        'Messages' => [
                            [
                            'From' => [
                                'Email' => "gboyoucharles.tech@gmail.com",
                                'Name' => "WE CAN"
                            ],
                            'To' => [
                                [
                                'Email' => $email,
                                'Name' => $nom
                                ]
                            ],
                            'Subject' => "Confirmation de mail",
                            'TextPart' => "Confirmez votre adresse e-mail",
                            'HTMLPart' => "
                            <a href='http://127.0.0.1/projet1Question/module/connect_mod/confirmation.php?email=".$ma."&key=".$key."'>Confirmez votre compte en cliquant ici</a>
                            <p>Votre code de confirmation est : <h3>".$key."</h3></p>
                            ",
                            'CustomID' => "AppGettingStartedTest"
                            ]
                        ]
                        ];
                        try {
                            $response = $mj->post(Resources::$Email, ['body' => $body]);
                            $response->success() && var_dump($response->getData());
                            $sql_ins->execute(
                                array(
                                    'id_user'   => NULL,
                                    'nom'       => $nom,
                                    'prenom'    => $prenom,
                                    'email'     => $email,
                                    'pwd'       => $pwd1,
                                    'id_niveau' => 2,
                                    'tmp'       => $key
                                )
                            );
                            $sql_ins->closeCursor();
                            setcookie('email', $email, time() + 365*24*3600, null, null, false, true);
                            errorRedirect('connexion','','valideTonMail');
                            exit;
                        } catch (\Throwable $th) {
                            errorRedirect('connexion','', 'erreurC');
                            exit;
                        }
                        //*************************************************************************************** */
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