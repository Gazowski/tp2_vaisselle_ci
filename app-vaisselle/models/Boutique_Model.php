<?php
    class Boutique_Model extends CI_Model{
        public function obtenirTous($offset_page = 0, $filtre = "nom ASC")
        {
                $this->db->order_by($filtre);                        // équivalent : SELECT * FROM produits
                $query = $this->db->get('produits',$offset_page,12); //              LIMIT $offset_page , 12 
                                                                     //              ORDER BY $filtre
                return $query->result_array();
        }

        
    }