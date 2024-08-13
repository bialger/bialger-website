<?php
    include "./hashes.php";
    include "./hash_eq.php";
    include "./secrets.php";
    $do = true;
    $auth = false;
    foreach ($_POST as $post) {
        if (($post == "") || (trim($post) == "")) $do = false;
    }
    if ((count($_POST) == 3) && $do) {
        $slogin = htmlentities($_POST['login']);
        $spassw = htmlentities($_POST['password']);
        $login = hash("sha512", $slogin);
        $passw = hash("sha512", $spassw);
        $login_id = hash("sha512", $_SERVER['HTTP_USER_AGENT'].$secrets["lid-code"]);
        foreach ($hashes as $hashp) {
            if (hash_equals($hashp[0], $login) && hash_equals($hashp[1], $passw)){
                $auth = true;
                break;
            }
        }
    }
    if ($auth) {
        setcookie ("user-bialger", $login, time()+(86400), "/");
        setcookie ("passw-bialger", $passw, time()+(86400), "/");
        setcookie ("lid-bialger", $login_id, time()+(86400), "/");
        if ((count($_GET) >= 1) and isset($_GET['retpath'])) {
            header('Location: https://bialger.com/'.substr($_GET['retpath'], 1));
        }
        else {
            header('Location: https://bialger.com/main.html');
        }
    }
    else {
        header('Location: https://bialger.com/incorrect.html');
    }
    die();
?>
