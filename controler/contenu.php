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
            case md5('connexion') : 
                include('../vue/connect_vue/connect.php');
            break;
            case md5('confirmation') : 
                include('../vue/connect_vue/confirmationMembre.php');
            break;
            case md5('accueil') : 
                include('../vue/public_vue/accueil.php');
            break;
            case md5('contactus') : 
                include('../vue/connect_vue/contactus.php');
            break;
            case md5('question') : 
                include('../vue/public_vue/question_vue.php');
            break;
            case md5('admin') : 
                include('../vue/admin/admin_vue.php');
            break;
            case md5('askform') : 
                include('../vue/public_vue/askform.php');
            break;
            case md5('showask') : 
                include('../vue/public_vue/showask.php');
            break;
            case md5('about') : 
                include('../vue/public_vue/about_vue.php');
            break;
            case md5('deconnexion') : 
                include('../module/connect_mod/deconnexion.php');
            break;
            default: 
                include('../vue/public_vue/accueil.php');
        }
    }