<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
//include("./enginePhp/main.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-vous</title>
    <link rel="stylesheet" href="../assets/font-awesome/fontawesome.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/css/style.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/isjoverform/isjoverform.css">
    <link rel="stylesheet" href="../gestion_stagiaire/assets/themify-icons/themify-icons.css">
</head>

<body>

    <?php
    require("../gestion_stagiaire/enginePhp/showAlert.php");
    ?>

    <div class="isjoverform2">
        <div id="signupFrm" class="signupFrm">
            <div class="wrapper">
                <form class="form" action="./enginePhp/login.php" method="POST">
                    <div style="color: var(--blue);" id="form-title" class="top-title">Connectez-vous</div>
                    <br>
                    <br>
                    <div class="inputContainer">
                        <input id="useremail" name="useremail" type="email" placeholder="a" class="input" required>
                        <label for="useremail" class="label">Email</label>
                    </div>
                    <div class="inputContainer">
                        <input id="userpassword" name="userpassword" type="password" placeholder="a" class="input" required>
                        <label for="pass" class="label">Code</label>
                    </div>
                    <div class="inputContainer align-center">
                        <input id="rememberuser" name="rememberuser" type="checkbox">
                        <label for="rememberuser" class="label">Se souvenir de moi</label>
                    </div>
                    <div class="row gap">
                        <button id="btn-add-enc" class="btn">Login</button>
                        <div onclick="closeIsjForm2(0)" class="btn btn-secondary">Annuler</div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="../gestion_stagiaire/assets/js/main.js"></script>
    <script src="./engineJs/main.js"></script>
</body>

</html>