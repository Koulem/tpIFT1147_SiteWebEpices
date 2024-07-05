<?php
//require_once("../../includes/configbd.inc.php");
require_once("../bd/connexion.inc.php");
require_once("../env/env.inc.php");

$ide = $_POST['ide'];
$nom = $_POST['nom'];
$types = $_POST['types'];
$prix = $_POST['prix'];
$vendeur = $_POST['vendeur'];
$images = $_POST['images_aj'];
$descriptions = $_POST['descr_aj'];
$dossier = "../photos/";
$image = "avatar_membre.png";
if ($_FILES['images_aj']['tmp_name'] !== "") {
	$nomImage = sha1($nom . time());
	//Upload de la photo
	$tmp = $_FILES['images_aj']['tmp_name'];
	$fichier = $_FILES['images_aj']['name'];
	$extension = strrchr($fichier, '.');
	@move_uploaded_file($tmp, $dossier . $nomImage . $extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$image = $nomImage . $extension;
}
try {
	$requete = "INSERT INTO epices values(0,?,?,?,?,?,?)";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("ssssss", $nom, $types, $prix, $vendeur, $image, $description); //Selon l'ordre des colonnes de la table categories
	$stmt->execute();
} catch (Exception $e) {
	//Retourner le message voulu
} finally {
	mysqli_close($connexion);
}
header('Location: ../Admin/admin.php?msg=Epices+a+été+enregistré');
