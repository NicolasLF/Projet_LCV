<?php
session_start();
if (isset($_SESSION['pseudo'])){
    header('Location: ../BO.php');
    exit();
}

include 'connexionbdd.php';


if (isset($_POST['pseudo_ins']) AND isset($_POST['password_ins'])){
    $pseudo = $_POST['pseudo_ins'];
    $password = sha1($_POST['password_ins']);

    $req = $bdd->prepare('SELECT * FROM membres WHERE pseudo=? AND password=?');
    $req->execute(array($pseudo,$password));
    $info = $req->fetch();
    if (!$info){
        echo'erreur';
        session_destroy();
    }
    else{

        $_SESSION['pseudo'] = $pseudo;
        header('Location: ../BO.php');

    }
}else{
session_destroy();
header('Location: ../BO.php');
}