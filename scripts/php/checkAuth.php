<?php
    function inpath () {
        $raw_uri = $_SERVER['REQUEST_URI'];
        $uri = stristr($raw_uri, "?", true);
        if (stristr($raw_uri, '?') === false) {
            $uri = $raw_uri;
        }
        $inpath = "";
        $ar_uri = explode("/", $uri);
        switch (count($ar_uri)) {
            case 2:
                $inpath = "./scripts/php/";
            break;
            case 3:
                if ($ar_uri[1] == "scripts") $inpath = "./php/";
                else $inpath = "../scripts/php/";
            break;
            case 4:
                if ($ar_uri[1] == "scripts") {
                    if ($ar_uri[2] == "php") $inpath = "./";
                    else $inpath = "../php/";
                }
                else $inpath = "../../scripts/php/";
            break;
            default:
                $inpath = "./";
            break;
        }
        return $inpath;
    }
    function checkAccess () {
        $inpath = inpath();
        include $inpath."hashes.php";
        include $inpath."hash_eq.php";
        include $inpath."secrets.php";
        $cn = "user-bialger";
        $cu = "passw-bialger";
        $cl = "lid-bialger";
        $auth = false;
        $access = 4;
        if (isset($_COOKIE[$cn]) && isset($_COOKIE[$cu]) && isset($_COOKIE[$cl])) {
            $login = $_COOKIE[$cn];
            $passw = $_COOKIE[$cu];
            $login_id = $_COOKIE[$cl];
            if ($login != "guest") {
                foreach ($hashes as $hashp) {
                    if (hash_equals($hashp[0], $login) && hash_equals($hashp[1], $passw)){
                        $access = (int)$hashp[3];
                        break;
                    }
                }
            }
            else $access = 3;
            if (!hash_equals($login_id, hash("sha512", $_SERVER['HTTP_USER_AGENT'].$secrets["lid-code"]))) $access = 4;
        }
        return $access;
    }
    function checkUser($acc) {
        $auth = false;
        if (checkAccess() <= $acc) $auth = true;
        return $auth;
    }
    function checkAuth ($acc) {
        if (!checkUser($acc)) {
            header('Location: https://bialger.com/index.html?retpath='.$_SERVER['REQUEST_URI']);
            die();
        }
    }
    function showSmth ($str, $acc) {
        if (checkUser($acc)) echo $str;
    }
?>
