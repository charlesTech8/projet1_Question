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
 * @param string $lieu
 * @return void
 */
function redirect_page($lieu){
  $destination = '../../controler/index.php?pg='.md5($lieu);
  $lieu_chat = 'Location: ' . $destination;
  return header($lieu_chat);
}

/**
 * Fonction de redirection lorsqu'il y a erreur
 *
 * @param string $lieu
 * @param string $errorType
 * @return void
 */
function errorRedirect( $lieu, $other, $errorType ){
  $url = '../../controler/index.php?pg='.md5($lieu).'&error='.md5( $errorType ).'&'.$other;
  $lieu_chat = 'Location: ' . $url;
  return header($lieu_chat);
}

/**
 * Fonction qui affiche les differentes types d'erreur
 *
 * @param string $errorType
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
    case md5('erreurChamps'):
      echo ($erreurChamps);
    break;
    case md5('erreurPass'):
      echo ($erreurPass);
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
 * @param string $email
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
function get_post_quest_answ( int $id_question ): array{
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
function get_user( int $id_user ): array{
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
 * Fonction de récupération du cv
 *
 * @param integer $id_user
 * @return array
 */
function get_cv( int $id_user ): array{
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
  $sql_cv->closeCursor();
}

/**
 * Récupération du lien de l'image
 *
 * @param integer $id_post
 * @return void
 */
function get_ling_img( int $id_post ){
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
 * @param integer $id_user
 * @return string
 */
function get_email( $id_user ):string{
  $user = get_user( $id_user );
  if( $user == NULL )
    return $email = '';
  else
    return $user['email_author'];
}

/**
 * Nom d'un utilisateur
 *
 * @param integer $id_user
 * @return string
 */
function get_user_nom( int $id_user ):string{
  $user = get_user( $id_user );
  if( $user == NULL )
    return $nom = '';
  else
    return $user['nom_author'];
}

/**
 * Prenom d'un utilisateur
 *
 * @param integer $id_user
 * @return string
 */
function get_user_prenom( int $id_user ):string{
  $user = get_user( $id_user );
  if( $user == NULL )
    return $prenom = '';
  else
    return $user['prenom_author'];
}

/**
 * Nom sur cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_nom( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $nom = '';
  else
    return $cv['nom'];
}

/**
 * Prénom sur CV
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_prenom( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $prenom = '';
  else
    return $cv['prenom'];
}

/**
 * Numéro de téléphone cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_tel( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $tel = '';
  else
    return $cv['tel'];
}

/**
 * Date de naissance cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_nais( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $date_nais = '';
  else
    return $cv['date_nais'];
}

/**
 * Langue cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_langue( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $langue = '';
  else
    return $cv['langue'];
}

/**
 * Adresse cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_adresse( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $adresse = '';
  else
    return $cv['adresse'];
}

/**
 * Profile cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_profil( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $profil = '';
  else
    return $cv['profil'];
}

/**
 * Expériences cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_experience( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $experience = '';
  else
    return $cv['experience'];
}

/**
 * Competences cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_competences( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $competences = '';
  else
    return $cv['competences'];
}

/**
 * diplome cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_diplome( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $diplome = '';
  else
    return $cv['diplome'];
}

/**
 * Qualités cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_qualites( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $qualites = '';
  else
    return $cv['qualites'];
}

/**
 * Loisirs cv
 *
 * @param integer $id_user
 * @return string
 */
function get_cv_loisirs( int $id_user ): string{
  $cv = get_cv( $id_user );
  if( $cv == NULL )
    return $loisirs = '';
  else
    return $cv['loisirs'];
}