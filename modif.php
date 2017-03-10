<?php
include 'connect.php';
$bdd = mysqli_connect(SERVER, USER, PASS, DB);
if(isset($_POST['btnSubmit'])){
    $req="UPDATE abonnes SET nom='" . $_POST['nom'] . "',prenom='" .$_POST['prenom'] . "', date_naissance='" .$_POST['date_naissance'] . "', email='" .$_POST['email'] ."' WHERE idabonnes=". $_GET['id'];
    $res=mysqli_query($bdd,$req);
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = "SELECT * FROM abonnes WHERE idabonnes=$id";
    $res = mysqli_query($bdd,$req);
    $data = mysqli_fetch_assoc($res);
}




echo ' <form class="form-inline" method="POST" action="modif.php?id=' .$id. '">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" value="' . $data['nom'] . '" id="nom" name="nom">
                    </div><br />
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" value="' . $data['prenom'] . '" id="prenom" name="prenom">
                    </div><br />
                    <div class="form-group">
                         <label for="date_naissance">Né(e) le :</label>
                         <input type="date" class="form-control" value="' . $data['date_naissance'] . '" id="date_naissance" name="date_naissance"/>
                    </div><br />
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" value="' . $data['email'] . '" id="email" name="email">
                    </div><br />
                    <input type="submit" name="btnSubmit" value="Actualiser" class="btn btn-default" href="backOffice.php"> </input>
                    <a href="backOffice.php" class="btn btn-default">Revenir à l\'admin</a>
            </form>';

