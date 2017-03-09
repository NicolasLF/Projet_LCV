<?php
session_start();

function alerte($num, $text)
{
    $alerte = array(
        1 => '<div class="alert alert-danger" role="alert"><p class="">' . $text . '</p></div>',
        2 => '<div class="alert alert-warning" role="alert"><p class="">' . $text . '</p></div>',
        3 => '<div class="alert alert-success" role="alert"><p class="">' . $text . '</p></div>',
        4 => '<div class="alert alert-warning" role="alert"><p class="">Votre mot de pass est incorrect</p></div>',
        5 => '<div class="alert alert-warning" role="alert"><p class="">Votre pseudo est trop court</p></div>',
        9 => '<div class="alert alert-warning" role="alert"><p class="">Votre pseudo est trop court</p></div><div class="alert alert-warning" role="alert"><p class="">Votre mot de pass est incorrect</p></div>',
        0 => '<div class="alert alert-warning" role="alert"><p class="">Merci de vous connecter pour accéder au BO</p></div>',
        6 => '<div class="alert alert-warning" role="alert"><p class="">Ce pseudo existe déjà</p></div>',
        7 => '<div class="alert alert-success" role="alert"><a href="BO.php">>>>>Félicitation, votre inscription a été enregistré. Direction le BO en cliquant ici<<<< </a></div>',
        10 => '<div class="alert alert-danger" role="alert"><p class="">L\'item a été correctement supprimer</p></div>',
        11 => '<div class="alert alert-success" role="alert"><p class="">L\'item a été correctement mis à jour</p></div>',
        12 => '<div class="alert alert-success" role="alert"><p class="">Vous avez correctement ajouté un item à votre menu</p></div>');
    return $alerte[$num];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta description="" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/background.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <meta charset="utf-8">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_GET['erreur'])) {
                echo alerte(1, 'Il faut être admin pour accéder à cette partie ;)');
            }elseif(isset($_GET['co'])){
                echo alerte($_GET['co'],'');
            }
            ?>
        </div>
        <div class="col-sm-6">
            <h2>Inscription</h2>
            <form method="POST" action="inscription.php">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="nom" name="nom" class="form-control" id="name" placeholder="nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <input type="prenom" name="prenom" class="form-control" id="prenom" placeholder="Prenom">
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="mail" name="mail" class="form-control" id="mail" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="tel" name="tel" class="form-control" id="tel" placeholder="tel">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-sm-6">
            <h2>Connexion</h2>
            <form method="POST" action="connexion.php">
                <div class="form-group">
                    <label for="pseudo_ins">Pseudo</label>
                    <input type="text" name="pseudo_ins" class="form-control" id="pseudo_ins" placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <label for="password_ins">Password</label>
                    <input type="password" name="password_ins" class="form-control" id="password_ins" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
var_dump($_SESSION);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>