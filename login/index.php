<?php


if(!empty($_GET['errors'])) {
    $errors = $_GET['errors'];
} else {
    $errors = '';
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $query = $dbh->prepare("SELECT * from users WHERE username = :username AND `password` = :password");
        $query->execute([
            'username' => $username,
            'password' => $password
        ]);

        $result = $query->fetch();

        if($result) {

            $username = $result['username'];
            $email = $result['email'];
            $birthday = $result['birthday'];
            
            $is_reemember = isset($_POST['remember']) ? $_POST['remember'] : false;
            
            session_start();

            $_SESSION['user'] = compact('username', 'email', 'birthday');

            header("Location: /admin/index.php");

        } else {
            $errors = 'not_found_user!';
            header("Location: /login/index.php?errors=$errors");
        }
    }

} else {
    require_once('./templates/index.php');
}

$dbh = null;
