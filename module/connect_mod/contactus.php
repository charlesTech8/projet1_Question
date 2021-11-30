<?php 
    
    require 'vendor/autoload.php';
    use \Mailjet\Resources;
    
    /**
     * Appel à la fonction de la connexion et des autres fonctions
     */
    require_once( '../general/generalFonction.php' );

    if ( (isset($_POST['email'], $_POST['messages']) ) && ( !empty($_POST['email']) && !empty($_POST['messages']) ) ){
           $email=clean_champs($_POST['email']);
           $messages=clean_champs($_POST['messages']);

           $mj = new \Mailjet\Client('93496347bcb32d8cef5550f93bd26e72','dfd117c0a2620031a8a564831d792961',true,['version' => 'v3.1']);
            $body = [
                'Messages' => [
                    [
                        'From' => [
                        'Email' => $email,
                        'Name' => "WE CAN"
                        ],
                        'To' => [
                            [
                                'Email' => "gboyoucharles.tech@gmail.com",
                                'Name' => "WECAN"
                            ]
                        ],
                        'Subject' => "Commentaire sur We Can",
                        'TextPart' => "Commentaire envoyé",
                        'HTMLPart' => $messages,
                        'CustomID' => "AppGettingStartedTest"
                    ]
                ]
            ];
            try {
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                $response->success() && var_dump($response->getData());
                exit;
                errorRedirect('contactus','','envoyer');
                exit;
            } catch (\Throwable $th) {
                errorRedirect('contactus','','NoSend');
                exit;
            }
    }
    else{
        errorRedirect('contactus','','NoSend');
        exit;
    }
