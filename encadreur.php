<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include("./enginePhp/main.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stagiaire</title>
    <link rel="stylesheet" href="../assets/font-awesome/fontawesome.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/css/style.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/themify-icons/themify-icons.css">
</head>

<body>

    <?php
    include("../gestion_stagiaire/enginePhp/showAlert.php");
    ?>

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
                            <?php
                            if ($notSubmittedWorksNum > 0) {
                                echo "<p class=\"notif-num\">$notSubmittedWorksNum</p>";
                            }
                            ?>
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
                <div class="top-title">Mon encadreur </div>

                <div class="dropdown">
                    <input type="checkbox" name="dropdown-check" id="dropdown-check">
                    <div class="bell-container">
                        <i class="fa fa-bell"></i>

                        <?php
                        if ($notSubmittedWorksNum > 0) {
                            echo "<p class=\"notif-num\">$notSubmittedWorksNum</p>";
                        }
                        ?>
                    </div>
                    <div class="dropdown-content">
                        
                    </div>
                </div>

            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders en-pic">

                    <img class="profile-img " src="../gestion_stagiaire/assets/imgs/customer02.jpg" alt="user profile">
                    <div class="profil-detail column align-center">
                        <b style="font-size: 20px;">Iswa Senteri Josué</b>

                        <div class="row wrap gap center">
                            <div class="column align-center">
                                <small>Departement</small>
                                <p>lambda</p>
                            </div>
                            <div class="column align-center">
                                <small>Téléphone</small>
                                <p>lambda</p>
                            </div>
                            <div class="column align-center">
                                <small>e-mail</small>
                                <p>lambda</p>
                            </div>
                        </div>
                        <br>
                        <a href="./mes-travaux.php" class="btn">Mes travaux</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../gestion_stagiaire/assets/js/main.js"></script>
</body>

</html>