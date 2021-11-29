<?php
//Traitement de la partie admin

require 'vendor/autoload.php';
use \Mailjet\Resources;

require_once('../general/generalFonction.php');
if( isset( $_POST['action'] ) && !empty( $_POST['action'] ) && !empty($_POST['msg'])){
    $msg = clean_champs( $_POST['msg'] );
    $id_author = clean_champs( $_POST['iduser'] );
    $date_s = date('Y-m-d');
    $sql_ins = $connexion->prepare(
        'INSERT INTO post(
            id_post, post_title, contenu_q_r, date_send, type_post, id_author, id_post_question, fermer
        ) 
        VALUES (
            :id_post, :post_title, :contenu_q_r, :date_send, :type_post, :id_author, :id_post_question, :fermer
        )'
    );
        $sql_ins->execute(
            array(
                'id_post'           => NULL, 
                'post_title'        => '', 
                'contenu_q_r'       => $msg, 
                'date_send'         => $date_s, 
                'type_post'         => '_chat_general', 
                'id_author'         => $id_author, 
                'id_post_question'  => NULL, 
                'fermer'            => NULL
            )
        );
    $sql_ins->closeCursor();
    echo 'Bien';
}

if( isset( $_POST['supAction'] ) ){
    $id_u = clean_champs( $_POST['id_m'] );
    $sql_del = $connexion->prepare(
        'UPDATE inscris SET id_niveau = :idniv WHERE id_author = '.$id_u
    );
    try {
        $sql_del->execute(
            array(
                'idniv' => 3
            )
        );
    } catch (\Throwable $th) {
        //throw $th;
    }
    $sql_del->closeCursor();
    redirect_page('admin');
    exit;
}

if( isset( $_POST['actAction'] ) ){
    $id_u = clean_champs( $_POST['id_author'] );
    $sql_del = $connexion->prepare(
        'UPDATE inscris SET tmp = :tmp WHERE id_author = '.$id_u
    );
    try {
        if( $_POST['actAction'] == 'actAction' ){
            $sql_del->execute( array('tmp' => -1) );
        }
        if( $_POST['actAction'] == 'descAction' ){
            $sql_del->execute( array('tmp' => 2) );
        }
        if( $_POST['actAction'] == 'arcAction' ){
            $sql_del->execute( array('tmp' => 3) );
        }
        if( $_POST['actAction'] == 'desarchi' ){
            $sql_del->execute( array('tmp' => -1) );
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
    $sql_del->closeCursor();
    redirect_page('admin');
    exit;
}

if( isset( $_POST['membreAdd'] ) && !empty( $_POST['email'] ) ){
    $email = clean_champs( $_POST['email'] );
    $niveau = clean_champs( $_POST['niveau'] );
    
    if( mailExist( $email ) == TRUE ){
        redirect_page('admin');
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
                'Name' => 'Membres'
                ]
            ],
            'Subject' => "Confirmation de mail",
            'TextPart' => "Confirmez votre adresse e-mail",
            'HTMLPart' => "
            <a href='http://127.0.0.1/projet1Question/controler/index.php?pg=".md5( 'confirmation' )."&email=".$ma."&key=".$key."'>Confirmez votre compte en cliquant ici</a>
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
                    'nom'       => '-',
                    'prenom'    => '-',
                    'email'     => $email,
                    'pwd'       => NULL,
                    'id_niveau' => $niveau,
                    'tmp'       => $key
                )
            );
            $sql_ins->closeCursor();
            redirect_page('admin');
            exit;
        } catch (\Throwable $th) {
            redirect_page('admin');
            exit;
        }
        //*************************************************************************************** */
    }
}