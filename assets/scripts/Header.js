import { requeteAjax } from "./ajax"

export class Header{
    constructor(elt){
        this.elt = elt
        this.titre = elt.querySelector('h1')
        this.div_panier = elt.querySelector('[data-js-panier]')
        this.compteur_panier = elt.querySelector('[data-js-compteur-panier]')
        this.btn_commande = elt.querySelector('[data-js-btn-commander]')

        this.init()

    }

    init(){
        this.initialiser_compteur_panier()
        this.afficher_btn_commande()
        this.div_panier.addEventListener('click', () => {
            this.preparer_et_ouvrir_page_panier()
        })
        document.addEventListener('scroll',() => {
            this.reduire_header_on_scroll()
        })
    }

    initialiser_compteur_panier(){
        if(!sessionStorage.produitsPanier)
        this.compteur_panier.innerHTML = 0
        else{
            this.calculer_et_afficher_compteur_panier()
        }
    }
    
    calculer_et_afficher_compteur_panier(){
        this.calculer_nombre_item()
        this.afficher_compteur_panier()        
    }

    calculer_nombre_item(){
        let produitsPanier = JSON.parse(sessionStorage.produitsPanier),
            total_panier = 0
        for(let item in produitsPanier){
            total_panier += produitsPanier[item]["quantite"]
        }
        this.compteur_panier.innerHTML = total_panier        
    } 
    
    afficher_compteur_panier(){
        let total_panier = parseInt(this.compteur_panier.innerHTML)
        if(total_panier > 0  && this.compteur_panier.matches('.disparait')){
            this.compteur_panier.classList.remove('disparait')
        } else if (total_panier <= 0 && !this.compteur_panier.matches('.disparait')){
            this.compteur_panier.classList.add('disparait')
        }
    }

    incrementer_compteur_panier() {
        let total_panier = parseInt(this.compteur_panier.innerHTML)
        this.compteur_panier.innerHTML = total_panier + 1
    }
        
    preparer_et_ouvrir_page_panier() {
        let paramAjax = 
        {
            methode : "POST",
            json : true,
            action : 'index.php?Ajax&action=enregistrerIdItemsPanier',
            donnees_a_envoyer : JSON.parse(sessionStorage.produitsPanier)
        }
        requeteAjax(paramAjax,()=>{
            window.open("index.php?Panier&action=afficheProduitsPanier","_self")
        })
    }

    afficher_btn_commande() {
        if(sessionStorage.produitsPanier){
            if(this.btn_commande.matches('.disparait'))
                this.btn_commande.classList.remove('disparait')
            this.div_panier.classList.add('panier_actif')
        }
        else{
            if(!this.btn_commande.matches('.disparait'))
                this.btn_commande.classList.add('disparait')
            if(this.div_panier.matches('.panier_actif'))
                this.div_panier.classList.remove('panier_actif')
        }
    }

    reduire_header_on_scroll(){
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            this.elt.classList.add('header_fin')
        } else {
            this.elt.classList.remove('header_fin')
          }
    }

}