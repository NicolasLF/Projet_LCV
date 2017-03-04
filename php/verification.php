<?php
session_start();
if (!isset($_SESSION['pseudo'])){
    header('location: php/formulaire.php?co=nulll');
    exit();
}
?>