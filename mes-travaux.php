<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stagiaire</title>
    <link rel="stylesheet" href="../assets/font-awesome/fontawesome.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/css/style.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/isjoverform/isjoverform.css">
</head>

<body>

    <?php
    include("../gestion_stagiaire/enginePhp/showAlert.php");
    ?>

    <!-- =============== Invisible form ================ -->
    <div class="isjoverform2 isjform-hide">
        <div id="signupFrm" class="signupFrm">
            <div class="wrapper">
                <form class="form" action="./enginePhp/encadreur_crud.php" method="POST">
                    <div id="form-title" class="top-title">Deposer le travail N°</div>
                    <br>
                    <b>Travail pour le rapport de l'enquete</b>
                    <p>publié le 10/10/2024</p>
                    <br>
                    <br>
                    
                    <div style="display: none;" class="inputContainer">
                        <input id="id" name="id" type="number" placeholder="a" class="input" value="5" required>
                        <label for="id" class="label">Numéro du travail</label>
                    </div>
                    <div class="inputContainer">
                        <textarea class="input" name="comment" id="comment" cols="10" rows="5"></textarea>
                        <label for="comment" class="label">Commentaire</label>
                    </div>
                    <div class="inputContainer">
                        <input id="fichier" name="fichier" type="file" placeholder="a" class="input" required>
                        <label for="fichier" class="label">Fichier</label>
                    </div>
                    <div class="file-shower">
                        <div class="row align-center jr">
                            <span>Mon fichier.pdf</span>
                            <i style="color: var(--blue);font-size: 40px;" class="fa fa-file"></i>
                        </div>
                    </div>
                    <div class="row gap">
                        <button id="btn-add-enc" class="btn">Deposer</button>
                        <div onclick="closeIsjForm2(0)" class="btn btn-secondary">Annuler</div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <i id="closer" class="ti-close"></i>
            <ul>
                <li class="space-between align-center">
                    <a href="./index.html">
                        <span class="icon">
                            <i class="ti-layout-grid2-alt"></i>
                        </span>

                        <span class="title">Stagiaire</span>
                    </a>
                </li>

                <li>
                    <a href="./index.php">
                        <span class="icon">
                            <i class="ti-home"></i>
                        </span>
                        <span class="title">Accueil</span>
                    </a>
                </li>

                <li>
                    <a href="./mes-travaux.php">
                        <span class="icon">
                            <i class="ti-plus"></i>
                            <p class="notif-num">10</p>
                        </span>
                        <span class="title">Mes travaux</span>
                    </a>
                </li>

                <li>
                    <a href="./encadreur.php">
                        <span class="icon">
                            <i class="ti-user"></i>
                        </span>
                        <span class="title">Mon encadreur</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <i class="ti-power-off"></i>
                        </span>
                        <span class="title">Se deconnecter</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i id="menu-toggle" class="ti-menu"></i>
                </div>
                <div class="top-title">Mes travaux </div>

                <div class="dropdown">
                    <input type="checkbox" name="dropdown-check" id="dropdown-check">
                    <div class="bell-container">
                        <i class="fa fa-bell"></i>
                        <p class="notif-num">10</p>
                    </div>
                    <div class="dropdown-content">
                        <a class="row align-center gap align-center" href="">
                            <i class="fa-regular fa-file"></i>
                            <b>Depôt du rapport</b>
                        </a>
                        <a class="row align-center gap align-center" href="">
                            <i class="fa-regular fa-file"></i>
                            <b>Depôt du rapport</b>
                        </a>
                        <a class="row align-center gap align-center" href="">
                            <i class="fa-regular fa-file"></i>
                            <b>Depôt du rapport</b>
                        </a>
                        <a class="row align-center gap align-center" href="">
                            <i class="fa-regular fa-file"></i>
                            <b>Depôt du rapport</b>
                        </a>
                    </div>
                </div>

            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>List de mes travaux</h2>
                        <i onclick="reloadTable();" class="ti-reload small-btn"></i>
                        <div class="search">
                            <label>
                                <input id="searchText" type="text" placeholder="Recherhcer">
                                <i id="searchBtn" class="ti-search"></i>
                            </label>
                        </div>
                    </div>
                    <table id="workTable">
                        <thead>
                            <tr>
                                <td>Num</td>
                                <td>Description du tavail</td>
                                <td>Date de publication</td>
                                <td>Statut</td>
                                <td>points obenu</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../gestion_stagiaire/assets/isjoverform/isjoverform.js"></script>
    <script src="../gestion_stagiaire/assets/js/main.js"></script>

</body>

</html>