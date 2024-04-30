<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST['operation'])) {
    echo $_POST['operation'];
    if ($_POST['operation'] == "insert") {
        deposer();
    } else if ($_POST['operation'] == "edit") {
        modifier();
    }
}

//fonction pour deposer le travail
function deposer()
{
    try {
        //$show = print_r($_POST['dept']);
        //echo "<script>alert($show, 'you');</script>";
        if (isset($_POST['id'])) {
            $comment = $_POST['comment'];
            $idTravail = $_POST['id'];
            //$idStagiaire = $_POST['num'];
            //$idEnc = $_POST['numEnc'];
            $fichier = "";

            if (saveFile() != false) {
                $fichier = $_FILES["fichier"]['name'];

                $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

                //debut de la transaction
                $mysqli->begin_transaction();

                //$id = getLastIndex();

                $req =  "INSERT INTO travaux_deposes(id_travail, commentaire, fichier)
                    VALUES ('$idTravail','$comment','$fichier')";
                echo $req;

                if ($mysqli->query($req)) {

                    $req =  "UPDATE travaux SET statut='Deposé'
                    WHERE id='$idTravail'";
                    echo $req;
                    if ($mysqli->query($req)) {
                        //fin de la transcation
                        $mysqli->commit();
                        $mysqli->close();
                        $_SESSION["successMsg"] = "Depôt Réussie";
                    } else {
                        $_SESSION["errorMsg"] = "Echec pendant la mise à jour";
                    }
                } else {
                    $_SESSION["errorMsg"] = "Erreur pendant le depôt du dossier";
                }
            } else {
                $_SESSION["errorMsg"] = "Erreur pendant le depôt du fichier";
            }
        } else {
            $_SESSION["errorMsg"] = "Erreur de post";
        }

        header('Location: ../mes-travaux.php');
    } catch (Exception $e) {
        $_SESSION["errorMsg"] = $e->getMessage();
        header('Location: ../mes-travaux.php');
    }
}

//fonction pout modifier le travail
function modifier()
{
    try {
        //$show = print_r($_POST['dept']);
        //echo "<script>alert($show, 'you');</script>";
        if (isset($_POST['id'])) {
            $comment = $_POST['comment'];
            $idTravail = $_POST['id'];
            //$idStagiaire = $_POST['num'];
            //$idEnc = $_POST['numEnc'];
            $fichier = "";
            if (saveFile() != false) {
                $fichier = $_FILES["fichier"]['name'];
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
            }
            else{
                $_SESSION["errorMsg"] = "Erreur pendant la modification du fichier";
            }
        } else {
            $_SESSION["errorMsg"] = "Erreur de post";
        }

        header('Location: ../mes-travaux.php');
    } catch (Exception $e) {
        $_SESSION["errorMsg"] = $e->getMessage();
        header('Location: ../mes-travaux.php');
    }
}

//fonction pour sauvegarder le fichier uplodé
function saveFile()
{
    $name = "Stagiaire 1";
    $folder = "../fichiers_stagiaires/$name/";
    $file_name = $_FILES["fichier"]['name'];
    $destination = "$folder/$file_name";
    if (!is_dir($folder)) {
        mkdir("$folder");
        //mkdir("../../managing/accords/accord$num/img/");
    }

    if (move_uploaded_file($_FILES["fichier"]['tmp_name'], $destination))
        return $file_name;
    else return false;
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
