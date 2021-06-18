<?php
    require('config.php');

    try {
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname .';charset=utf8', $mysql_user, $mysql_password);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>