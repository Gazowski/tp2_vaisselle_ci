<?php
	class Routeur
	{
		public static function route()
		{
			//$controleur = $_REQUEST["controleur"];
			//obtenir le controleur qui devra traiter la requ�te
			
			//obtenir la query string
			$chaineRequete = $_SERVER["QUERY_STRING"];
			$posEperluette = strpos($chaineRequete, "&");
			$controleur = substr($chaineRequete, 0, $posEperluette);
			
			if($controleur != "")
			{
				//chercher la classe du controleur
				$classe = "Controleur_" . $controleur;
			}
			else
			{	
				//controleur par défaut
				$classe = "Controleur_Boutique";
			}
			
			//vérifier que la classe existe
			if(class_exists($classe))
			{
				//dans $classe se trouve le nom de la classe ex : "Controleur_Boutique"
				$objetControleur = new $classe;
				$objetControleur->traite($_REQUEST);
			}
			else
			{
				die("Erreur 404! Le controleur n'existe pas.");
			}
		}
	}
?>