<?php

require_once('../bd/connexion.inc.php');

function Mdl_Ajouter($membre, $motDePass)
{
    
    //$imgDate = date("d-m-y");
    $photo = "includes/imgMembre/avatar_membre.png";
    $dossierPhotos = '../imgMembre/';
    $objPhotoRecue = $_FILES['photo']['name'];
    $image_tempname = $_FILES['photo']['tmp_name'];
    $imgName = $dossierPhotos.$image_tempname;
    //========
    global $connexion;
    $nom = $membre->getNom();
    $prenom = $membre->getPrenom();
    $courriel = $membre->getCourriel();
    $sexe = $membre->getSexe();
    $daten = $membre->getDaten();
    $photo = $membre->getPhoto();
    $msg = "";
    try {
        // Tester si le courriel existe déjà
        $requete = "SELECT * FROM membres WHERE courriel=?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("s", $courriel);
        $stmt->execute();
        $reponse =   $stmt->get_result();
        if ($reponse->num_rows == 0) { // OK, courriel n'existe pas
            $requete = "INSERT INTO membres VAlUES (0,?,?,?,?,?)";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("sssss", $nom, $prenom, $courriel, $sexe, $daten);
            $stmt->execute();
            $idm = $connexion->insert_id;

            $requete = "INSERT INTO connexion VAlUES (?,?,?,'M','A')";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("iss", $idm, $courriel, $motDePass);
            $stmt->execute();
           
           //insertion into profileimg
           if($objPhotoRecue !=""){
            move_uploaded_file($image_tempname, $imgName);
            $requete = "INSERT INTO profileImg VAlUES (?,?,?,?)";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("issi", $imgId, $imgName, $imgDate, $idm);
            $stmt->execute();

           }else
           {$requete = "INSERT INTO profileImg VAlUES (?,?,?,?)";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("issi", $imgId, $photo , $imgDate, $idm);
            $stmt->execute();
            }
           //==End insertion in profileImg=====
           
           $msg = "<h3>Membre " . $membre->getPrenom() . ", " . $membre->getNom() . " est bien enregistré.<h3>";
        } else { // Courriel existe déjà
            $msg = "<br><b style='color:red'>Ce courriel est déja utilisé</b></br>";
        }
    } catch (Exception $e) {
        $msg = 'Erreur : ' . $e->getMessage() . '<br>';
    } finally {
        //return $msg;  
        header("Location: ../../index.php?msg=$msg");
        exit;
    }
}
//Charger photo membre

function chargerPhoto($nom, $prenom){
    $photo = "includes/imgMembre/avatar_membre.png";
    $dossierPhotos = "../photos/";
    $objPhotoRecue = $_FILES['photo']['name'];

    if( $objPhotoRecue['tmp_name'][0]!== ""){ // tester si une photo a été uplodée
        $nouveauNom = sha1($nom.$prenom.time()); // Générateur d'un string unique comme nom du fichier uplodé
        // Nom original du fichier uplodé $objPhotoRecue -> name
        // strrchr : cherche le point (.) dans le nom du fichier à partir de la droit
        //Photo fetch
        
        global $connexion, $stmt;
        $requete =  "SELECT *
        FROM `membres` AS m 
        LEFT JOIN `profileImg` AS p ON m.idm = p.idm
        UNION
        SELECT *
        FROM `membres` AS m 
        RIGHT JOIN `profileImg` AS p ON m.idm = p.idm  
        ";

        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("i", $idm);
        $stmt->execute();
        $reponse = $stmt->get_result();
        while($reponse->num_rows > 0) {
            $fetch[] = mysqli_fetch_assoc($reponse);

            $photo = $fetch[1];
        }
    
    }
    return $photo;
    
}

?>

