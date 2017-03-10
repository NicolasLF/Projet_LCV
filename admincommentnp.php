<?php
include 'connectnp.php';
$bddnp=mysqli_connect(SERVER,USER,PASS,DB);

if(isset($_GET['id'])) {
    $id1 = $_GET['id'];
    mysqli_query($bddnp, "UPDATE commentaires SET valid_admin= 1 WHERE id= $id1 ");
    header('location: admincommentnp.php');
}
if(isset($_GET['ok'])) {
    $id2 = $_GET['ok'];
    mysqli_query($bddnp, "UPDATE commentaires SET valid_admin= 0 WHERE id= $id2 ");
    header('location: admincommentnp.php');
}

$resultatnp = mysqli_query($bddnp, 'SELECT * FROM commentaires');


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
        echo '<a href="admincommentnp.php?'.$i.'=' . $id . '">' . $affichage . '</a>';
}






