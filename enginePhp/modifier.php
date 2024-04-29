<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try {
    //$show = print_r($_POST['dept']);
    //echo "<script>alert($show, 'you');</script>";
    if (isset($_POST['id'])) {
        $comment = $_POST['comment'];
        $idTravail = $_POST['id'];
        //$idStagiaire = $_POST['num'];
        //$idEnc = $_POST['numEnc'];
        $fichier = $_FILES['fichier'];

        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

        //debut de la transaction
        $mysqli->begin_transaction();

        //$id = getLastIndex();

        $req =  "UPDATE travaux_deposes SET commentaire='$comment', fichier='$fichier' 
                 WHERE id_travail='$idTravail'";
        //echo $req;

        if ($mysqli->query($req)) {

            //fin de la transcation
            $mysqli->commit();
            $mysqli->close();
            $_SESSION["successMsg"] = "Modification Réussie";
        } else {
            $_SESSION["errorMsg"] = "Erreur pendant la modification du dossier";
        }
    } else {
        $_SESSION["errorMsg"] = "Erreur de post";
    }

    header('Location: ../mes-travaux.php');
} catch (Exception $e) {
    $_SESSION["errorMsg"] = $e->getMessage();
    header('Location: ../mes-travaux.php');
}


function getLastIndex()
{
    try {
        $num = 0;

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

        $sql = "SELECT * FROM stagiaire ORDER BY id DESC
        LIMIT 1";
        // Exécution de la requête SELECT
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $accord = mysqli_fetch_assoc($result);
            $id = $accord['id'];
            $num = $id + 1;
        } else {
            $num = 1;
        }

        return $num;
    } catch (Exception $ex) {
        $msg =  $ex->getMessage();
        echo "<script>console.log('Error','$msg');</script>";
        $_SESSION["errorMsg"] = "Erreur pendant la récup du dernier index";
    }
}
