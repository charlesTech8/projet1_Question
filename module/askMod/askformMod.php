<?php
//Traitement des questions et commentaire
require_once('../general/generalFonction.php');
if (isset($_POST['actionAsk'])) {
    $date_s = date('Y-m-d');
    if ($_POST['actionAsk'] == 'commenter') {
        $url = '../../controler/index.php?pg=' . md5('showask') . '&' . md5('id_question') . '=' . clean_champs($_POST['id_post']);
        if (!empty($_POST['commenter_form'])) {
            $cmt = clean_champs($_POST['commenter_form']);
            $id_post = clean_champs($_POST['id_post']);

            $sql_send = $connexion->prepare(
                'INSERT INTO post(
                        id_post, post_title, contenu_q_r, date_send, type_post, id_author, id_post_question, fermer
                    ) 
                VALUES (
                        :id_post, :post_title, :contenu_q_r, :date_send, :type_post, :id_author, :idquestion, :fermer
                    )'
            );
            try {
                $sql_send->execute(
                    array(
                        'id_post'       => NULL,
                        'post_title'    => "",
                        'contenu_q_r'   => $cmt,
                        'date_send'     => $date_s,
                        'type_post'     => "_answer",
                        'id_author'     => NULL,
                        'idquestion'    => $id_post,
                        'fermer'        => NULL
                    )
                );
            } catch (\Throwable $th) {
                //throw $th;
            }
            $sql_send->closeCursor();
            generalRedirect($url);
            exit;
        } else {
            generalRedirect($url);
            exit;
        }
    } else if ($_POST['actionAsk'] == 'newAsk') {
        $question = clean_champs($_POST['titre_ask']);
        $detail = clean_champs($_POST['askform']);
        $code = clean_champs($_POST['code_form']);
        $img = htmlentities($_FILES['img']['name']);
        $id_author = clean_champs($_POST['id_author']);

        $url = '../../controler/index.php?pg=' . md5('askform');
        $url1 = '../../controler/index.php?pg=' . md5('question');
        $url2 = $url . '&titre_question=' . $question . '&detail=' . $detail . '&code=' . $code . '&erreur=champs';

        if (exist_Question($question) == true) {
            $url3 = $url1 . '&erreurQuestionExisite';
            generalRedirect($url3);
            exit;
        } else {
            if ((!empty($question))) {
                if (empty($detail) && empty($code) && empty($img)) {
                    generalRedirect($url2);
                    exit;
                } else {
                    $contenu = serialize(
                        array(
                            'details'   =>  $detail,
                            'code'      =>  $code
                        )
                    );

                    $sql_insertion = 'INSERT INTO post(
                            id_post, post_title, contenu_q_r, date_send, type_post, id_author, id_post_question, fermer
                        ) 
                        VALUES (
                            :id_post, :post_title, :contenu_q_r, :date_send, :type_post, :id_author, :id_post_question, :fermer
                        ) ';
                    $sql_insert = $connexion->prepare($sql_insertion);
                    if ($img != "") {
                        if ((imgType($img) == true) && $_FILES['img']['size'] <= 1054729) {
                            $sql_insert->execute(
                                array(
                                    'id_post'           => NULL,
                                    'post_title'        => $question,
                                    'contenu_q_r'       => $contenu,
                                    'date_send'         => $date_s,
                                    'type_post'         => '_question',
                                    'id_author'         =>  $id_author,
                                    'id_post_question'  => NULL,
                                    'fermer'            => '_open'
                                )
                            );
                            $postid = $connexion->lastInsertId();
                            $sql_insert->closeCursor();

                            $sql = $connexion->prepare('INSERT INTO img(id_img, lien, id_post, id_cv) VALUES( :id_img, :lien_img, :id_post, :id_cv ) ');
                            $image_send = $postid . $img;
                            $id_res = $sql->execute(
                                array(
                                    'id_img'    =>  NULL,
                                    'lien_img'  =>  $image_send,
                                    'id_post'   =>  $postid,
                                    'id_cv'     =>  NULL
                                )
                            );
                            $upload = "../../documents/" . $image_send;
                            move_uploaded_file($_FILES['img']['tmp_name'], $upload);
                            generalRedirect($url1);
                            exit;
                        } else {
                            generalRedirect($url2);
                            exit;
                        }
                    } else {
                        $sql_insert->execute(
                            array(
                                'id_post'           => NULL,
                                'post_title'        => $question,
                                'contenu_q_r'       => $contenu,
                                'date_send'         => $date_s,
                                'type_post'         => '_question',
                                'id_author'         =>  $id_author,
                                'id_post_question'  => NULL,
                                'fermer'            => '_open'
                            )
                        );
                        $sql_insert->closeCursor();
                        generalRedirect($url1);
                        exit;
                    }
                    exit;
                }
            } else {
                generalRedirect($url2);
                exit;
            }
        }
    } else if ($_POST['actionAsk'] == 'closeAsk') {
        $id_question = clean_champs($_POST['id_question']);
        $sql_close = $connexion->prepare(
            'UPDATE post SET fermer = :fermer WHERE id_post = ' . $id_question . ''
        );
        $sql_close->execute(
            array(
                'fermer' => '_close'
            )
        );
        $url = '../../controler/index.php?pg=' . md5('showask') . '&' . md5('id_question') . '=' . $id_question;
        generalRedirect($url);
        exit;
    } else {
        redirect_page('question');
        exit;
    }
}
