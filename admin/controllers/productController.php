<?php

if(!isset($_GET['action'])){
    header('Location : /choshi/admin/index.php');
    exit;
}

require 'models/Product.php';
require 'models/Category.php';
require 'models/License.php';

switch ($_GET['action']) {
    case 'list':
        $products = getProducts();
        $view['content'] = 'views/productList.php';
        $view['title'] = 'Liste produits';
        break;
    
    case 'new':
        $categories = getCategories();
        $licenses = getLicenses();
        $view['content'] = 'views/productForm.php';
        $view['title'] = 'Formulaire produit';
        break;
    
    case 'add':
        if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['description']) || empty($_POST['quantity']) || empty($_FILES['main_image']['tmp_name'])){
		
            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
            }
            if(empty($_POST['price'])){
                $_SESSION['messages'][] = 'Le champ "prix" est obligatoire !';
            }
            if(empty($_POST['description'])){
                $_SESSION['messages'][] = 'Le champ "description" est obligatoire !';
            }
            if(empty($_POST['quantity'])){
                $_SESSION['messages'][] = 'Le champ "quantité" est obligatoire !';
            }
            if(empty($_FILES['main_image']['tmp_name'])){
                $_SESSION['messages'][] = 'L\'image principale est obligatoire !';
            }
            $_SESSION['alertSuccess'] = false;
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=products&action=new');
            exit;
        }
        else{
            if(empty($_POST['is_displayed'])){
                $_POST['is_displayed'] = 1;
            }
            if(empty($_POST['license_id'])){
                $_POST['license_id'] = null;
            }
            $result = addProduct($_POST);
            $_SESSION['messages'][] = $result ? 'Produit enregistré !' : "Erreur lors de l'enregistrement du produit... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=products&action=list');
            exit;
        }
        break;

        case 'edit':
            if(empty($_POST)){
                if(!isset($_SESSION['old_inputs'])){
                    $product = getProducts($_GET['id']);
                    if($product == false){
                        header('Location:index.php?controller=products&action=list');
                        exit;
                    }
                }
                $licenses = getLicenses();
                $categories = getCategories();
                $selectedCategories = explode(',', $product['GROUP_CONCAT(cp.category_id)']);
                $view['content'] = 'views/productForm.php';
                $view['title'] = 'Formulaire produit';
            }
            else{
                if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['description']) || empty($_POST['quantity'])){
		
                    if(empty($_POST['name'])){
                        $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
                    }
                    if(empty($_POST['price'])){
                        $_SESSION['messages'][] = 'Le champ "prix" est obligatoire !';
                    }
                    if(empty($_POST['description'])){
                        $_SESSION['messages'][] = 'Le champ "description" est obligatoire !';
                    }
                    if(empty($_POST['quantity'])){
                        $_SESSION['messages'][] = 'Le champ "quantité" est obligatoire !';
                    }
                    $_SESSION['old_inputs'] = $_POST;
                    $_SESSION['alertSuccess'] = false;
                    header('Location:index.php?controller=products&action=edit&id=' . $_GET['id']);
                    exit;
                }
                else {
                    if(empty($_POST['is_displayed'])){
                        $_POST['is_displayed'] = 0;
                    }
                    if(empty($_POST['license_id'])){
                        $_POST['license_id'] = null;
                    }
                    $result = updateProduct($_GET['id'], $_POST);
                    $_SESSION['messages'][] = $result ? 'Produit modifié !' : "Erreur lors de la modification du produit... :(";
                    $_SESSION['alertSuccess'] = $result ? true : false;
                    header('Location:index.php?controller=products&action=list');
                    exit;
                }
            }   
            break;
        
        case 'delete':
            $result = deleteProduct($_GET['id']);
            $_SESSION['messages'][] = $result ? 'Produit supprimé !' : 'Erreur lors de la suppression du produit... :(';
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=products&action=list');
            exit;
            break;

    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}