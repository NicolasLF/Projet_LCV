<?php
session_start();
/**if (isset($_SESSION['pseudo'])){
    header('Location: backOffice.php');
    exit();
}*/

include 'connect.php';
$bdd = mysqli_connect(SERVER,USER,PASS,DB);


if (isset($_POST['pseudo_ins']) AND isset($_POST['password_ins'])){
    $pseudo = $_POST['pseudo_ins'];
    $password = sha1($_POST['password_ins']);

    $req = mysqli_query($bdd,"SELECT * FROM client WHERE pseudo='$pseudo' AND password='$password'");
    while ($info = mysqli_fetch_assoc($req)){
    if (!$info){
        echo'erreur';
        session_destroy();
    }
    else{

        $_SESSION['pseudo'] = $info['pseudo'];
        $_SESSION ['prenom'] = $info['prenom'];
        $_SESSION ['nom'] = $info['nom'];
        $_SESSION ['mail'] = $info['mail'];
        $_SESSION ['tel'] = $info['tel'];
        $_SESSION['id'] =  $info['id'];
        $_SESSION['admin'] = $info['admin'];
        header('Location: index.php?ok=ok');

    }
}}else{
session_destroy();
header('Location: index.php');
}