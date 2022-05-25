<?php
include('../database/db.php');

function getCookieKeyByUser() {
    return isset($_COOKIE['auth']) ? $_COOKIE['auth'] : false;
}

function getUserByCookieKeyDb($cookie_key) {
    $dbh = dbConnect();

    if($dbh) {
        $query = $dbh->prepare("SELECT * FROM users WHERE cookie_key = :cookie_key");
        $query->execute([
            'cookie_key' => md5($cookie_key)
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    dbClose($dbh);

    return false;
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
 
    session_start();
    
    $is_auth = false;

    if($cookie_key = getCookieKeyByUser()) {
        $is_auth = getUserByCookieKeyDb($cookie_key);
    }

    $user = $_SESSION['user'] ?? $is_auth;
    
    if($user) {
        require_once('./templates/index.php');
    } else {
        $errors = 'not authorizate!';
        header("Location: /login?errors=$errors");
    }

}