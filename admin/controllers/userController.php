<?php

if(!isset($_GET['action'])){
    header('Location : index.php');
    exit;
}

require 'models/User.php';

switch ($_GET['action']) {
    case 'list':
        $users = getUsers();
        $view['content'] = 'views/userList.php';
        $view['title'] = 'Liste utilisateurs';
        break;
    
    case 'new':
        $view['content'] = 'views/userForm.php';
        $view['title'] = 'Formulaire utilisateur';
        break;
    
    case 'add':
        if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['adresse'])){
		
            if(empty($_POST['first_name'])){
                $_SESSION['messages'][] = 'Le champ "prénom" est obligatoire !';
            }
            if(empty($_POST['last_name'])){
                $_SESSION['messages'][] = 'Le champ "nom de famille" est obligatoire !';
            }
            if(empty($_POST['email'])){
                $_SESSION['messages'][] = 'Le champ "email" est obligatoire !';
            }
            if(empty($_POST['password'])){
                $_SESSION['messages'][] = 'Le champ "mot de passe" est obligatoire !';
            }
            if(empty($_POST['adresse'])){
                $_SESSION['messages'][] = 'Le champ "adresse" est obligatoire !';
            }
            $_SESSION['alertSuccess'] = false;
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=users&action=new');
            exit;
        }
        else{
            if(empty($_POST['is_admin'])){
                $_POST['is_admin'] = 0;
            }
            $result = addUser($_POST);
            $_SESSION['messages'][] = $result ? 'Utilisateur enregistré !' : "Erreur lors de l'enregistrement de l'utilisateur... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=users&action=list');
            exit;
        }
        break;

        case 'edit':
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                if(empty($_POST)){
                    if(!isset($_SESSION['old_inputs'])){
                        $user = getUsers($_GET['id']);
                        if($user == false){
                            header('Location:index.php?controller=users&action=list');
                            exit;
                        }
                    }
                    $view['content'] = 'views/userForm.php';
                    $view['title'] = 'Formulaire utilisateur';
                }
                else{
                    if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['adresse'])){
            
                        if(empty($_POST['first_name'])){
                            $_SESSION['messages'][] = 'Le champ "prénom" est obligatoire !';
                        }
                        if(empty($_POST['last_name'])){
                            $_SESSION['messages'][] = 'Le champ "nom de famille" est obligatoire !';
                        }
                        if(empty($_POST['email'])){
                            $_SESSION['messages'][] = 'Le champ "email" est obligatoire !';
                        }
                        if(empty($_POST['adresse'])){
                            $_SESSION['messages'][] = 'Le champ "adresse" est obligatoire !';
                        }
                        $_SESSION['old_inputs'] = $_POST;
                        $_SESSION['alertSuccess'] = false;
                        header('Location:index.php?controller=users&action=edit&id=' . $_GET['id']);
                        exit;
                    }
                    else {
                        if(empty($_POST['is_admin'])){
                            $_POST['is_admin'] = 0;
                        }
                        $result = updateUser($_GET['id'], $_POST);
                        $_SESSION['messages'][] = $result ? 'Utilisateur modifié !' : "Erreur lors de la modification de l'utilisateur... :(";
                        $_SESSION['alertSuccess'] = $result ? true : false;
                        header('Location:index.php?controller=users&action=list');
                        exit;
                    }
                }   
            }
            break;
        
        case 'delete':
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                $result = deleteUser($_GET['id']);
                $_SESSION['messages'][] = $result ? 'Utilisateur supprimé !' : "Erreur lors de la suppression de l'utilisateur... :(";
                $_SESSION['alertSuccess'] = $result ? true : false;
                header('Location:index.php?controller=users&action=list');
                exit;
            }
            else{
                header('Location:index.php?controller=users&action=list');
                exit;
            }
            break;
            
    default:
        header('Location:index.php');
        exit;
        break;
}