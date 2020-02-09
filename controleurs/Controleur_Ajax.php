<?php
	class Controleur_Ajax extends BaseControleur
	{
	
		//la fonction qui sera appelée par le routeur
		public function traite(array $params)
		{
		
			if(isset($params["action"]))
			{
				//modèle et vue vides par défaut
				$data = array();
				
				//switch en fonction de l'action qui nous est envoyée
				//ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"])
				{
					case "afficheListeSuivante":
						if(isset($params["offsetPagination"]) && $params["filtre"])
						{
							$modeleBoutique = new Modele_Boutique();
							$data = $modeleBoutique->obtenirTous($params["offsetPagination"],$params["filtre"]);
							$vue = "ListeProduits";
							$this->afficheVue($vue, $data);
						}
						else
                            echo "erreur";
                    break;

                    case "obtenirTotalProduits":
                        $modeleBoutique = new Modele_Boutique();
                        $data = $modeleBoutique->obtenirTotalProduits();
                        echo ($data['total']);
					break;
					
					case "enregistrerIdItemsPanier":
						$_SESSION['idItemsPanier'] = $this->nettoyer_donnees(file_get_contents("php://input"));
					break;

					case "enregistrerCommande":
						$commande = $this->nettoyer_donnees(file_get_contents("php://input"));
						if(trim($commande != ""))
						{
							$modeleCommande = new Modele_Commande;
							$data = $modeleCommande->enregistrerCommande($commande);
							echo($data);
						}
						else
						{
							echo 'error';
						}
					break;
					
					case "verifierPresenceUsager":
						$courriel = $this->nettoyer_donnees(file_get_contents("php://input"));
						if(trim($courriel != ""))
						{
							$modeleUsager = new Modele_Usager;
							$data = $modeleUsager->verifierPresenceCourriel($courriel);
							echo($data['courriel']);
						}
						else
						{
							echo 'error';
						}
					break;
					
					case "enregistrerUsager":
						$info_usager = $this->nettoyer_donnees(file_get_contents("php://input"));
						if(trim($info_usager != ""))
						{
							$modeleUsager = new Modele_Usager;
							$data = $modeleUsager->enregistrerUsager($info_usager);
							echo($data);
						}
						else
						{
							echo 'error';
						}
					break;
					
					case "decrementerInventaireItem":
						$quantite_item = $this->nettoyer_donnees(file_get_contents("php://input"));
						if(trim($quantite_item != ""))
						{
							$modeleBoutique = new Modele_Boutique;
							$data = $modeleBoutique->decrementerInventaireItem($quantite_item);
							echo($data);
						}
						else
						{
							echo 'error';
						}
					break;

					case "afficherSucces":
						$this->afficheVue('MessageReussite');
                    break;
                
                    default:
                        echo 'error';
				}			
			}
			else
                echo 'error';
		}

		public function nettoyer_donnees($donnees)
		{
			$request_payload = $donnees;
			$request_payload = urldecode($request_payload);
			$request_payload  = htmlspecialchars($request_payload,ENT_NOQUOTES); // ENT_NOQUOTES permet d'ignorer les guillemets générés par JSON 
			return json_decode($request_payload);
		}
	}
?>