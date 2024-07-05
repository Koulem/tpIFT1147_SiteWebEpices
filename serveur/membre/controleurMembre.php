<?php
require_once('includes/membre.inc.php');
require_once('modeleMembre.php');

function Ctr_Ajouter()
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $courriel = $_POST['courriel'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['daten'];
    $photo = $_FILES['photo']['tmp_name'];

    $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, " ");
    $msg = Mdl_Ajouter($membre, $_POST['mdp']);
    return $msg;
}
$msg = Ctr_Ajouter();
echo $msg;
?>
<br />
<a href="../../index.php">Retour &agrave; la page d&#39;accueil</a>