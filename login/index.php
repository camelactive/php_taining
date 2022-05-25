<?php
include('../database/db.php');

if(!empty($_GET['errors'])) {
    $errors = $_GET['errors'];
} else {
    $errors = '';
}


function randomCookie($len) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $len; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function setCookieUser($cookie_key, $time = 30) {
    setcookie('auth', $cookie_key, time() + $time, '/');
}

function setCookieKeyDb($user_id, $cookie_key) {
    $dbh = dbConnect();
    if($dbh) {
        $query = $dbh->prepare("UPDATE users SET cookie_key = :cookie_key WHERE id = :user_id");
        return $query->execute([
            'user_id' => $user_id,
            'cookie_key' => md5($cookie_key)
        ]);
    }
    return false;

}



function getAuthUser($username, $password) {
    $dbh = dbConnect();

    $query = $dbh->prepare("SELECT * from users WHERE username = :username AND `password` = :password");
    $query->execute([
        'username' => $username,
        'password' => $password
    ]);



    $result = $query->fetch();

    dbClose($dbh);

    return $result;
}

function setSessionUser($username, $email, $birthday) {
    session_start();
    $_SESSION['user'] = compact('username', 'email', 'birthday');
}




if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)) {

        $result = getAuthUser($username, $password);

        if($result) {

            setSessionUser($result['username'], $result['email'], $result['birthday']);
            
            $is_remember = isset($_POST['remember']) ? $_POST['remember'] : false;

            if($is_remember && $cookie_key = randomCookie(20)) {
                if(setCookieKeyDb($result['id'], $cookie_key)) setCookieUser($cookie_key, 40);
            }
        
            header("Location: /admin/index.php");

        } else {
            $errors = 'not_found_user!';
            header("Location: /login/index.php?errors=$errors");
        }
    }

} else {
    require_once('./templates/index.php');
}

