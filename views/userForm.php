<div id="user-page">
    <form action="" method="post" id="user-form">
        <h3><?= $_GET['form'] == 'login'? "Connexion" : "Inscription" ?></h3>
        <?php if($_GET['form'] == "register"): ?>
            <input type="text" name="first_name" id="first_name" placeholder="Prénom" required><br>
            <input type="text" name="last_name" id="last_name" placeholder="Nom de famille" required><br>
            <input type="text" name="address" id="address" placeholder="Adresse" required><br>
        <?php endif; ?>
        <input type="email" name="user-email" id="user-email" placeholder="Email" required><br>
        <input type="password" name="user-password" id="user-password" placeholder="Mot de passe" required><br>

        <input type="submit" value="<?= $_GET['form'] == 'login'? 'Se connecter' : 'S\'inscrire' ?>" id="btn-connect"><br>
        <a href="index.php?controller=users&action=form&form=<?= $_GET['form'] == 'login'? 'register' : 'login' ?>">
            <p><?= $_GET['form'] == 'login'? 'Vous n\'avez pas de compte ?' : 'Vous avez un compte ?' ?></p>
        </a>
    </form>
</div>
