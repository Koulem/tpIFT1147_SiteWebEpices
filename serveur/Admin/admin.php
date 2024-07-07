<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../../index.php');
    exit();
} else {
    if ($_SESSION['role'] !== "A") {
        header('Location: ../../index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Chez &Eacute;pices loubha</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet-->
    <link href="../../client/public/utilitaires/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../client/public/css/style.css" rel="stylesheet">

</head>
<body onLoad='initialiser(<?php echo "\"" . $msg . "\""; ?>); chargerEpices("A","../gestionEpice/listerEpice.php");'>
    <?php require_once("./menu_admin.inc.php"); ?>

    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                        <a href="#" class="text-white">6275 Sherbrook West Street, Montreal</a>
                    </small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">y.loubha@live.ca</a></small>
                </div>
                <div class="logo">
                    <img src="../../serveur/photos/Final_Main_logo.jpg">
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2"><?php echo $_SESSION['prenom'] . ", " . $_SESSION['nom']; ?></small>/</a>

                    <a href="#" class="text-white"><small class="text-white ms-2"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../photos/" . $_SESSION['photo'] . "' width=48 height=48>";  ?></small>/</a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-primary display-6">Chez &Eacute;pices Loubha</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="../../index.php" class="nav-item nav-link active">Accueil</a>
                        <a href="shop.php" class="nav-item nav-link">Gerer Promotion </a>
                        <a href="shop-detail.php" class="nav-item nav-link">Gestion Stock</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="../membre/cart.php" class="dropdown-item">Suivi des Commandes</a>
                                <a href="../membre/chackout.php" class="dropdown-item">Envoie perdu</a>
                                <a href="testimonial.php" class="dropdown-item">Suivi Des Livraisons</a>
                                <a href="404.php" class="dropdown-item">Pleinte</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Ventes</a>
                    </div>

                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>

                        <button type="button" class="btn btn-border-none bg-white me-4" data-toggle="tooltip" data-html="true" data-placement="bottom-center" title="Deconnexion et Profile Employ&eacute;!" id="btn_deconnect_admin">

                            <a href="#" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>

                            </a>
                            <span class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle-fade" data-bs-toggle="dropdown" id="dropdown_admin"></a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="#Adefinir" class="dropdown-item">Profile Employ&eacute;</a>
                                    <a href="#Adefinir" class="dropdown-item">Formation & Atelier</a>
                                    <!--Au besoin ajouter plus-->
                                    <span class="nav-item">
                                        <a href="javascript:document.getElementById('formDec').submit();" class="dropdown-item nav-link">
                                            Deconnexion
                                        </a>
                                    </span>
                                </div>
                            </span>
                        </button>
                        <a href="../membre/cart.php" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -15px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recherche Dans Manuel Et Guide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="Saissez le mot cl&eacute;" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End class="d-flex m-3 me-0 gap-4"
    row row-cols-2 gy-3 

    class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
    -->

    <!--CRUD-->
    <div class="container-fluid  py-4 mb-4 hero-header">
        <div class="container py-0">
            <div class="row row-cols-2 py-4 gx-2">
                <div class="col-3">

                    <div class="row">
                        <form>
                            <button class="btn btn-border-none text-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAjouterEpices" id="ajouterepice">Ajouter &Eacute;pice

                            </button>
                        </form>
                    </div>

                    <div class="row">
                        <form id="formedit" action="../epices/EpiceControleur.php" method="POST">
                            <button class="btn btn-border-none text-primary" type="button" id="editEpice" data-bs-toggle="modal" data-bs-target="#modalEditerEpices">Modifier &Eacute;pice
                            </button>
                        </form>
                    </div>

                    <div class="row">
                        <form id="formEnlever" action="../gestionEpice/supprimerEpice.php" method="POST">
                            <button class="btn btn-border-none text-primary" type="button" id="idar" name="idar" data-bs-toggle="modal" data-bs-target="#modalSupprimerEpices">Supprimer &Eacute;pice

                            </button>
                        </form>
                    </div>


                    <div class="row">
                        <form id="formEnleverMultiples" action="../epices/supprMultiEpice.php" method="POST">
                            <button class="btn btn-border-none text-primary" type="button" id="idaM" name="idaM" data-bs-toggle="modal" data-bs-target="#modalSupprimerMulti-Epices">Multi-Suppression d&#39;&Eacute;pice

                            </button>
                        </form>
                    </div>

                    <div class="row">
                        <form>
                            <button class="btn btn-border-none text-primary" type="btn primary" id="desactive">D&eacute;sactiver Membre

                            </button>
                        </form>
                    </div>

                    <div class="row">
                        <form>
                            <button class="btn btn-border-none text-primary" type="button" id="active">Activer Membre

                            </button>
                        </form>
                    </div>
                </div>
                <!--=====Space pour lister les epices dans le tbody tag  formLister====-->
                <div class="col-9">
                    <form id="formLister" action="../gestionEpice/listerEpice.php" method="POST" onclick="lister();">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="selectAll">
                                            <label for="selectAll"></label>
                                        </span>
                                    </th>
                                    <th>Ide</th>
                                    <th>Nom</th>
                                    <th>Types</th>
                                    <th>Prix</th>
                                    <th>Vendeur</th>
                                    <th>Images</th>
                                    <th>Descriptions</th>
                                </tr>
                            </thead>
                            <tbody id="emp_body"></tbody>
                            <tfooter>
                                <tr>
                                    <th colspan="11">
                                        <div id="pager">
                                            <ul id="pagination" class="pagination-sm"></ul>
                                        </div>
                                    </th>
                                </tr>
                            </tfooter>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--=====Fin CRUD  -->

    <!-- Ajouter Epice Modal HTML -->
    <div class="modal fade" id="modalAjouterEpices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrer une &eacute;pice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAjouter" class="row  needs-validation" enctype="multipart/form-data" action="../gestionEpice/enregistrerEpice.php" method="POST" onSubmit="return valider();">
                        <div class="col-md-12">
                            <label for="ide" class="form-label">Ide</label>
                            <input type="text" class="form-control" id="ide" name="ide" placeholder="0" value="0" required readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="types" class="form-label">Types</label>
                            <select id="types" name="types" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option value="hachee">&Eacute;pice hach&eacute;e</option>
                                <option value="moulu">&Eacute;pice Moulues</option>
                                <option value="frais">&Eacute;pice Frais</option>
                                <option value="grain">&Eacute;pice en Grain</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="text" class="form-control" id="prix" name="prix" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="vendeur" class="form-label">Vendeur</label>
                            <input type="text" class="form-control" id="vendeur" name="vendeur" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="images_aj" class="form-label">Images</label>
                            <input type="file" class="form-control" id="images_aj" name="images_aj" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="descr_aj" class="form-label">Descriptions</label>
                            <input type="text" class="form-control" id="descr_aj" name="descr_aj" value="">
                        </div>
                        <div class="col-12">
                            <span>&nbsp;</span>
                        </div>
                        <!--button enregistrer Epice-->
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL AJOUTER-->

    <!--MODAL MODIFIER-->
    <div class="modal fade" id="modalEditerEpices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier l&#39;&eacute;pice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row  needs-validation" enctype="multipart/form-data" action="../articles/modifier.php" method="POST">
                        <div class="col-md-12">
                            <label for="ide_m" class="form-label">Ide</label>
                            <input type="text" class="form-control" id="ide_m" name="ide_m" value="" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="nom_m" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom_m" name="nom_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="types_m" class="form-label">Types</label>
                            <select id="types_m" name="types_m" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option value="hachee">&Eacute;pice hach&eacute;e</option>
                                <option value="moulu">&Eacute;pice Moulues</option>
                                <option value="frais">&Eacute;pice Frais</option>
                                <option value="grain">&Eacute;pice en Grain</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="prix_m" class="form-label">Prix</label>
                            <input type="text" class="form-control" id="prix_m" name="prix_m" value="">
                        </div>
                        <div class="col-md-12">
                            <label for="vendeur_m" class="form-label">Vendeur</label>
                            <input type="text" class="form-control" id="vendeur_m" name="vendeur_m" value="" required>
                        </div>

                        <div class="col-md-12">
                            <label for="images_edit" class="form-label">Images</label>
                            <input type="file" class="form-control" id="images_m" name="images_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="desc_m" class="form-label">Descriptions</label>
                            <input type="text" class="form-control" id="desc_m" name="desc_m" value="" required>
                        </div>

                        <div class="col-12">
                            <span>&nbsp;</span>
                        </div>
                        <!--button Modifier Epice-->
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL MODIFIER-->

    <!-- Delete Modal HTML -->
    <div class="modal fade" id="modalSupprimerEpices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr que vous voulez supprimer cet article ?</p>
                    <p class="text-warning"><small>Vous ne pouvez plus défaire cette action.</small></p>

                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Annuler">
                    <input type="button" onClick="supprimer();" class="btn btn-danger" value="Supprimer">

                </div>
            </div>
        </div>
    </div>
    <!--FIN Modal Delete-->

    <!-- 
<form id="formEnlever" action="../articles/enlever.php" method="POST">
        <input type="hidden" id="idar" name="idar" value="">
</form>
-->

    <!-- Formulaires -->

    <div class="toast-container posToast">
        <div id="toast" class="toast  align-items-center text-white bg-danger border-0" data-bs-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../../client/public/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
                <strong class="me-auto">Messages</strong>
                <small class="text-muted"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="textToast" class="toast-body">
                <!-- texte du Toast -->
            </div>
        </div>
    </div>

    <!--Modal Sup Multi-->
    <div class="modal fade" id="modalSupprimerMulti-Epices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr que vous voulez supprimer cet article ?</p>
                    <p class="text-warning"><small>Vous ne pouvez plus défaire cette action.</small></p>

                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Annuler">
                    <input type="button" onClick="enleverMultiplesArticles();" class="btn btn-danger" value="Supprimer-Multi-Epices">
                </div>
            </div>
        </div>
    </div>
    <!--Fin sup Multi-->

    <!--
    <form id="formEnleverMultiples" action="../articles/enleverMultiples.php" method="POST">
        <input type="hidden" id="idaM" name="idaM" value="">
    </form>
    -->

    <!--MODAL ACTIVER USER-->
    <!--FIN MODAL ACTIVER_USER-->

    <!--MODAL DESACTIVER_USER-->
    <!--FIN MODAL DESACTIVER_USER-->

    <!---->
    <!---->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">&Eacute;pices</h1>
                            <p class="text-secondary mb-0">Nouvelles des produits</p>
                        </a>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Pourquoi on nous aime</h4>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Lire plus</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Info Du Magasin</h4>
                        <a class="btn-link" href="">Apropos de nous</a>
                        <a class="btn-link" href="">Nous joindre</a>
                        <a class="btn-link" href="">Confidentialit&eacute;</a>
                        <a class="btn-link" href="">Terme & Condition</a>
                        <a class="btn-link" href="">Politique de retour</a>
                        <a class="btn-link" href="">FAQs & Aidep</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Compte</h4>
                        <a class="btn-link" href="">Mon compte</a>
                        <a class="btn-link" href="">Suivi des livraisons</a>
                        <a class="btn-link" href="">Panier</a>
                        <a class="btn-link" href="">Liste de voeux</a>
                        <a class="btn-link" href="">Historique des commandes</a>
                        <a class="btn-link" href="">Commande Internationale</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accept&eacute:</p>

                        <img src="../../client/public/images/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Chez &Eacute;pices Loubha</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!--Form-->

    <form id="formDec" action="../connexion/controleurConnexion.php" method="POST">
        <!-- Bloc de formulaire pour déconnecter l'utilisateur-->
        <!-- Formulaire avec les champs suivants : -->
        <input type="hidden" name="action" value="deconnexion">
    </form>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../client/public/js/monJS.js"></script>
    <script src="../../lib/waypoints/waypoints.min.js"></script>
    <script src="../../client/public/js/requetes.js"></script>
    <script src="../../lib/lightbox/js/lightbox.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>
</body>

</html>