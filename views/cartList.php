
<!-- Ce bout de code n'est pas dans l'affichage du panier mais lors de l'ajout
d'un article au panier donc sur la fiche produit -->

<form action="index.php?controller=cart&action=add">
    <label for="quantity">Quantité : </label>
    <input type="number" name="quantity" id="quantity" min=0 max=10>
</form>