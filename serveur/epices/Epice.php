<?php
    class Epice {
        private $ide;
        private $nom;
        private $types;
        private $prix;
        private $vendeur;
        private $images;
        private $descriptions;
        
        
        public function __construct($ide, $nom, $types, $prix, $vendeur, $images, $descriptions) {
            $this->ide = $ide;
            $this->nom = $nom;
            $this->types = $types;
            $this->prix = $prix;
            $this->vendeur = $vendeur;
            $this->images = $images;
            $this->descriptions = $descriptions;
            
        }
        
        // Getters
        public function getIde() {
            return $this->ide;
        }
        
        public function getNom() {
            return $this->nom;
        }
        
        public function getTypes() {
            return $this->types;
        }
        
        public function getPrix() {
            return $this->prix;
        }
        
        public function getVendeur() {
            return $this->vendeur;
        }
        
        public function getImages() {
            return $this->images;
        }
        
        public function getDescriptions() {
            return $this->descriptions;
        }
        


        // Setters
        public function setIde($ide) {
            $this->ide = $ide;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function setTypes($types) {
            $this->types = $types;
        }

        public function setPrix($prix) {
            $this->prix = $prix;
        }

        public function setVendeur($vendeur) {
            $this->vendeur = $vendeur;
        }

        public function setImages($images) {
            $this->images = $images;
        }

        public function setDescriptions($descriptions) {
            $this->descriptions = $descriptions;
        }


        // toString
        public function __toString() {
            return "Epice [ide=" . $this->ide . ", nom=" . $this->nom . ", types=" . $this->types . ", prix=" . $this->prix . ", vendeur=" . $this->vendeur . ", images=" . $this->images . ", descriptions=" . $this->descriptions  . "]";
        }
  }
    
?>