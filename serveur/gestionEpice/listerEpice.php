<?php
    //require_once("../../includes/configbd.inc.php");
    require_once("../bd/connexion.inc.php");
    //require_once("../bd/env.inc.php");
    require_once("../env/env.inc.php");
    $tab=array();
    $requete = "SELECT * FROM epices";
    try{
        $listeEpices=mysqli_query($connexion,$requete);
        $tab['OK']=true;
        $tab['listeEpices']=array();
        while($ligne=mysqli_fetch_object($listeEpices)){
            $tab['listeEpices'][] = $ligne;
        }
        $tab['categories']=array();
        $requete = "SELECT types FROM categories";
        $listeCategories=mysqli_query($connexion,$requete);
        while($ligne=mysqli_fetch_object($listeCategories)){
            $tab['categories'][] = $ligne->types;
        }
    }catch(Exception $e) {
        $tab['OK']=false;
    }finally {
        mysqli_close($connexion);
        echo json_encode($tab);
    }
?>
