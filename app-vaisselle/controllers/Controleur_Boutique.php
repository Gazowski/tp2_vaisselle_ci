<?php
//header('Access-Control-Allow-Origin: *');

    class Controleur_Boutique extends CI_Controller{
        public function __construct()
        {
            parent::__construct();

            $this->load->model('boutique_model');
            $this->load->helper('url_helper');

			$this->load->view("common/Head");
			$this->load->view('common/Header');
        }

        public function index()
        {
            $data['items'] = $this->boutique_model->obtenirTous();
            $titre["titre"] = "Liste des produits";
            $titre["data_js"] = "data-js-liste-produits";
            $this->load->view("TitreSection",$titre);
            $this->load->view("Filtre",$titre);
            $this->load->view("ListeProduits",$data);
            $this->load->view("BoutonsListe");
            $this->load->view("common/Footer");
        }
    }