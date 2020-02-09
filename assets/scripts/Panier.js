import { ItemPanier } from './ItemPanier'
import { requeteAjax } from './ajax.js'

export class Panier{
    constructor(elt,header,formulaireCommande){
        this.elt = elt
        this.header = header
        this.form_commande = formulaireCommande
        this.items = this.elt.querySelectorAll('[data-js-item]')
        this.montants_par_item = this.elt.querySelectorAll('[data-js-montant-item]')
        this.montant_panier = this.elt.querySelector('[data-js-montant-panier]')
        this.champs_selection_quantite = this.elt.querySelectorAll('[data-js-choix-quantite]')
        this.btn_passer_commande = this.elt.querySelector('[data-js-passer-commande')

        this.montant_total_panier = 0
        this.commande = {}
        this.usager_dans_database = false
        this.timeoutID

        this.init()
    }

    init() {
        this.instancier_items_panier()
        this.calculer_et_afficher_montant_total_panier()
        this.ajouter_evt_choix_quantite()
        this.ajouter_evt_btn_passer_commade()
        this.passer_la_commande()
        this.form_commande.champs.courriel.addEventListener('blur', () => {
            this.est_dans_database()
        })
    }
    
    instancier_items_panier() {
        for(let item of this.items)
        new ItemPanier(item)
    }
    
    calculer_et_afficher_montant_total_panier() {
        this.montant_total_panier = 0
        for(let item of this.montants_par_item)
        this.montant_total_panier += parseInt(item.innerHTML)
        this.montant_panier.innerHTML = this.montant_total_panier
    }
    
    ajouter_evt_choix_quantite() {
        for(let champ of this.champs_selection_quantite){
            champ.addEventListener('change', () => {
                this.calculer_et_afficher_montant_total_panier()
                this.activer_btn_passer_commande()
                this.header.calculer_et_afficher_compteur_panier()
            })
        }
    }     
    
    activer_btn_passer_commande() {
        this.btn_passer_commande.disabled = (this.montant_panier.innerHTML == "0") ? true : false
    }

    ajouter_evt_btn_passer_commade(){
        this.btn_passer_commande.addEventListener('click', () => {
            this.form_commande.elt.classList.add('form-visible')
            window.scroll(0,0)
        })
    }
    
    passer_la_commande() {
        this.form_commande.btn_soumettre.addEventListener('click', (e) => {
            if(this.form_commande.formulaire_valide){
                e.preventDefault()
                this.preparer_liste_produits()
                this.enregistrer_commande()
                this.mettre_a_jour_inventaire()
                this.afficher_succes()
                this.enregister_usager()
                this.afficher
                sessionStorage.clear()
            }
        })
    }
    
    preparer_liste_produits() {
        let liste_produits_panier = [],
            produits_panier = JSON.parse(sessionStorage.produitsPanier)
        for(let item in produits_panier){
            let quantite = produits_panier[item]["quantite"],
                nom = produits_panier[item]["nom"].replace(/_/g,' ')
            if (produits_panier[item]["quantite"] > 0) 
                liste_produits_panier.push(` ${quantite} ${nom}`)
        }
        liste_produits_panier = liste_produits_panier.toString()
        this.commande = 
        {
            detail : liste_produits_panier, 
            montant : this.montant_total_panier
        }
    }
    
    enregistrer_commande() {
        let paramAjax = 
        {
            methode : "POST",
            json : true,
            action : "index.php?Ajax&action=enregistrerCommande",
            donnees_a_envoyer : this.commande
        }
        requeteAjax(paramAjax, (reponse_ajax) => {
            console.log('commande enregistre')
        })
    }

    mettre_a_jour_inventaire() {
        let produits_panier = JSON.parse(sessionStorage.produitsPanier)
        for(let item in produits_panier){
            if(produits_panier[item]["quantite"] > 0)
            this.decrementer_inventaire_item(item,produits_panier[item]["quantite"])
        }
    }

    decrementer_inventaire_item(item,quantite){
        let paramAjax = 
        {
            methode : "POST",
            json : true,
            action : `index.php?Ajax&action=decrementerInventaireItem`,
            donnees_a_envoyer : {id:item,quantite:quantite}
        }
        requeteAjax(paramAjax, (reponse_ajax) => {

        })
    }

    afficher_succes(){
        let paramAjax = {
            methode : "GET",
            action : "index.php?Ajax&action=afficherSucces"
        }
        requeteAjax(paramAjax, (reponse_ajax) => {
            this.form_commande.elt.innerHTML = reponse_ajax
            this.timeoutID = window.setTimeout(this.retour_boutique,5000)
        })
    }

    retour_boutique(){
        window.location = 'index.php'
    }

    temporiser(fonction,temp){

    }

    est_dans_database(){
        let paramAjax = {
            methode : "POST",
            json : true,
            action : "index.php?Ajax&action=verifierPresenceUsager",
            donnees_a_envoyer : this.form_commande.champs.courriel.value
        }
        requeteAjax(paramAjax, (reponse_ajax) => {
            this.usager_dans_database = (reponse_ajax.trim() != '')? true : false
        })
    }

    enregister_usager(){
        if(this.form_commande.formulaire_valide && !this.usager_dans_database){
            let info_usager = {
                nom : this.form_commande.champs.nom.value,
                prenom : this.form_commande.champs.prenom.value,
                adresse : this.form_commande.champs.adresse.value,
                courriel : this.form_commande.champs.courriel.value,
                optin : (this.form_commande.champs.infolettre.checked)? 1 : 0
            }

            let paramAjax = {
                methode : "POST",
                action : "index.php?Ajax&action=enregistrerUsager",
                donnees_a_envoyer : info_usager
            }
            requeteAjax(paramAjax, (reponse_ajax) => {
                console.log(reponse_ajax)
            })
        }
    }
}