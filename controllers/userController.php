<?php

if(isset($_GET['action'])){

    require 'models/User.php';
    switch ($_GET['action']) {
        case 'form':
            $view['content'] = 'views/userForm.php';
            $view['title'] = "Connexion utilisateur";
            break;
        
        case 'login':
            $result = checkUser($_POST);
            if(empty($result)){
                $json_return['is_logged_in'] = false;
            }
            else{
                $json_return['is_logged_in'] = true;
                $_SESSION['user']= $result;
            }
            echo json_encode($json_return);
            exit();
            break;

        case 'register':
            $result = addUser($_POST);
            if(!$result){
                $json_return['is_created'] = false;
            }
            else{
                $json_return['is_created'] = true;
                //A vérifier si ça fonctionne
                $user = checkUser($_POST);
                $_SESSION['user']= [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'adresse' => $user['address'],
                    'email' => $user['user-email']
                ];
            }
            echo json_encode($json_return);
            exit();
        break;


        case 'display':
            $view['content'] = 'views/userDisplay.php';
            $view['title'] = "Compte utilisateur";
            break;

        case 'disconnect':
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
                header('Location:index.php');
                exit();
            }
            else{
                header('Location:index.php?controller=users&action=form&form=login');
                exit();
            }
            break;
        default:
            # code...
            break;
    }

}
else{
    header('Location:index.php');
    exit();
}

