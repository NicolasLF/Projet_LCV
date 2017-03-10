<?php
    include 'connect.php';
    $bdd = mysqli_connect(SERVER, USER, PASS, DB);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $req = "DELETE FROM abonnes WHERE idabonnes = ".$id."";
        $res = mysqli_query($bdd,$req);
    }

header('Location:backOffice.php');
