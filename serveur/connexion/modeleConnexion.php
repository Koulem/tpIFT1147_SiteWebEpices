<?php
require_once('../bd/connexion.inc.php');

function Mdl_Connexion($courriel, $motDePass)
{
    global $connexion;
    $msg = "";
    try {
        // Tester si le courriel et motDePasse existe
        $requete = "SELECT * FROM connexion WHERE courriel =? AND motDePass=?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ss", $courriel, $motDePass);
        $stmt->execute();
        $reponse = $stmt->get_result();
        if ($reponse->num_rows > 0) { //ok courriel et motDePass existe
            $ligne = $reponse->fetch_object();
            if ($ligne->statut = "A") {
                //Obtenir les infos du membre
                $requete = "SELECT * FROM membres WHERE courriel =?"; //==Modify to join
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("s", $courriel);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $ligne2 = $reponse->fetch_object();
                if ($ligne->role == 'M') {
                    $_SESSION['role'] = 'M';
                    $_SESSION['prenom'] = $ligne2->prenom;
                    $_SESSION['nom'] = $ligne2->nom;
                    $_SESSION['photo'] = $ligne2->photo; //My add for profile pic
                    header('Location: ../membre/membre.php');
                    exit();
                } else { //Dans ce cas c'est un admin
                    $_SESSION['role'] = 'A';
                    $_SESSION['prenom'] = $ligne->prenom;
                    $_SESSION['nom'] = $ligne->nom;
                    $_SESSION['photo'] = $ligne2->photo; //My add for profile pic
                    header('Location: ../admin/admin.php');
                    exit();
                }
            } else { // Membre inactif
                $msg = "<b>SVP contactez l'administrateur!!!</b>";
            }
        }
    } catch (Exception $e) {
        $msg = 'Erreur : ' . $e->getMessage() . '<br>';
    } finally {
        return $msg;
    }
}
