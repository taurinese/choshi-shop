<div class="user-profile">
    <nav id="profile-nav">
        <div class="profile-nav-container"><!-- 
            <input type="checkbox" name="button-toggle" id="button-toggle"> -->
            <div class="select-btn"><span id="button-toggler"></span></div>
        </div>
    </nav>
    <div class="profile-content">
        <div class="user-data">
            <form action="index.php?controller=users&action=edit&id=<?= $_SESSION['user']['id'] ?>">
                <label for="first_name">Prénom :</label><br>
                <input type="text" name="first_name" value="<?= $_SESSION['user']['first_name'] ?>"> <br>
                <label for="last_name">Nom de famille :</label><br>
                <input type="text" name="last_name" value="<?= $_SESSION['user']['last_name'] ?>"> <br>
                <label for="adresse">Adresse :</label><br>
                <input type="text" name="adresse" value="<?= $_SESSION['user']['adresse'] ?>"> <br>
                <label for="user-email">Email :</label><br>
                <input type="text" name="user-email" value="<?= $_SESSION['user']['email'] ?>"> <br>
                <label for="user-password">Mot de passe :</label><br>
                <input type="password" name="user-password" value=""> <br>
                <input type="submit" value="Modifier">
            </form>
        </div>
    </div>
</div>