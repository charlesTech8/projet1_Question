<?php
session_start();
/**
 * Dans ce fichier, nous écrirons l'ensembles des petites fonctions en php
 */

/**
 * Connexion avec la bdd avec pdo
 */
try {
  $connexion = new PDO(
    'mysql:host=localhost;dbname=askansw',
    'root',
    '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

/**
 * Funtion redirection
 *
 * @param [type] $lieu
 * @return void
 */
function redirect_page($lieu){
  $lieu_chat = 'Location: ' . $lieu;
  return header($lieu_chat);
}

/**
 * Fonction de redirection lorsqu'il y a erreur
 *
 * @param String $lieu
 * @param String $errorType
 * @return void
 */
function errorRedirect( $lieu, $errorType ){
  $url = $lieu.'?error='.md5( $errorType );
  redirect_page( $url );
}

/**
 * Fonction qui affiche les differentes types d'erreur
 *
 * @param [type] $errorType
 * @return void
 */
function erroExist($errorType){
  //Appel au fichier text
  require_once('text_var.php');

  switch ($errorType) {
    case md5('erreurCon'):
      echo ($erreurCon);
    break;
    case md5('erreurC'):
      echo ($erreurC);
    break;
    case md5('erreurIns'):
      echo ($erreurIns);
    break;
    case md5('erreurConnexion'):
      echo ($erreurConnexion);
    break;
    case md5('first'):
      echo ($erreurFirst);
    break;
    default:
      echo ($erreurFirst);
    break;
  }
}

/**
 *  Function qui format les champs en htmlentities et addslashes
 * 
 * @param String $champs
 * @return String
 */
function clean_champs( $champs ): string{
  return htmlentities(addslashes($champs));
}

/**
 * Cryptage du pass
 *
 * @param String $pass
 * @return string
 */
function clean_pass( $pass ): string{
    return md5( sha1( $pass ) );
}


/**
 * Verification mail
 *
 * @param String $email
 * @return bool
 */
function mailExist($email):bool{
  global $connexion;
  $sql_verifie = $connexion->prepare('SELECT * FROM inscris WHERE email_author = :email ');
  $sql_verifie->execute(
    array(
      'email' => $email
    )
  );
  $nbRow = $sql_verifie->rowCount();
  if( $nbRow > 0 ){
    return TRUE;
  }else{
    return FALSE;
  }

  $sql_verifie->closeCursor();
}

/**
 * Recupération de l'identifiant d'un user
 *
 * @param string $mail
 * @param string $pwd
 * @return integer
 */
function connectMail($mail, $pwd): int{
  global $connexion;
  $sql_mail = $connexion->prepare(
    'SELECT id_author FROM inscris WHERE email_author = :email AND password_author = :pwd'
  );
  $sql_mail->execute(
    array(
      'email' => $mail,
      'pwd'   => $pwd
    )
  );
  $id = $sql_mail->fetch();
  if ($id != NULL)
    return $id['id_author'];
  else
    return $id = -1;
  $sql_mail->closeCursor();
}

/**
 * Fonction qui retourne l'ensemble des posts de type question
 *
 * @return array
 */
function get_post_question():array{
  global $connexion;
  $sql_post_quest = $connexion->prepare(
    'SELECT * FROM post WHERE type_post = :type_post ORDER BY id_post DESC'
  );
  $sql_post_quest->execute(
    array(
      'type_post' => '_question'
    )
  );
  $quest = $sql_post_quest->fetchAll();
  if( $quest != NULL )
    return $quest;
  else
    return array();
  $sql_post_quest->closeCursor();
}

/**
 * Fonction permettant de selection toutes les réponses à une question
 *
 * @param integer $id_question
 * @return array
 */
function get_post_quest_answ( $id_question ): array{
  global $connexion;
  $sql_ans = $connexion->prepare(
    'SELECT * FROM post WHERE type_post = :type_post AND id_post_question = :id_quest ORDER BY id_post DESC'
  );
  $sql_ans->execute(
    array(
      'type_post' => '_answer',
      'id_quest'  => $id_question
    )
  );
  $ans = $sql_ans->fetchAll();
  if( $ans != NULL )
    return $ans;
  else
    return array();
  $sql_ans->closeCursor();
}

/**
 * Récupération d'un user
 *
 * @param integer $id_user
 * @return array
 */
function get_user( $id_user ): array{
  global $connexion;
  $sql_user = $connexion->prepare(
    'SELECT * FROM inscris WHERE id_author = :id_user'
  );
  $sql_user->execute(
    array(
      'id_user' => $id_user
    )
  );
  $user = $sql_user->fetch();
  if( $user != NULL )
    return $user;
  else
    return array();
  $sql_user->closeCursor();
}

/**
 * Récupération des niveau
 *
 * @return array
 */
function get_niveau(): array{
  global $connexion;
  $sql_niv = $connexion->prepare(
    'SELECT * FROM niveau'
  );
  $sql_niv->execute();
  $niv = $sql_niv->fetchAll();
  if( $niv != NULL )
    return $niv;
  else
    return array();
  $sql_niv->closeCursor();
}

/**
 * Récupération du lien de l'image
 *
 * @param [type] $id_post
 * @return void
 */
function get_ling_img( $id_post ){
  global $connexion;
  $sql_img = $connexion->prepare(
    'SELECT lien FROM img WHERE id_post = :id_post OR id_cv = :id_cv'
  );
  $sql_img->execute(
    array(
      'id_post'   => $id_post,
      'id_cv' => $id_post
    )
  );
  $lien = $sql_img->fetch();
  if( $lien != NULL )
    return $lien['lien'];
  else
    return NULL;
  $sql_img->closeCursor();
}

/**
 * Récupérer un mail
 *
 * @param [type] $id_user
 * @return string
 */
function get_email( $id_user ):string{
  global $connexion;
  $sql_mail = $connexion->prepare(
    'SELECT email_author FROM inscris WHERE id_author = :mail'
  );
  $sql_mail->execute(
    array(
      'mail' => $id_user
    )
  );
  $email = $sql_mail->fetch();
  if($email != NULL)
    return $email['email_author'];
  else
    return $email='';
}

/**
 * Fonction de récupération du cv
 *
 * @param [type] $id_user
 * @return array
 */
function get_cv( $id_user ): array{
  global $connexion;
  $sql_cv = $connexion->prepare(
    'SELECT * FROM cv WHERE id_author = :id_user'
  );
  $sql_cv->execute(
    array(
      'id_user' => $id_user
    )
  );
  $cv = $sql_cv->fetch();
  if( $cv != NULL )
    return $cv;
  else
    return array();
}
