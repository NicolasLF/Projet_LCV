<?php
    include 'header.php';
    include 'connect.php';
    $bdd = mysqli_connect(SERVER, USER, PASS, DB);

echo'<h2>Liste des abonnés à la newsletter :</h2>';

    $req = "SELECT idabonnes, nom, prenom, date_naissance, email FROM abonnes";

    $res = mysqli_query($bdd, $req);

    echo ' <div class="row"> 
                <div class="col-xs-12">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Email</th>
                            <th>Action</th>                             
                        </tr>';

    while($data = mysqli_fetch_assoc($res)){
        echo'           <tr> 
                            <td>'.$data['idabonnes'].'</td>
                            <td>'.$data['nom'].'</td>
                            <td>'.$data['prenom'].'</td>
                            <td>'.$data['date_naissance'].'</td>
                            <td>'.$data['email'].'</td>
                            <td><a href="modif.php?id='.$data['idabonnes'].'" class="btn btn-default">Modifier</a><a href="delete.php?id='.$data['idabonnes'].'" class="btn btn-danger">Effacer</a></td>
                                  
                        </tr>';
    }
    echo  '             <tr><a href="nouveau.php" class="btn btn-success">Créer</a></tr> 
                    </table>
                 </div>
            </div>';

    include 'footer.php';