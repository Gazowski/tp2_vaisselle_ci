<?php
	
	abstract class TemplateDAO
	{
		protected $connexion;
		
		protected function getPrimaryKey()
		{
			return "id";			
		}
		
		abstract protected function getTable();
		
		public function __construct()
		{
			$this->connexion = new PDO("mysql:host=localhost;dbname=boutique", "root", "");
			$this->connexion->exec("SET NAMES'UTF8'"); // affichage des caractères UTF8
		}
	}
?>