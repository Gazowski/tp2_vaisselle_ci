<?php
	class Controleur_Boutique extends BaseControleur
	{
	
		//la fonction qui sera appelée par le routeur
		public function traite(array $params)
		{
			$this->afficheVue("common/Head");
			$this->afficheVue('common/Header');
			
			if(isset($params["action"]))
			{
				//modèle et vue vides par défaut
				$data = array();
				
				//switch en fonction de l'action qui nous est envoyée
				//ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"])
				{


					default:
						// $modeleBoutique = new Modele_Boutique();
						// $data = $modeleBoutique->obtenirTous();
						// $vue = "ListeBoutique";
						// $this->afficheVue($vue, $data);
					break;
				}			
			}
			else
			{
				//action par défaut
				$modeleBoutique = new Modele_Boutique();							
				$data = $modeleBoutique->obtenirTous();
				$titre["titre"] = "Liste des produits";
				$titre["data-js"] = "data-js-liste-produits";
				$this->afficheVue("TitreSection",$titre);
				$this->afficheVue("Filtre",$titre);
				$this->afficheVue("ListeProduits",$data);
				$this->afficheVue("BoutonsListe");
			}
			$this->afficheVue("common/Footer");
		}
	}
?>