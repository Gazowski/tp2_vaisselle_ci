<?php
	class Modele_Commande extends TemplateDAO
	{
		public function getTable()
		{
			return "commande";
		}	
		
		public function enregistrerCommande($commande)
		{
			try
			{
				$stmt = $this->connexion->prepare("INSERT INTO commandes (detail, montant)
													VALUES (?,?)");
				$stmt->bindParam(1, $commande->detail);
				$stmt->bindParam(2, $commande->montant);
				$stmt->execute();
				return 1;
			}	
			catch(PDOException $exc)
			{
				trigger_error("Erreur lors de la requête : " . $exc->getMessage());
				return 0;
			}
		}
	}
?>