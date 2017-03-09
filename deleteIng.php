<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 08/03/17
 * Time: 09:32
 */
include 'connect.php';
$bdd = mysqli_connect(SERVER,USER,PASS,DB);

if(isset($_POST['delete']) && $_POST['delete'] == 'Supprimer'){
    $id = $_POST['id'];
    $req = "DELETE FROM ingredient WHERE id = $id";
    mysqli_query($bdd,$req);
    header('location: backOffice.php?mess=10');
}