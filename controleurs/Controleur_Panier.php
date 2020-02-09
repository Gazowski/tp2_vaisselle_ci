<?php
	class Controleur_Panier extends BaseControleur
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
                    case "afficheProduitsPanier":
                        $modeleBoutique = new Modele_Boutique();
                        $liste_id_items_par_quantite = $_SESSION["idItemsPanier"];
                        foreach($liste_id_items_par_quantite as $id => $produit){
							$data[$id] = $modeleBoutique->obtenirItemParId($id);
                            $data[$id]['quantite'] = $produit->quantite;
                        }
                        $titre["titre"] = "Panier";
                        $titre["data-js"] = "data-js-page-panier";
                        $this->afficheVue("TitreSection",$titre);
                        $this->afficheVue("Panier",$data);
						$this->afficheVue("FormulaireCommande");
						//$this->afficheVue("MessageReussite");
                    break;

                    default:
                        echo 'error';
				}			
			}
			else
			{
				//action par défaut
			}
			$this->afficheVue("common/Footer");
        }
	}
?>