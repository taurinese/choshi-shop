<div id="user-page">
    <form action="index.php?controller=users&action=<?= $_GET['form'] ?>" method="post" id="user-form">
        <h2>Inscription</h2>
        <input type="text" name="first_name" id="first_name" placeholder="Prénom"><br>
        <input type="text" name="last_name" id="last_name" placeholder="Nom de famille"><br>
        <input type="text" name="address" id="address" placeholder="Adresse"><br>
        <input type="email" name="user-email" id="user-email" placeholder="Email"><br>
        <input type="password" name="user-password" id="user-password" placeholder="Mot de passe"><br>

        <input type="submit" value="Se connecter">
    </form>
</div>

