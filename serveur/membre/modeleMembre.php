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
           $requete = "INSERT INTO profileImg VAlUES (?,?,?,?)";
           $stmt = $connexion->prepare($requete);
           $stmt->bind_param("issi", $imgId, $objPhotoRecue, $imgDate, $idm);
           $stmt->execute();
           //==End insertion in profileImg=====
           if ($requete) {
                move_uploaded_file($image_tempname, $imgName);
           } 
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
    //$imgDate = date("d-m-y");
    $photo = "../photos/avatar_membre.png";
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
            $fetch = mysqli_fetch_assoc($reponse);
        }
        if($_FILES['photo']['name'][0] == "") {
            echo '<img src="includes/imgMemebre/avatar_membre.png">';
        }else {
            echo '<img src="includes/imgMembre/'.$fetch['photo'].'">';
        }
        //<img src="../photos/avatar_membre.png"> just pour definir le chemin correct
        
        $extension = strrchr($objPhotoRecue['name'][0],".");  // Obtenir l'extension du fichier original
        $photo = $dossierPhotos.$nouveauNom.$extension;
        @move_uploaded_file($objPhotoRecue['tmp_name'][0],$dossierPhotos.$photo);
    }
    return $photo;
}


/*
 //====inserting data in profile image table
{
            if ($requete) {
                move_uploaded_file($image_tempname, $imgName);
                $message[] = 'registered success';
                 header("Location: ../../membre.php?msg=$msg");
                
                }else
                {
                $message[] = 'registered success';
                }

                //======Apres aller dans modeleConnexion pour faire innerjoin ou fulljoin
                if($image_tempname == "") {
                    //photo provided
                    $imgName = $photo.$image_tempname;
                    echo "<img src='./photos/avatar_membre.png>";
                } else {
                    //if photo not provided insert default avatar
                    $imgName = $dossierPhotos.$image_tempname;
                    echo "<img src='./photos/.$imgName'>";
                }
                //======

                    //get info about img being uploaded
                list($list, $width, $height, $type, $attr) = getimagesize($imgName);
                switch($type) {
                    case 1:
                        $ext = ".gif";
                        break;
                    case 2:
                        $ext = ".jpg";
                        break;
                    case 3:
                        $ext = ".png";
                        break;
                    default:
                      echo "Ce type d'image n'est pas compatible!";
                }
                

            }



            ====
            global $connexion;
        $select = mysqli_query($connexion, "SELECT *
        FROM `membres` AS m 
        LEFT JOIN `profileImg` AS p ON m.idm = p.idm
        UNION
        SELECT *
        FROM `membres` AS m 
        RIGHT JOIN `profileImg` AS p ON m.idm = p.idm
            
        ");

        if(mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
        }
        if($fetch['photo'] == '') {
            echo '<img src="../photos/avatar_membre.png">';
        }else {
            echo '<img src="../photos/'.$fetch['photo'].' ">';
        }
        //<img src="../photos/avatar_membre.png"> just pour definir le chemin correct

*/
?>
>