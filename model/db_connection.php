<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=olocal', 'osvaldo', 'LHo3.S');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

