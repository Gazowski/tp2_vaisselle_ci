export let enregistrer_id_item = (item) => { 
    //NOTE: session storage ne prend que les strings
    //création d'un tableau intermédiaire qui est transformé en Json avant d'être enregistré en session storage
    let produits_panier = {},
    id_item = item.dataset.itemId
    if(sessionStorage.produitsPanier)
        produits_panier = JSON.parse(sessionStorage.produitsPanier)
    if(id_item in produits_panier){
        // pass
    }
    else{
        produits_panier[id_item] = {}
        produits_panier[id_item]['nom'] = item.dataset.itemNom
        produits_panier[id_item]["quantite"] = 0
    }
    sessionStorage.produitsPanier = JSON.stringify(produits_panier) 
}

export let ajuster_quantite_item_enregistre = (item) =>{
    let produitsPanier = JSON.parse(sessionStorage.produitsPanier),
        inventaire = item.querySelector('[data-item-inventaire'),
        champ_selection_quantite = item.querySelector('[data-js-choix-quantite]'),
        id_item = item.dataset.itemId
    // si la quantite est modifiée depuis le panier
    if(champ_selection_quantite)
        produitsPanier[id_item]["quantite"] = parseInt(champ_selection_quantite.value)
    // sinon la quantite est modifiée depuis la boutique
    else if(produitsPanier[id_item]["quantite"] < inventaire.dataset.itemInventaire)
        produitsPanier[id_item]["quantite"] += 1
    sessionStorage.produitsPanier = JSON.stringify(produitsPanier)
}
