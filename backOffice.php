<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 07/03/17
 * Time: 17:45*/
session_start();
//if(isset($_SESSION['admin']) || $_SESSION['admin'] != '1') {
//  header('location: formulaire_membre.php?erreur=no');
//}
include 'connect.php';
$bdd = mysqli_connect(SERVER, USER, PASS, DB);
include 'function.php';

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

if (!empty($_POST)) {
    foreach ($_POST as $key => $data) {
        $postClean[$key] = mysqli_real_escape_string($bdd, htmlentities(trim($data)));
    }
// Requete de mise à jour
    if (isset($_POST['modifier']) && $_POST['safe'] == 1) {
        $id = $postClean['id'];
        $nom = $postClean['nom'];
        $prix = $postClean['prix'];
        $qte = $postClean['qte'];
        $postClean['safe']++;
        mysqli_query($bdd, "UPDATE ingredient SET nom = '$nom', prix = $prix, qte = $qte WHERE id = $id");
        header('location: backOffice.php?mess=11');
    }

//Requete ajouter ingredient
    if (isset($_POST['ajouter'])) {
        $nom = $postClean['nom'];
        $prix = $postClean['prix'];
        $qte = $postClean['qte'];
        $img = $postClean['img'];
        mysqli_query($bdd, "INSERT INTO ingredient (nom,prix,qte,img) VALUES ('$nom',$prix,$qte,'$img')");
        header('location: backOffice.php?mess=12');
    }
    if (isset($_POST['update'])) {
        $idcmd1 = $postClean['idcmd'];
        mysqli_query($bdd, "UPDATE commande SET statut = 1 WHERE id = $idcmd1");
        header('location: backOffice.php?mess=11');
    }
}

$req = "SELECT * FROM ingredient";
$resultat = mysqli_query($bdd, $req);

$req1 = "SELECT commande.*,commande.id as idcommande,client.id as idclient,client.* FROM commande INNER JOIN client ON commande.client_id = client.id WHERE commande.statut = 0 ORDER BY idcommande DESC";
$resultat1 = mysqli_query($bdd, $req1);

$req4 = "SELECT COUNT(id) as countiding FROM ingredient";
$ingredientCount = mysqli_query($bdd, $req4);

$req5 =  "SELECT * FROM commande WHERE statut = 1";
$compta = mysqli_query($bdd, $req5);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/background.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>

<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseBagels" aria-expanded="false"
        aria-controls="collapseBagels">
    Gestion Bagels
</button>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseNews" aria-expanded="false"
        aria-controls="collapseNews">
    Newsletters
</button>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAvis" aria-expanded="false"
        aria-controls="collapseAvis">
    Avis
</button>
<div class="collapse" id="collapseBagels">
    <div class="well">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    BONJOUR <?php if (isset($_SESSION['pseudo'])) {
                        echo $_SESSION['pseudo'];
                    } ?>
                </div>
                <div class="col-xs-12">
                    <?php
                    if (isset($_GET['mess'])) {
                        echo alerte($_GET['mess'], '');
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10">
                    <a class="pull-left btn btn-primary" role="button" data-toggle="collapse" href="#collapseIngredient"
                       aria-expanded="false" aria-controls="collapseExample">
                        <?php
                        while ($donneesCountIngredient = mysqli_fetch_assoc($ingredientCount)) {
                            echo 'Voir les ' . $donneesCountIngredient['countiding'] . ' ingrendients';
                        }
                        ?>

                    </a>
                    <a class="pull-right btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample"
                       aria-expanded="false" aria-controls="collapseExample">
                        Ajouter un ingredient
                    </a>
                    <div class="col-xs-12 collapse coling" id="collapseExample">
                        <form class="form-group" method="POST" action="backOffice.php">
                            <input type="text" name="nom" value="" placeholder="Nom de l'ingredient">
                            <input type="text" name="prix" size="3" value="" placeholder="€">
                            <input type="text" name="qte" value="" placeholder="Stock">
                            <input type="text" name="img" value="" placeholder="url">
                            <input class="btn btn-danger" type="submit" value="ajouter" name="ajouter"/>
                        </form>
                    </div>

                </div>

                <div class=" col-xs-10">
                    <div class="collapse" id="collapseIngredient">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    Ingredients
                                </td>
                                <td>
                                    Prix
                                </td>
                                <td>
                                    Stock
                                </td>
                                <td>
                                    Image
                                </td>
                                <td>
                                    action
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($donnees = mysqli_fetch_assoc($resultat)) {
                                $qteint = intval($donnees["qte"]);
                                $class = '';
                                if ($qteint < 30) {
                                    $class = 'danger';
                                }
                                echo '
                <tr class="' . $class . '">
                <td>
                    ' . $donnees["nom"] . '
                </td>
                <td>
                    ' . $donnees["prix"] . ' €
                </td>
                <td>
                    ' . $donnees["qte"] . '
                </td>
                <td>
                    <img src="' . $donnees["img"] . '" class="picto_img">
                </td>
                <td class="">
                    <form method="POST" action="deleteIng.php">
                        <input type="hidden" name="id" value="' . $donnees['id'] . '"/>
                        <input  class="btn_inner btn btn-danger" type="submit" value="Supprimer" name="delete"/>
                    </form>
                    <a class="btn_inner btn btn-primary" role="button" data-toggle="collapse" href="#collapse' . $donnees['id'] . '" aria-expanded="false" aria-controls="collapse' . $donnees['id'] . '">
                    Modifier
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="collapse" id="collapse' . $donnees['id'] . '">
                     <form method="POST" action="backOffice.php">
                        <input type="hidden" name="id" value="' . $donnees['id'] . '"/>
                        <input type="hidden" name="safe" value="1" />
                        <input type="text" name="nom" value="' . $donnees['nom'] . '" placeholder="Nom de l\'ingredient">
                        <input type="text" name="prix" value="' . $donnees['prix'] . '" placeholder="€">
                        <input type="text" name="qte" value="' . $donnees['qte'] . '" placeholder="Stock">
                        <input  class=" btn btn-primary" type="submit" value="Modifier" name="modifier"/>
                    </form>
                    </div>
                </td>
            </tr>
                ';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>
                                Commande N°
                            </td>
                            <td>
                                Date
                            </td>
                            <td>
                                Nom du client
                            </td>
                            <td>
                                Telephone
                            </td>
                            <td>
                                Nbr de commande
                            </td>
                            <td>
                                Nbr de commande
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($donnees = mysqli_fetch_assoc($resultat1)) {
                            $nom = $donnees['nom'];
                            $reqCount = "SELECT COUNT(client.nom) as countnom FROM commande INNER JOIN client ON commande.client_id = client.id WHERE nom = '$nom'";
                            $resultatCount = mysqli_query($bdd, $reqCount);
                            $idcommande = $donnees["idcommande"];
                            echo ' 
            <tr>
                <td>
                    ' . $idcommande . '
                </td>
                <td>
                    ' . $donnees["date"] . '
                </td>
                <td>
                    <a data-toggle="modal" data-target="#fiche">' . $donnees["nom"] . '</a>
                    <div class="modal fade" id="fiche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">' . $donnees["prenom"] . ' ' . $donnees["nom"] . '</h4>
                          </div>
                          <div class="modal-body">
                            <table>
                                <tr>
                                    <td>
                                    Id du client : 
                                    </td>
                                    <td>
                                    ' . $donnees["id"] . '
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Nom : 
                                    </td>
                                    <td>
                                    ' . $donnees["nom"] . '
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    prenom : 
                                    </td>
                                    <td>
                                    ' . $donnees["prenom"] . '
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Mail : 
                                    </td>
                                    <td>
                                    ' . $donnees["mail"] . '
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Telephone : 
                                    </td>
                                    <td>
                                    ' . $donnees["tel"] . '
                                    </td>
                                </tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
                <td>
                     ' . $donnees["tel"] . '
                </td>
                <td>';
                            while ($donneesCount = mysqli_fetch_assoc($resultatCount)) {
                                echo $donneesCount['countnom'];
                            }
                            echo '
                </td>
                <td>
                        <!-- Button trigger modal -->
                    <a type="button" class="btn_inner btn btn-primary " data-toggle="modal" data-target="#myModal' . $idcommande . '">
                      Voir
                    </a>
                    <form method="POST" action="backOffice.php">
                        <input type="hidden" name="idcmd" value="' . $idcommande . '">
                        <button class="btn_inner btn btn-success" type="submit" name="update">Valider</button>
                    </form>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal' . $idcommande . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Commande N°' . $donnees['idcommande'] . '</h4>
                          </div>
                          <div class="modal-body">
                          Liste des ingrédients du Bagels :
                          <ul>
                          ';
                            $req3 = mysqli_query($bdd, "SELECT * FROM ingredient INNER JOIN ingredient_has_commande WHERE ingredient.id = ingredient_has_commande.ingredient_id AND ingredient_has_commande.commande_id = $idcommande");
                            $total = '';
                            while ($donnees1 = mysqli_fetch_assoc($req3)) {
                                echo '<li><img class="picto_img" src="' . $donnees1['img'] . '" ></li> ';
                                $total += $donnees1['prix'];
                            }
                            echo '
                                <li><strong>Prix total de la commande :</strong> ' . $total . '</li>
                            </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <form method="POST" action="backOffice.php">
                            <input type="hidden" name="idcmd" value="' . $idcommande . '">
                             <button type="submit" name="update" class="btn btn-success">Valider la commande</button>
                            </form>
                         
                             </div>
                        </div>
                      </div>
                    </div>
                </td>
                </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12">
                   <?php
                    $ca = '';
                   while ($comptabilite = mysqli_fetch_assoc($compta)){
                       $idcmd2 = $comptabilite['id'];
                       $nbcmd = count($comptabilite);
                       $req3 = mysqli_query($bdd, "SELECT * FROM ingredient INNER JOIN ingredient_has_commande WHERE ingredient.id = ingredient_has_commande.ingredient_id AND ingredient_has_commande.commande_id = $idcmd2");
                       while ($donnees5 = mysqli_fetch_assoc($req3)) {
                            $ca += intval($donnees5['prix']);

                   }}

                  echo 'Vous avez'. $nbcmd .'commande archivées pour un CA total de '. $ca.' €';
                   ?>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="collapse" id="collapseNews">
    <div class="well">
    <?php
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
        </div>'; ?>
    </div>
</div>
<div class="collapse" id="collapseAvis">
    <div class="well">
        <?php
        if(isset($_GET['id'])) {
            $id1 = $_GET['id'];
            mysqli_query($bdd, "UPDATE commentaires SET valid_admin= 1 WHERE id= $id1 ");
            //header('location: backOffice.php');
        }
        if(isset($_GET['ok'])) {
            $id2 = $_GET['ok'];
            mysqli_query($bdd, "UPDATE commentaires SET valid_admin= 0 WHERE id= $id2 ");
            //header('location: backOffice.php');
        }

        $resultatnp = mysqli_query($bdd, 'SELECT * FROM commentaires');


        while($donneesnp = mysqli_fetch_assoc($resultatnp)) {
            $id = $donneesnp['id'];
            $validid = $donneesnp['valid_admin'];
            echo '<br />';
            echo $donneesnp['pseudo'];
            echo '<br />';
            echo $donneesnp['comment'];
            echo '<br />';
            echo $donneesnp['note'];
            echo '<br />';
            if($validid == 1) {
                $affichage = 'ne pas afficher';
                $i = 'ok';
            }else{
                $affichage = 'afficher';
                $i = 'id';
            }
            echo '<a href="backOffice.php?'.$i.'=' . $id . '">' . $affichage . '</a>';
        }
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
