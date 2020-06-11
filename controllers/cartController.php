<?php

if(!isset($_GET['action'])){
    header('Location: index.php');
    exit();
}
else {
    switch ($_GET['action']) {
        case 'add':
            # code...
            break;
        case 'delete':
            # code...
            break;
        case 'update':
            # code...
            break;
        case 'list':
            # code...
            break;
                    
        default:
            # code...
            break;
    }
}
