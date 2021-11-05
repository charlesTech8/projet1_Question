<?php
 
 /**
  * Dans cette fichier, nous écrirons l'ensembles des petites fonctions en php
  */

/**
 * Funtion redirection
 *
 * @param [type] $lieu
 * @return void
 */
function redirect_page( $lieu ){
    $lieu_chat = 'Location: '.$lieu;
    header($lieu_chat);
}

