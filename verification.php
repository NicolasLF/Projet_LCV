<?php
session_start();
if (!isset($_SESSION['pseudo'])){
    header('location: formulaire.php?co=0');
    exit();
}
?>