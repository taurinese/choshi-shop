<?php

if(!isset($_GET['action'])){
    header('Location:/choshi/admin/index.php');
    exit;
}

require 'models/Rate.php';

switch ($_GET['action']) {
    case 'list':
        $rates = getRates();
        $view['content'] = 'views/rateList.php';
        $view['title'] = 'Liste avis';
        break;
    
    case 'display':
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $rate = getRates($_GET['id']);
            if($rate == false){
                header('Location:index.php?controller=rates&action=list');
                exit;
            }
            $view['content'] = 'views/rateDisplay.php';
            $view['title'] = 'Affichage avis';
        }
        else{
            header('Location:index.php?controller=rates&action=list');
            exit;
        }
        break;

    case 'delete':
        $result = deleteRate($_GET['id']);
        $_SESSION['messages'][] = $result ? 'Avis supprimé !' : "Erreur lors de la suppression de l'avis'... :(";
        $_SESSION['alertSuccess'] = $result ? true : false;
        header('Location:index.php?controller=rates&action=list');
        exit;
        break;
        
    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}