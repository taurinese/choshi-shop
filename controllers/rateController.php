<?php

if(isset($_GET['action']) && $_GET['action'] == 'add'){
    require 'models/Rate.php';
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
    exit();
    break;
}
else{
    header('Location:index.php');
    exit();
}