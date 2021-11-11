<?php
/**
 * Dans ce fichier nous allons créer toutes les instructions de redirections
 * nous permettant ainsi de controller l'ensemble des fichiers
 */
if(!isset($_REQUEST['pg']))
    {
        include('../vue/public_vue/accueil.php');
    }

    else
    {
        switch($_REQUEST['pg'])
        {
            case md5('connexion') : include('../vue/connect_vue/connect.php');
                break;
            case md5('accueil') : include('../vue/public_vue/accueil.php');
                break;
            
                break;
            default: include('../vue/public_vue/accueil.php');
        }
    }