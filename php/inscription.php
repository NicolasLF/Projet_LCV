<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 03/03/17
 * Time: 17:45
 */
include 'connexionbdd.php';

$pass1 = sha1($_POST['password']);
$pseudo1 = htmlentities($_POST['pseudo']);

$req1 = $bdd->prepare('SELECT * FROM membres WHERE pseudo=? ');
$req1->execute(array($pseudo1));
$donnees = $req1->fetch();
if (isset($_POST['pseudo'])) {
    if (!empty($donnees)) {

        echo 'Votre pseudo existe déjà';

    } else {
        $req = $bdd->prepare('INSERT INTO membres(pseudo,password) VALUE (?,?)');
        $req->execute(array($pseudo1, $pass1));
        echo 'Votre profil à bien été ajouté, Vous allez être redirigé vers le BO';
        session_start();
        $_SESSION['pseudo'] = $pseudo1;
        header("refresh:3;url=../BO.php");

    }
}?>