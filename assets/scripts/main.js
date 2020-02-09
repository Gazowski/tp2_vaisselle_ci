import { Header } from "./Header.js"
import { ListeProduits } from "./ListeProduits.js"
import { Panier } from "./Panier.js"
import { Formulaire } from "./Formulaire.js";

document.addEventListener("DOMContentLoaded", function() {

    let elHeader = document.querySelector('header'),
        elListeProduits = document.querySelector('[data-js-liste-produits]'),
        elPanier = document.querySelector('[data-js-page-panier]'),
        elFormulaireCommande = document.querySelector('[data-js-formulaire-commande]'),
        header,
        liste_produits,
        panier,
        formulaire_commande

    if (elHeader) header = new Header(elHeader)
    if (elListeProduits) liste_produits = new ListeProduits(elListeProduits,header)
    if (elFormulaireCommande) formulaire_commande = new Formulaire(elFormulaireCommande)
    if (elPanier) panier = new Panier(elPanier,header,formulaire_commande)

});