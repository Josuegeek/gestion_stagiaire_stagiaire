<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include("./enginePhp/main.php");
$classStatus="";

if(isset($USER["status"])){
    if($USER["status"]=="En cours"){
        $classStatus = "delivered";
    }
    else{
        $classStatus = "return";
    }
}

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
                    <a href="#">
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

                <li onclick="deconnexionStagiaire()">
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
                <div class="top-title">Bienvenue <?php echo $USER["nom_complet"];?></div>

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
                        <?php
                        if ($notSubmittedWorksNum > 0) {
                            foreach ($notSubmittedWorks as $workindex => $work) {
                                $description = $work["description"];
                                $id = $work["id"];
                                $date = $work["date_fin"];
                                echo "<a class=\"row gap align-center\" href=\"#\">
                                            <p>$description à deposer au plus tard $date</p>
                                            <i class=\"fa-regular fa-file\"></i>
                                        </a>";
                            }
                        }
                        else{
                            echo "Pas de tâche pour le moment";
                        }
                        ?>
                    </div>
                </div>

            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">

                    <div class="couverture gap">
                        <p>Stagiaire <?php echo $USER["type_stage"];?></p>
                        <span class="<?php echo $classStatus;?>"><?php echo $USER["status"];?></span>
                    </div>
                    <img class="profile-img" src="../gestion_stagiaire/assets/imgs/customer02.jpg" alt="user profile">
                    <div class="profil-detail column align-center">
                        <b style="font-size: 20px;"><?php echo $USER["nom_complet"];?></b>

                        <div class="row wrap gap center">
                            <div class="column align-center">
                                <small>province d'origine</small>
                                <p><?php echo $USER["province"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>district d'origine</small>
                                <p><?php echo $USER["district"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>village d'origine</small>
                                <p><?php echo $USER["village"];?></p>
                            </div>
                        </div>
                        <div class="row wrap gap center">
                            <div class="column align-center">
                                <small>Lieu et date de naissance</small>
                                <p><?php echo $USER["lieu_naissance"].", ".$USER["date_naissance"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>Adresse complet</small>
                                <p><?php echo $USER["adresse"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>Téléphone</small>
                                <p><?php echo $USER["telephone"];?></p>
                            </div>
                        </div>
                        <div class="row wrap gap center">
                            <div class="column align-center">
                                <small>Faculté</small>
                                <p><?php echo $USER["fac"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>Departement</small>
                                <p><?php echo $USER["dept_fac"];?></p>
                            </div>
                            <div class="column align-center">
                                <small>Directeur</small>
                                <p><?php echo $USER["directeur"];?></p>
                            </div>
                        </div>
                        <div class="row wrap gap">
                            <div class="column align-center">
                                <small>Stage dans le departement</small>
                                <b><?php echo $USER["departement"];?></b>
                            </div>
                            <div class="column align-center">
                                <small>Fonction/titre</small>
                                <b><?php echo $USER["fonction"];?></b>
                            </div>
                        </div>
                        <div class="row wrap gap center">
                            <div class="column align-center">
                                <small>Date de debut du stage</small>
                                <b><?php echo $USER["date_debut"];?></b>
                            </div>
                            <div class="column align-center">
                                <small>Durée </small>
                                <b><?php echo $USER["duree"]." mois";?></b>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../gestion_stagiaire/assets/js/main.js"></script>
    <script src="./engineJs/main.js"></script>
</body>

</html>