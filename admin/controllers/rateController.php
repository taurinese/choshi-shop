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