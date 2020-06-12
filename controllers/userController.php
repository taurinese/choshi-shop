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
                $_SESSION['user']= [
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'adresse' => $_POST['address'],
                    'email' => $_POST['user-email']
                ];
            }
            echo json_encode($json_return);
            exit();
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

