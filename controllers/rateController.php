<?php

if(isset($_GET['action'])){

    require 'models/Rate.php';
    switch ($_GET['action']) {
        case 'add':
            /* var_dump($_POST);
            die(); */
            if(!empty($_POST['comment']) && !empty($_POST['product-rate'])){
                $result = addRate($_GET['id'], $_SESSION['user']['id'], $_POST);
                if($result){
                    $_SESSION['messages'][] = [
                        'color' => 'green',
                        'message' => "L'avis a été publié!"
                    ];
                }
                else{
                    $_SESSION['messages'][] = [
                        'color' => 'red',
                        'message' => "L'avis n'a pas pu être publié!"
                    ];
                }
            }
            else{
                $_SESSION['messages'][] = [
                    'color' => 'red',
                    'message' => "Le commentaire ainsi que la note sont obligatoires pour publier un avis!"
                ];
            }
            header('Location:index.php?controller=products&id=' . $_GET['id']);
            die();
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