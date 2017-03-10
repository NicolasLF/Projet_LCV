<?php

    include 'connect.php';
    include 'header.php';
    $bdd = mysqli_connect(SERVER, USER, PASS, DB);


    echo ' <form class="form-inline" method="POST" action="index.php">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" value="" id="nom" name="nom">
                    </div><br />
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" value="" id="prenom" name="prenom">
                    </div><br />
                    <div class="form-group">
                         <label for="date_naissance">Né(e) le :</label>
                         <input type="date" class="form-control" value="" id="date_naissance" name="date_naissance"/>
                    </div><br />
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" value="" id="email" name="email">
                    </div><br />
                    <input type="submit" name="btnSubmit" value="Je m\'abonne" class="btn btn-default"> </input>
            </form>';



        if (isset($_POST['btnSubmit'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $email = $_POST['email'];

            $req = "INSERT INTO abonnes (nom, prenom, date_naissance, email) VALUES ('$nom', '$prenom', '$date_naissance', '$email')";
            if(!mysqli_query($bdd, $req)) {
                echo mysqli_error($bdd);
            }
        };
