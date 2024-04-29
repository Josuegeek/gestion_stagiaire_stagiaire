<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try {
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

    $reqAllWorks = "SELECT * FROM stagiaire_v";
    $reqNotSubmittedWorks = "SELECT * FROM stagiaire_pro";
    //$reqAcademicStage = "SELECT * FROM stagiaire_academique";
    //$reqAllFinishedStage = "SELECT * FROM stagiaire_v WHERE status='%Termine%' OR status='%fini%' OR status LIKE '%Terminé%'";

    $allWorks = array();
    $notSubmittedWorks = array();
    //$academicStage = array();
    //$finishedStage = array();

    $result = $mysqli->query($reqAllWorks);
    while ($row = $result->fetch_assoc()) {
        $allWorks[] = $row;
    }

    $result = $mysqli->query($reqNotSubmittedWorks);
    while ($row = $result->fetch_assoc()) {
        $notSubmittedWorks[] = $row;
    }

    /*
    $result = $mysqli->query($reqAcademicStage);
    while ($row = $result->fetch_assoc()) {
        $academicStage[] = $row;
    }

    $result = $mysqli->query($reqAllFinishedStage);
    while ($row = $result->fetch_assoc()) {
        $finishedStage[] = $row;
    } 
    */

    echo (json_encode([
        'status' => 'success',
        'allWorks' => $allWorks,
        'nSWorks' => $notSubmittedWorks
    ]));
} 
catch (Exception $e) {
    $msg = $e->getMessage();
    echo (json_encode([
        'status' => 'error',
        'msg' => $msg
    ]));
}
