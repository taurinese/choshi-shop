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
                $json_return['message'] = "Identifiants incorrects !";
            }
            else{
                $json_return['is_logged_in'] = true;
                $json_return['message'] = "Utilisateur connecté !";
                $_SESSION['user']= $result;
            }
            echo json_encode($json_return);
            exit();
            break;

        case 'register':
            $result = addUser($_POST);
            if(!$result){
                $json_return['is_created'] = false;
                $json_return['message'] = "Erreur lors de l'enregistrement de l'utilisateur !";
            }
            else{
                $json_return['is_created'] = true;
                $json_return['message'] = "Utilisateur enregistré et connecté !";
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
            $user = getUser($_SESSION['user']['id']);
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

        case 'edit':
            if(isset($_GET['id']) && !empty($_POST)){
                if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['user-email']) || empty($_POST['adresse'])){
                    $json_return['is_updated'] = false;
                    $json_return['message'] = "Tous les champs sont obligatoires à l'exception du mot de passe !";
                    echo json_encode($json_return);
                    exit();
                }
                $result = editUser($_POST, $_GET['id']);
                if(!$result){
                    $json_return['is_updated'] = false;
                }
                else{
                    $json_return['is_updated'] = true;
                    $json_return['message'] = "Modifications enregistrées !";
                    unset($_SESSION['user']);
                    $_SESSION['user']= [
                        'id' => $_GET['id'],
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'adresse' => $_POST['adresse'],
                        'email' => $_POST['user-email']
                    ];
                }
                echo json_encode($json_return);
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

