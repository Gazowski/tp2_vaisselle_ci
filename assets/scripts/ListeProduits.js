import { requeteAjax } from './ajax.js'
import { ItemBoutique } from './ItemBoutique.js'

export class ListeProduits{
    constructor(elt,header){
        this.elt = elt
        this.header = header //objet header
        this.champ_filtre = elt.querySelector('[data-js-filtre]') 
        this.wrapper_liste = elt.querySelector('[data-js-wrapper-liste]')
        this.btn_suivant = elt.querySelector('[data-js-btn-suivant]')
        this.items = this.elt.querySelectorAll('[data-js-item]')

        this.pagination = 0
        this.produits_par_page = 12
        this.paramAjax = []
        this.paramAjaxObjet = {}
        
        this.init()
    }
    
    init(){
        this.obtenir_total_produits()
        this.btn_suivant.addEventListener('click', () => {
            this.pagination += 1
            this.afficher_liste_produits()
        })
        this.champ_filtre.addEventListener('change', () => {
            this.pagination = 0
            let listes = this.elt.querySelectorAll('[data-js-wrapper-liste]')
            for(let liste of listes)
                liste.innerHTML = ""
            this.afficher_liste_produits()
        })
        this.instancier_item(this.items)           
    }
    
    afficher_liste_produits(){
        this.afficher_produits()
        this.activer_boutons()
    }

    instancier_item(items){
        for(let item of items){
            new ItemBoutique(item,this.header)
        }
    }

    obtenir_total_produits(){
        this.paramAjax = 
        {
            methode : "GET",
            action : `index.php?Ajax&action=obtenirTotalProduits`
        }
        requeteAjax(this.paramAjax, (reponse_ajax) => {
            this.elt.dataset.totalProduit = reponse_ajax
            this.activer_boutons()
        }) 
    }
    
    afficher_produits(){
        let offsetPagination = this.pagination * this.produits_par_page,
            filtre = this.champ_filtre.value
        this.paramAjax = 
        {
            methode : "GET",
            action : `index.php?Ajax&action=afficheListeSuivante&offsetPagination=${offsetPagination}&filtre=${filtre}`
        }
        requeteAjax(this.paramAjax, (reponse_ajax) =>{ 
            let items = this.afficher_liste(reponse_ajax) 
            this.instancier_item(items) 
        }) 
        // NOTE : pour effectuer une fonction quand la requete ajax est terminée
        // la fonction est passée en paramêtre par l'intermédiare d'une fonction anonyme
    }

    afficher_liste = (items) =>{
        let produits_suivants = document.createElement('div')
        produits_suivants.innerHTML = items
        produits_suivants = this.wrapper_liste.parentNode.insertBefore(produits_suivants,document.querySelector('.btn-navigation'))
        return produits_suivants.querySelectorAll('[data-js-item]')
    }

    activer_boutons(){
        // calcul du nombre de page max (page 1 = 0)
        let pagination_max = Math.floor(this.elt.dataset.totalProduit/this.produits_par_page)
        this.btn_suivant.disabled = this.pagination < pagination_max ? false : true       
    }

}