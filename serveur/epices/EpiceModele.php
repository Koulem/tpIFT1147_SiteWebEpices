<?php
    require_once './Epice.php';
    require_once '../bd/ConnexionBD.php';

    class EpiceModele {
        private $instance = null;
        private $reponse=["msg"=>"","OK"=>false,"donnees"=>[]];
        // Singleton (Seul un objet de ce type peut être instancié)
        private function __construct() {
            
        }

        public static function getInstance() {
            if (is_null(self::$instance)) {
                self::$instance = new EpiceModele();
            }
            return self::$instance;
        }

        public function Mdl_Ajouter($uneEpice) {
            try {
            // Connexion à la BD
            $connexion = ConnexionBD::getInstance()->getConnexion();
            // Requête SQL
            $requete = "INSERT INTO epices VALUES (0,:nom, :types, :prix, :vendeur, :images, :descriptions)";
            // Préparation de la requête
            $stmt = $connexion->prepare($requete);
            // Exécution de la requête
            $stmt->execute(array(
                ':nom' => $uneEpice->getNom(),
                ':types' => $uneEpice->getTypes(),
                ':prix' => $uneEpice->getPrix(),
                ':vendeur' => $uneEpice->getVendeur(),
                ':images' => $uneEpice->getImages(),
                ':descriptions' => $uneEpice->getDescriptions(),
            ));
            $reponse["msg"] = "Epice ajouté avec succès!";
            $reponse["OK"] = true;
        } catch (PDOException $e) {
            $reponse["msg"] = "Erreur lors de l'ajout de l#39;&eacute;pice : " . $e->getMessage();
            $reponse["OK"] = false;
        } finally {
            return $reponse;
        }
            //  $requete = "INSERT INTO epices VALUES (0,?, ?, ?, ?, ?, ?)";
            // // Préparation de la requête
            // $stmt = $connexion->prepare($requete);
            // // Exécution de la requête
            // $stmt->execute([
            //     $uneEpice->getNom(),
            //     $uneEpice->getTypes(),
            //     $uneEpice->getPrix(),
            //     $uneEpice->getVendeur(),
            //     $uneEpice->getImages(),
            //     $uneEpice->getDescriptions(),
            //    
            // ]);    
            }

    }

?>


