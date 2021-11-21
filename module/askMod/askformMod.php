<?php
//Traitement des questions et commentaire
require_once('../general/generalFonction.php');
if( isset( $_POST['actionAsk'] ) ){
    if( ($_POST['actionAsk'] == 'commenter') && !empty( $_POST['commenter_form'] )){
        
    }else{
        $id_q = md5('id_question').'='.clean_champs( $_POST['id_post'] );
        errorRedirect('showask',$id_q,'');
    }
    if($_POST['actionAsk'] == 'newAsk'){
        echo 'ask';
    }
}else{

}