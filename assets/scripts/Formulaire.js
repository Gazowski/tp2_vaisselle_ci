export class Formulaire{
    constructor(elt){
        this.elt = elt     
        this.champs_formulaire = this.elt.querySelectorAll('input')
        this.champs_avec_regex = this.elt.querySelectorAll('[pattern]')
        this.champs_requis = this.elt.querySelectorAll('[required]')
        this.champs_avec_masque = this.elt.querySelectorAll('[data-mask]')
        this.champs_radio_button = this.elt.querySelectorAll('[data-js-radio-cb]')
        this.indice_regex = document.querySelector('[data-js-indice-regex]')
        this.btn_soumettre = this.elt.querySelector('[data-js-submit]')
        this.btn_fermer_formulaire = this.elt.querySelector('[data-js-close-form]')
        
        this.formulaire_valide = false
        this.champs = {}
        
        this.init()
    }
    
    init(){
        this.creer_variables_champ()
        this.verifier_champs_avec_regex()
        this.ecouter_radbutton()
        this.afficher_masque()
        this.btn_soumettre.addEventListener('click', (e) => {
            e.preventDefault()
            this.valider_formulaire()
            window.scroll({
                top:0,
                behavior:"smooth"
            })
        })
        this.btn_fermer_formulaire.addEventListener('click', (e) => {
            e.preventDefault()
            this.elt.classList.remove('form-visible')
        })
    }
    
    creer_variables_champ = () => {
        for(let champ of this.champs_formulaire){
            this.champs[champ.name] = champ 
        }
    }
    
    valider_formulaire = () => {
        this.formulaire_valide = true
        this.verifier_champs_requis()
        this.informer_erreur_saisie()
    }
    
    verifier_champs_requis = () => {
        for(let champ of this.champs_requis){
            this.est_rempli(champ)
        }
    }
    
    /**
     * 
     * @param {*} champ 
     */
    est_rempli(champ){
        if(champ.value.trim() == ""){
            champ.value = ""
            champ.placeholder = "remplir le champ !"
            this.formulaire_valide = false
        } else {
            champ.placeholder = ""
        }
    }
    
    verifier_champs_avec_regex = () => {
        for(let champ of this.champs_avec_regex){
            champ.addEventListener('blur', () => {
                this.informer_erreur_saisie(champ)
            })
        }    
    }
    
    /**
     * 
     * @param {*} champ 
     */
    informer_erreur_saisie(champ = ''){
        let liste_champs = (champ == '') ? this.champs_avec_regex : [champ]
        for(let chp of liste_champs){
            let zoneInformation = chp.nextElementSibling,
            regex = RegExp(chp.pattern)
            if(chp.value.trim() == ""){ 
                this.est_rempli(chp)
            }
            else if(chp.pattern && !regex.test(chp.value)){
                zoneInformation.innerHTML = chp.dataset.messageErreur
                this.formulaire_valide = false
            }
            else
            zoneInformation.innerHTML = ""
        }
    }
    
    ecouter_radbutton = () =>{
        this.radio_button_cocher = false
        for(let bouton of this.champs_radio_button){
            bouton.addEventListener('change', () => {
                this.radio_button_cocher = true
                this.parametrer_champ_CB(bouton)
                this.afficher_masque(this.champs.CB)
            })
        }        
    } 

    parametrer_champ_CB = (typeCB) => {
        this.champs.CB.disabled = false
        this.indice_regex.innerHTML = typeCB.dataset.placeholder
        this.champs.CB.pattern = typeCB.dataset.pattern
        this.champs.CB.dataset.messageErreur = typeCB.dataset.messageErreur
    }

    afficher_masque = (champ = '') => {
        let liste_champs = (champ == '') ? this.champs_avec_masque : [champ]
        for(let c of liste_champs){
            /* fonction IMask est une fonction de la librairie IMask.js.
                elle permet le formattage des entrées utilisateur et évite les erreurs.
            */
            IMask(c ,{
                mask: c.dataset.mask,
                lazy: false // affiche le masque
            })
        }

    }

}
