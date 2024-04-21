<?php

try
{
    $pdo = new PDO("mysql:host=localhost;dbname=cinema", 'arnaud', '4731');
}

catch(Exception $e)
{
    echo 'Une erreur est survenue ! : ' . $e->getMessage();
    die();
}

?>