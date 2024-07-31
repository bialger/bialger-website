<?php
    setcookie ("user-bialger", "guest", time()+(86400), "/");
    setcookie ("passw-bialger", "password", time()+(86400), "/");
    setcookie ("lid-bialger", hash("sha512", $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']), time()+(86400), "/");
    if ((count($_GET) >= 1) and isset($_GET['retpath'])) {
        header('Location: https://bialger.com/'.substr($_GET['retpath'], 1));
    }
    else {
        header('Location: https://bialger.com/main.html');
    }
    die();
?>
