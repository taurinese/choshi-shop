<?php

if(!isset($_GET['action'])){
    header('Location:/choshi/admin/index.php');
    exit;
}

require 'models/License.php';

switch ($_GET['action']) {
    case 'list':
        $licenses = getLicenses();
        $view['content'] = 'views/licenseList.php';
        $view['title'] = 'Liste licences';
        break;
    
    case 'edit':
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            if(empty($_POST)){
                if(!isset($_SESSION['old_inputs'])){
                    $license = getLicenses($_GET['id']);
                    if($license == false){
                        header('Location:index.php?controller=licenses&action=list');
                        exit;
                    }
                }
                $view['content'] = 'views/licenseForm.php';
                $view['title'] = 'Formulaire licence';
            }
            else{
                if(empty($_POST['license'])){
                    $_SESSION['messages'][] = 'Le champ "licence" est obligatoire !';
    
                    $_SESSION['old_inputs'] = $_POST;
                    $_SESSION['alertSuccess'] = false;
                    header('Location:index.php?controller=licenses&action=edit&id=' . $_GET['id']);
                    exit;
                }
                else {
                    $result = updateLicense($_GET['id'], $_POST);
                    $_SESSION['messages'][] = $result ? 'Licence modifiée !' : "Erreur lors de la modification de la licence... :(";
                    $_SESSION['alertSuccess'] = $result ? true : false;
                    header('Location:index.php?controller=licenses&action=list');
                    exit;
                }
            }   
        }
        else{
            header('Location:index.php?controller=licenses&action=list');
            exit;
        }
        break;
    case 'add':
        if(empty($_POST['license'])){
            $_SESSION['messages'][] = 'Le champ "licence" est obligatoire !';

            $_SESSION['alertSuccess'] = false;
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=licenses&action=new');
            exit;
        }
        else{
            $result = addLicense($_POST);
            $_SESSION['messages'][] = $result ? 'Licence enregistrée !' : "Erreur lors de l'enregistrement de la licence... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=licenses&action=list');
            exit;
        }
        break; 
    case 'new':
        $view['content'] = 'views/licenseForm.php';
        $view['title'] = 'Aperçu licence';
        break; 
    case 'delete':
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $result = deleteLicense($_GET['id']);
            $_SESSION['messages'][] = $result ? 'Licence supprimée !' : "Erreur lors de la suppression de la licence... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=licenses&action=list');
            exit;
        }
        else{
            header('Location:index.php?controller=licenses&action=list');
            exit;
        }
        break;
    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}