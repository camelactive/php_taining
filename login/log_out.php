<?php
session_start();

function getCookieKeyByUser() {
    return isset($_COOKIE['auth']) ? $_COOKIE['auth'] : false;
}

if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
}

if(getCookieKeyByUser()) {
    setcookie('auth', $cookie_key, time(), '/');
}

header('Location: /login');