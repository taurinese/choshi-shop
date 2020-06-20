<table class="table">
        <tr>
            <th scope="col">Prénom</th><td><?= $rate['first_name']  ?></td>
        </tr>
        <tr>
            <th scope="col">Nom</th><td><?= $rate['last_name']  ?></td>
        </tr>
        <tr>
            <th scope="col">Adresse</th><td><?= $rate['adresse']  ?></td>
        </tr>
        <tr>
            <th scope="col">Email</th><td><?= $rate['email']  ?></td>
        </tr>
        <tr>
            <th scope="col">Image produit</th><td><img class="w-25" src="../assets/img/products/<?= $rate['main_image']  ?>" alt="<?= $rate['name']  ?>"></td>
        </tr>
        <tr>
            <th scope="col">Nom produit</th><td><?= $rate['name']  ?></td>
        </tr>
        <tr>
            <th scope="col">Note</th><td><?= $rate['rate'] ?></td>
        </tr>
        <tr>
                <th scope="col">Contenu</th><td><?= $rate['content'] ?></td>
        </tr>   
</table>