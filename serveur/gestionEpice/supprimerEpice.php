<?php
	//require_once("../../includes/configbd.inc.php");
  require_once("../bd/connexion.inc.php");
  require_once("../bd/env.inc.php");
	$ide=$_POST['ide_del'];	
	$requete="SELECT * FROM epices WHERE ide=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $ide);
	$stmt->execute();
	$result = $stmt->get_result();
	if(!$ligne = $result->fetch_object()){
		mysqli_close($connexion);
		header('Location: ../Admin/admin.php?msg=Epices+est+introuvable');
		exit;
	}
	$images=$ligne->images;
	if($images!="avatar_membre.png"){
		$rmImg='../photos/'.$images;
		$tabFichiers = glob('../photos/*');
		//print_r($tabFichiers);
		//parcourir les fichier
		foreach($tabFichiers as $fichier){
			if(is_file($fichier) && $fichier==trim($rmImg)) {
			// enlever le fichier
			unlink($fichier);
			break;
			//
			}
		}
	}
	$requete="DELETE FROM epices WHERE ide=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $ide);
	$stmt->execute();
	mysqli_close($connexion);
	header('Location: ../Admin/admin.php?msg=Epices+a+été+enlevé');
	exit;
?>