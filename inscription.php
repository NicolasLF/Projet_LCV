<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 03/03/17
 * Time: 17:45
 */
function verification($pseudo,$password)
{
    $verif = 0;
    if (strlen($pseudo) < 6) {
        $verif += 5;
    }
    if(preg_match("#[a-zA-Z]{6,}[0-9]+#", $password) == FALSE){
        $verif += 4;
    }
    return $verif;
}

include 'connect.php';
$bdd = mysqli_connect(SERVER,USER,PASS,DB);

$pass1 = sha1($_POST['password']);
$pseudo1 = htmlentities($_POST['pseudo']);

$req1 = mysqli_query($bdd,"SELECT * FROM client WHERE pseudo = '$pseudo1'");
while ($donnees = mysqli_fetch_assoc($req1)){

if (!empty($donnees)) {
    header('location: ../formulaire_membre.php?co=6');
    exit();
}
}
if (isset($_POST['pseudo']) AND isset($_POST['password'])) {
    if(verification($pseudo1,$_POST['password']) != 0){
        $var = verification($pseudo1,$_POST['password']);
        header('location: ../formulaire_membre.php?co=' .$var);
        exit();
    }
    else {
        foreach ($_POST as $key => $data) {
            $postClean[$key] = mysqli_real_escape_string($bdd, htmlentities(trim($data)));
        }
        $nom = $postClean['nom'];
        $prenom = $postClean['prenom'];
        $mail = $postClean['mail'];
        $tel = $postClean['tel'];

            mysqli_query($bdd,"INSERT INTO client(nom,prenom,mail,tel,password,pseudo) VALUES ('$nom','$prenom','$mail','$tel','$pass1','$pseudo1')");
            session_start();
            $_SESSION['pseudo'] = $pseudo1;
            $_SESSION ['prenom'] = $prenom;
            $_SESSION ['nom'] = $nom;
            $_SESSION ['mail'] = $mail;
            $_SESSION ['tel'] = $tel;
            $_SESSION['id'] =  mysqli_insert_id($bdd);
            $_SESSION['admin'] = 0;
            header('location: ../index.php?co=7');

        }
}
echo 'chelou';
?>