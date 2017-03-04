<?php
session_start();
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 04/03/17
 * Time: 16:53
 */
$_SESSION = array();

session_destroy();
header('Location: formulaire.php');