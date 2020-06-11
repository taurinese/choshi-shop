<?php

if(!isset($_GET['action'])){
    header('Location:/choshi/admin/index.php');
    exit;
}

require 'models/Category.php';

switch ($_GET['action']) {
    case 'list':
        $categories = getCategories();
        $view['content'] = 'views/categoryList.php';
        $view['title'] = 'Liste catégories';
        break;
    
    case 'new':
        $view['content'] = 'views/categoryForm.php';
        $view['title'] = 'Formulaire catégorie';
        break;
    
    case 'add':
        if(empty($_POST['name']) ){
		
            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
            }
            $_SESSION['alertSuccess'] = false;
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=categories&action=new');
            exit;
        }
        else{
            $result = addCategory($_POST['name']);
            $_SESSION['messages'][] = $result ? 'Catégorie enregistrée !' : "Erreur lors de l'enregistrement de la catégorie... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=categories&action=list');
            exit;
        }
        break;

        case 'edit':
            if(empty($_POST)){
                if(!isset($_SESSION['old_inputs'])){
                    $category = getCategories($_GET['id']);
                    if($category == false){
                        header('Location:index.php?controller=categories&action=list');
                        exit;
                    }
                }
                $view['content'] = 'views/categoryForm.php';
                $view['title'] = 'Formulaire catégorie';
            }
            else{
                if(empty($_POST['name'])){
                    if(empty($_POST['name'])){
                        $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
                    }
                    $_SESSION['old_inputs'] = $_POST;
                    $_SESSION['alertSuccess'] = false;
                    header('Location:index.php?controller=categories&action=edit&id=' . $_GET['id']);
                    exit;
                }
                else {
                    $result = updateCategory($_GET['id'], $_POST);
                    $_SESSION['messages'][] = $result ? 'Catégorie modifiée !' : "Erreur lors de la modification de la catégorie... :(";
                    $_SESSION['alertSuccess'] = $result ? true : false;
                    header('Location:index.php?controller=categories&action=list');
                    exit;
                }
            }   
            break;
        
        case 'delete':
            $result = deleteCategory($_GET['id']);
            $_SESSION['messages'][] = $result ? 'Catégorie supprimée !' : 'Erreur lors de la suppression de la catégorie... :(';
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=categories&action=list');
            exit;
            break;
    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}