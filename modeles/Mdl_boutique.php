<?php
	class Modele_Boutique extends TemplateDAO
	{
		public function getTable()
		{
			return "boutique";
		}	
		
		public function obtenirTous($offset_page = 0, $filtre = "nom ASC")
		{
			try
			{
				$stmt = $this->connexion->prepare("SELECT * 
													FROM produits
													ORDER BY " . $filtre . "
													LIMIT " . $offset_page . " , 12 ");
				$stmt->execute();
				return $stmt->fetchAll();
			}	
			catch(PDOException $exc)
			{
				trigger_error("Erreur lors de la requête : " . $exc->getMessage());
				return 0;
			}
		}

		public function obtenirTotalProduits()
		{
			try
			{
				$stmt = $this->connexion->prepare("SELECT COUNT(*) AS total FROM produits");
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $exc)
			{
				trigger_error("Erreur lors de la requête : " . $exc->getMessage());
				return 0;
			}

		}

		public function obtenirItemParId($id)
		{
			try{
				$requete = "SELECT * FROM produits WHERE id = ?";
				$stmt = $this->connexion->prepare($requete);
				$stmt->execute(array($id));
				$resultats = $stmt->fetch(PDO::FETCH_ASSOC);
				return $resultats;
			}
			catch(PDOException $e)
			{
				trigger_error("Erreur lors de la requête : " . $e->getMessage());
			}  
		}
		
		public function decrementerInventaireItem($item)
		{
			try{
				$requete = "UPDATE produits 
							SET inventaire = inventaire - $item->quantite
							WHERE id = ?";
				$stmt = $this->connexion->prepare($requete);
				$stmt->execute(array($item->id));
				$resultats = $stmt->fetch(PDO::FETCH_ASSOC);
				return 1;
			}
			catch(PDOException $e)
			{
				trigger_error("Erreur lors de la requête : " . $e->getMessage());
				return 0;
			}  
		}
	}
?>