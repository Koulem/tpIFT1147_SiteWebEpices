<?php
	//require_once("../../includes/configbd.inc.php");
  require_once("../bd/connexion.inc.php");
  //require_once("../bd/env.inc.php");
	require_once("../env/env.inc.php");
	
	$ide=$_POST['ide_m'];
	$nom=$_POST['nom_m']; 
	$types=$_POST['types_m'];
	$prix=$_POST['prix_m'];
	$vendeur = $_POST['vendeur_m'];
	$images = $_POST['images_m'];
	$description = $_POST['desc_m'];

	$dossier="../photos/";
	//Recupérer l'ancienne image pour la remplacer si une nouvelle image
	//a été envoyé  ou pour la garder lors de la mise-à-jour.
	$requette="SELECT images FROM epices WHERE ide=?";
	$stmt = $connexion->prepare($requette);
	$stmt->bind_param("i", $ide);
	$stmt->execute();
	$result = $stmt->get_result();
	$ligne = $result->fetch_object();
	$image=$ligne->images;
	//Si une nouvelle image a été envoyée
	if($_FILES['images_m']['tmp_name']!==""){
		//enlever ancienne image
		if($image!="avatar_membre.png"){
			$rmImg='../photos/'.$image;
			$tabFichiers = glob('../photos/*');
			//print_r($tabFichiers);
			// parcourir les fichier
			foreach($tabFichiers as $fichier){
			  if(is_file($fichier) && $fichier==trim($rmImg)) {
				// enlever le fichier
				unlink($fichier);
				break;
				//
			  }
			}
		}
		$nouvelleImage=sha1($nom.time());
		//Upload de la photo
		$tmp = $_FILES['images_m']['tmp_name'];
		$fichier= $_FILES['images_m']['name'];
		$extension=strrchr($fichier,'.');
		$image=$nouvelleImage.$extension;
		@move_uploaded_file($tmp,$dossier.$image);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
	}
	$requette="UPDATE epices SET ide=?,nom=?,types=?,prix=?, vendeur=?, images=?, descriptions=? WHERE ide=?";
	$stmt = $connexion->prepare($requette);
	$stmt->bind_param("issssss",$ide, $nom, $types, $prix, $vendeur, $image, $descriptions);
	$stmt->execute();
	mysqli_close($connexion);
	header('Location: ../Admin/admin.php?msg=Epices+a+été+modifié');
?>