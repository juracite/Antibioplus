<?php

include_once '../../Connexion/Config.php';

$Nom = $_POST["Nom"];



if ($_POST["Nom"] == "") {
    header("location: Ajout-antibiotique-form.php?er=nom");
    die();
}

  if(isset($_GET["er"])){
        switch ($_GET["er"]) {
            case "nom" :
                echo ' <h3> Erreur : Nom non renseigné </h3><br> ';
                break;
            
            default :
                break;
                        }
                    }

$db = new PDO("mysql:host=" . Config::SERVERNAME . ";dbname=" . Config::DBNAME, Config::USER, Config::PASSWORD);

$req = $db->prepare("INSERT INTO antibiotique (Nom_antibiotique) VALUES (:nom)");
$req->bindParam(":nom", $Nom);

$req->execute();

if ($req->errorInfo()[0] == '00000') {
    header("location: ../Page-acceuil-admin.php?mes=antiok");
}

if ($req->errorInfo()[0] != '00000') {
    header("location: ../Page-acceuil-admin.php?mes=fail-anti");
}

