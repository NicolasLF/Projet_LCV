<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 03/03/17
 * Time: 17:57
 */
try{

$bdd = new PDO('mysql:host=localhost;dbname=nlf_lcv;charset=utf8','root','root');

}

catch (Exception $e)

{

    die('Erreur : ' . $e->getMessage());

}
?>