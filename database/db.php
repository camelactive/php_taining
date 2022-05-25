<?php
function dbConnect() {
  try {
        $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
        return $dbh;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return false;
    }
}

function dbClose(&$dbh) {
    $dbh = null;
}
?>