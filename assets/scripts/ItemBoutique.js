
import { enregistrer_id_item, ajuster_quantite_item_enregistre } from "./variablesSession.js"

export class ItemBoutique{
    constructor(elt,header){
        this.elt = elt
        this.header = header
        this.el_inventaire = this.elt.querySelector('[data-item-inventaire]')

        this.item_id = this.elt.dataset.itemId
        this.inventaire = this.el_inventaire.dataset.itemInventaire

        this.init()
    }

    init = () => {
        this.ajouter_evt_tuile()
        this.afficher_quantite_restante()
        this.verifier_inventaire_item()
    }

    ajouter_evt_tuile = () =>{
        this.elt.addEventListener('click', () => {
            enregistrer_id_item(this.elt)
            ajuster_quantite_item_enregistre(this.elt)
            this.verifier_inventaire_item()
            this.afficher_quantite_restante()
            this.header.calculer_et_afficher_compteur_panier()
            if(this.header.compteur_panier.innerHTML == "1")
                this.header.afficher_btn_commande()            
        })
    }

    afficher_quantite_restante = () => {
        this.el_inventaire.innerHTML = this.inventaire

    }

    verifier_inventaire_item = () =>{
        if(this.inventaire <= "0"){
            if(!this.elt.classList.contains('inventaire_nul'))
                this.elt.classList.add('inventaire_nul')
        }
        else{
            if(this.elt.classList.contains('inventaire_nul'))
                this.elt.classList.remove('inventaire_nul')
        }
    }
}