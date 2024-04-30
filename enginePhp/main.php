<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if(!isset($_SESSION["stagiaire"])){
    //header("Location: ./login.html");
}

$allWorks = array();
$notSubmittedWorks = array();
$submittedWorks = array();

$notSubmittedWorksNum = 0;
$submittedWorksNum = 0;
$allWorksNum = 0;

try {
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
    if (true) {
        $id = 14;

        $reqAllWorks = "SELECT * FROM travaux_v WHERE id_staigiare=$id ";
        $reqNotSubmittedWorks = "SELECT * FROM travaux_non_deposes WHERE id_staigiare=$id";
        $reqSubmittedWorks = "SELECT * FROM travaux_deposes_v WHERE id_staigiare=$id";
        //$reqAllFinishedStage = "SELECT * FROM stagiaire_v WHERE status='%Termine%' OR status='%fini%' OR status LIKE '%Terminé%'";

        //$finishedStage = array();

        $result = $mysqli->query($reqAllWorks);
        $allWorksNum = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $allWorks[] = $row;
        }

        $result = $mysqli->query($reqNotSubmittedWorks);
        $notSubmittedWorksNum = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $notSubmittedWorks[] = $row;
        }
        
        $result = $mysqli->query($reqSubmittedWorks);
        $submittedWorksNum = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $submittedWorks[] = $row;
        }

        /*
        $result = $mysqli->query($reqAllFinishedStage);
        while ($row = $result->fetch_assoc()) {
            $finishedStage[] = $row;
        } 
        */

        //echo "<script>console.log('lofjk');</script>";
    }
    else{
        //echo "<script>console.log('No Id fund');</script>";
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo "<script>console.log('$msg')</script>";
}
