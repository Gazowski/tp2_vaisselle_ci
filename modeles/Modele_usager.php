<?php
	class Modele_Usager extends TemplateDAO
	{
		public function getTable()
		{
			return "usager";
		}	
		
		public function verifierPresenceCourriel($courriel)
		{
			try
			{
				$requete = "SELECT courriel 
							FROM `usagers` 
							WHERE courriel = ? ";
				$stmt = $this->connexion->prepare($requete);
				$stmt->execute(array($courriel));
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}	
			catch(PDOException $exc)
			{
				trigger_error("Erreur lors de la requête : " . $exc->getMessage());
				return 0;
			}
		}

		public function enregistrerUsager($usager)
		{
			try
			{
				$requete = "INSERT INTO usagers (nom,prenom,adresse,courriel,optin)
							VALUES (?,?,?,?,?) ";
				$stmt = $this->connexion->prepare($requete);
				$stmt->execute(array($usager->nom,
									$usager->prenom,
									$usager->adresse,
									$usager->courriel,
									$usager->optin));
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