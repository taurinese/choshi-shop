<div class="user-profile">
    <nav id="profile-nav">
        <div class="profile-nav-container">
            <div class="select-btn"><span id="button-toggler"></span></div>
        </div>
    </nav>
    <div class="profile-content">
        <div class="user-data">
            <form id="edit-user-form" action="index.php?controller=users&action=edit&id=<?= $_SESSION['user']['id'] ?>">
                <label for="first_name">Prénom :</label><br>
                <input type="text" name="first_name" value="<?= $user['first_name'] ?>" required> <br>
                <label for="last_name">Nom de famille :</label><br>
                <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required> <br>
                <label for="adresse">Adresse :</label><br>
                <input type="text" name="adresse" value="<?= $user['adresse'] ?>" required> <br>
                <label for="user-email">Email :</label><br>
                <input type="text" name="user-email" value="<?= $user['email'] ?>" required> <br>
                <label for="user-password">Mot de passe :</label><br>
                <input type="password" name="user-password" value=""> <br>
                <input type="submit" value="Modifier">
            </form>
        </div>
        <div class="user-orders">
            
            <table>
                <thead>
                    <th>
                        Numéro
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Détails
                    </th>
                </thead>
                <tbody>
                    <?php foreach($orders as $key => $order): ?>
                        <tr>
                            <td>
                                <strong>#<?= $key +1 ?></strong>
                            </td>
                            <td>
                                <?= $order['new_date'] ?>
                            </td>
                            <td>
                                <a href="index.php?controller=orders&action=list&id=<?= $order['id'] ?>"><i class="fas fa-external-link-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>