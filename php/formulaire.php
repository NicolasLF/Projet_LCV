<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta description="" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="LCV.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <meta charset="utf-8">
</head>

<body>
<h2>Inscription</h2>
<form method="POST" action="formulaire.php">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php
include 'inscription.php';
?>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>