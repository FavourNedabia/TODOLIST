<?php
try {
    $dbb = new PDO('mysql:host=localhost;dbname=totolist;charset=utf8', 'root', '');
    $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}
