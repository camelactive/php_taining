<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    session_start();

    if($_SESSION['user']) {
        $user = $_SESSION['user'];
        require_once('./templates/index.php');
    } else {
        $errors = 'not authorizate!';
        header("Location: /login?errors=$errors");
    }

}