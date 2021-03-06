<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view['title'] ?></title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <script src="https://kit.fontawesome.com/cc10ab96df.js" crossorigin="anonymous" defer></script>
</head>
<body>
<div>
<?php 
	require ('views/partials/nav.php');
?>
</div>
<?php if(!empty($_SESSION['messages'])): ?>
  <?php foreach($_SESSION['messages'] as $key => $message): ?>
    <div class="alert-modal <?= $message['color'] ?>" id="<?= $key ?>">
      <?= $message['message'] ?>
      <button class="close-button"><i class="far fa-times-circle"></i></button>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


<div class="main-content">
  <?php require $view['content'] ; ?>
</div>


<?php 
	require ('views/partials/footer.php'); 
?>
<script src="assets/js/script.js" defer></script>
</body>
</html>