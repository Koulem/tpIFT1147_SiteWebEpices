<?php
session_start();
require_once('modeleConnexion.php');

function Ctr_Connexion()
{
    $courriel = $_POST['courrielco'];
    $motDePass = $_POST['mdpco'];
    $msg = Mdl_Connexion($courriel, $motDePass);
    return $msg;
}

function Ctr_DeConnexion()
{
    unset($_SESSION);
    session_destroy();
    header('Location: ../../index.php');
    exit();
}

//Le controleur
$action = $_POST['action'];
switch ($action) {
    case 'connexion':
        echo Ctr_Connexion();
        break;
    case "deconnexion"://deconnexion
        Ctr_DeConnexion();
        break;
}
?>
<!--<script>
    $(document).ready(function () {
        function buttonClicked(self) {
            var action = sefl.getAttributes("controleurConnexion");
            document.getElementById('deconnect').HTML;

        }
        /*
         
                        onclick = "buttonClicked(this);" id="deconnect"
        */

        /*
        $(function () {
            ('body').hide().fadeIn(3000);
        });*/

    });
</script>
-->
<a href="../../index.php">Retour &agrave; la page d&#39;accueil</a>