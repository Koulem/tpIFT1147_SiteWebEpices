<?php
	//require_once("../../includes/configbd.inc.php");
  require_once("../bd/connexion.inc.php");
  //require_once("../bd/env.inc.php");
  require_once("../env/env.inc.php");
  
	$tabIde=explode(";",$_POST['ide_delp']);//9;13;50
    $taille = count($tabIde);
    
    function enleverUneEpice($ide){
        global $connexion;
        $requete="SELECT images FROM epices WHERE ide=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("i", $ide);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$ligne = $result->fetch_object()){
                mysqli_close($connexion);
                header('Location: ../Admin/admin.php?msg=Article+est+introuvable');
                exit;
            }
            $images=$ligne->images;
            if($images!="avatar.png"){
                $rmImg='../photoss/'.$images;
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
    }
    for($i=0; $i<$taille; $i++){
        enleverUneEpice($tabIdArticles[$i]);  
    }
	mysqli_close($connexion);
	header('Location: ../Admin/admin.php?msg=Les+epices+choisis+ont+été+retirés');
	exit;
?>