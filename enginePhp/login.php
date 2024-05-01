<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

login();

function login()
{
    if (isset($_POST['useremail'])) {
        try {
            $useremail = $_POST['useremail'];
            $userpassword = $_POST['userpassword'];
            $rememberuser = false;

            if (isset($_POST['rememberuser'])) {
                $rememberuser = $_POST['rememberuser'];
            }

            $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
            $req = "";
            $req = "SELECT * FROM stagiaire_v WHERE useremail='$useremail'";

            // Exécution de la requête SELECT
            $result = $mysqli->query($req);
            $user = $result->fetch_assoc();
            if (mysqli_num_rows($result) > 0) {
                //$userpassword==$user['userpassword'] //password_verify($userpassword, $user["userpassword"])
                if ($userpassword == $user["userpassword"]) {
                    //echo "<script>alert($toShow);</script>";
                    if ($rememberuser) {
                        $_SESSION['user-stagiaire'] = $user;
                    } else {
                        $_SESSION['user-stagiaire'] = $user;
                        //register_shutdown_function('session_destroy');
                    }
                    //echo "SAVED==";
                    //print_r($_SESSION['user']);
                    $_SESSION["successMsg"] = "Connection reussi";
                    $_SESSION['user-stagiaire'] = $user;
                    header('Location: ../');
                } else {
                    $_SESSION["errorMsg"] = "Nom d'utilisateur ou mot de passe incorrect1";
                    header('Location: ../login-page.php');
                }
            } else {
                $_SESSION["errorMsg"] = "Nom d'utilisateur ou mot de passe incorrect";
                header('Location: ../login-page.php');
            }

        } catch (Exception $e) {
            $msg = $e->getMessage();
            $_SESSION["errorMsg"] = "Erreur : $msg";
            header('Location: ../login-page.php');
        }

    } else {
        $_SESSION["errorMsg"] = "Aucun paramètre";
        header('Location: ../login-page.php');
    }
    //echo $_SESSION["errorMsg"];
    //header('Location: ../');
}

function sendMsg($status, $data)
{
	$jsonMsg = (json_encode([
		'status' => $status,
		'data' => $data
	]));
    //$_SESSION["successMsg"] = "Depôt Réussie";

	echo $jsonMsg;
}