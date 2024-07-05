<?php
    require_once './env.inc.php';
    class ConnexionBD {
        private static $instance = null;
        private $connexion;
        
        private function __construct() {
            try {
                $this->connexion = new PDO('mysql:host=' . HOTE . ';dbname=' . "dbdEpiceWeb", USAGER, PASS);
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        
        public static function getInstance() {
            if (is_null(self::$instance)) {
                self::$instance = new ConnexionBD();
            }
            return self::$instance;
        }
        
        public function getConnexion() {
            return $this->connexion;
        }
    }