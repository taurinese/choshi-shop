<?php

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'form':
            $view['content'] = 'views/userForm.php';
            $view['title'] = "Connexion utilisateur";
            break;
        
        case 'login':
        break;

        case 'register':
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

