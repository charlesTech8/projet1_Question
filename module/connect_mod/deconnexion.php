<?php 
// Deconnexion d'un membre

$_SESSION['id_user'] = '';
unset( $_SESSION['id_user'] );
session_destroy();
$url = '../controler/index.php?pg='.md5('connexion');
header( 'Location: '.$url );
exit;