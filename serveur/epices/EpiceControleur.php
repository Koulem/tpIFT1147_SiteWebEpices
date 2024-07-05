<?php
    require_once './EpiceModele.php';
    require_once './Epice.php';
    //require_once("../gestionEpice/enregistrerEpice.php");
    class EpiceControleur {
        private $modele;
        private $instance = null;
        private $msg;

        // Singleton (Seul un objet de ce type peut être instancié)
        private function __construct() {
            
        }

        public static function getInstance() {
            if (is_null(self::$instance)) {
                self::$instance = new EpiceControleur();
            }
            return self::$instance;
        }
        // ********* Méthodes du CRUD **********

        // Ajouter une Epice
        public function Ctr_Ajouter() {
            $uneEpice = new Epice(0, $_POST['nom'], $_POST['types'], $_POST['prix'], $_POST['vendeur'], $_POST['images'], $_POST['descriptions']);
            $reponse = EpiceModele::getInstance()->Mdl_Ajouter($uneEpice);
            echo json_encode($reponse);
        }

    }

?>


