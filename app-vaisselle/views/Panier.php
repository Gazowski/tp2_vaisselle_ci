
<div class="wrapper-list" data-js-wrapper-liste>
    <div class="titre-col">
        <div>Produit</div>
        <div>Prix</div>
        <div>Quantité</div>        
    </div>
    <?php foreach($data as $id => $produit){
        $montant_total_item = $produit["prix"] * $produit["quantite"] ?>
		<article class="tuile tuile-panier" 
				data-js-item
                data-item-id = <?= $produit['id'] ?>
                data-item-prix = <?= $produit["prix"] ?>>
            <div>
                <img src=<?= $produit['lienimage'] ?>
                        alt='<?= $produit['nom'] ?>'>
            </div>
            <div>
                <h3><?= $produit["nom"] ?></h3>
                <p><span data-item-inventaire = <?= $produit["inventaire"]?>><?= $produit["inventaire"]?></span> en stock</p>
                <h3 class="prix petit-ecran"><?=  $produit["prix"]?>$</h3>
            </div>
            <div class="ecran-moyen">
                <h3 class="prix"><?=  $produit["prix"]?>$</h3>
            </div>
            <div>
                <label for="quantite<?= $produit['id'] ?>"></label>
                <input type="number" 
                        id="quantite<?= $produit['id'] ?>" 
                        name="quantite<?= $produit['id'] ?>" 
                        min="0" max="<?= $produit["inventaire"]?>"
                        value="<?= $produit["quantite"]?>"
                        data-js-choix-quantite>
                <h3 class="prix">Total: <span data-js-montant-item><?= $montant_total_item ?></span>$</h3>
            </div>
        </article>
    <?php } ?>
    <article class="prix-total">
        <div>
            <h3>Total Panier : <span data-js-montant-panier></span>$</h3>
            <button data-js-passer-commande>Passer la commande</button>
        </div>
    </article>
</div>