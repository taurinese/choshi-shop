<?php

if(!isset($_GET['action'])){
    header('Location:/choshi/admin/index.php');
    exit;
}

require 'models/Promotion.php';

switch ($_GET['action']) {
    case 'list':
        $promotions = getPromotions();
        $view['content'] = 'views/promotionList.php';
        $view['title'] = 'Liste promotions';
        break;
    
    case 'edit':
        if(empty($_POST)){
            if(!isset($_SESSION['old_inputs'])){
                $promotion = getPromotions($_GET['id']);
                if($promotion == false){
                    header('Location:index.php?controller=promotions&action=list');
                    exit;
                }
            }
            $view['content'] = 'views/promotionForm.php';
            $view['title'] = 'Formulaire promotion';
        }
        else{
            if(empty($_POST['name']) || empty($_POST['discount'])){
    
                if(empty($_POST['name'])){
                    $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
                }
                if(empty($_POST['discount'])){
                    $_SESSION['messages'][] = 'Le champ "promotion" est obligatoire !';
                }
                $_SESSION['old_inputs'] = $_POST;
                $_SESSION['alertSuccess'] = false;
                header('Location:index.php?controller=promotions&action=edit&id=' . $_GET['id']);
                exit;
            }
            else {
                $result = updatePromotion($_GET['id'], $_POST);
                $_SESSION['messages'][] = $result ? 'Promotion modifiée !' : "Erreur lors de la modification de la promotion... :(";
                $_SESSION['alertSuccess'] = $result ? true : false;
                header('Location:index.php?controller=promotions&action=list');
                exit;
            }
        }   
        break;
    case 'add':
        if(empty($_POST['name']) || empty($_POST['discount'])){
		
            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
            }
            if(empty($_POST['discount'])){
                $_SESSION['messages'][] = 'Le champ "promotion" est obligatoire !';
            }
            $_SESSION['alertSuccess'] = false;
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=promotions&action=new');
            exit;
        }
        else{
            $result = addPromotion($_POST);
            $_SESSION['messages'][] = $result ? 'Promotion enregistrée !' : "Erreur lors de l'enregistrement de la promotion... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=promotions&action=list');
            exit;
        }
        break; 
    case 'new':
        $view['content'] = 'views/promotionForm.php';
        $view['title'] = 'Aperçu promotion';
        break; 
    case 'delete':
        $result = deletePromotion($_GET['id']);
        $_SESSION['messages'][] = $result ? 'Promotion supprimée !' : "Erreur lors de la suppression de la promotion... :(";
        $_SESSION['alertSuccess'] = $result ? true : false;
        header('Location:index.php?controller=promotions&action=list');
        exit;
        break;
    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}