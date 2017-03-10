<?php

include 'connect.php';
$bdd = mysqli_connect(SERVER,USER,PASS,DB);

$pseudo=mysqli_real_escape_string($bdd,htmlentities(trim($_POST['pseudo'])));
$email=mysqli_real_escape_string($bdd,htmlentities(trim($_POST['email'])));
$comment=mysqli_real_escape_string($bdd,htmlentities(trim($_POST['comment'])));
$note=mysqli_real_escape_string($bdd,htmlentities(trim($_POST['note'])));
$valid_admin=mysqli_real_escape_string($bdd,htmlentities(trim($_POST['valid_admin'])));

if ($note==0 || $note==1 || $note==2 || $note==3 || $note==4 || $note==5)
{
    $sqlnp = "INSERT INTO commentaires (pseudo,email,comment,note) VALUES ('$pseudo','$email','$comment','$note')";
    mysqli_query ($bdd,$sqlnp);
    header('Location: index.php?commentaire=ok');
}

