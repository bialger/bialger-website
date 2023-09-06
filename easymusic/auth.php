<?php
    $do = true;
    $auth = false;
    foreach ($_GET as $get) {
        if (($get == "") || (trim($get) == "")) $do = false;
    }
    if (isset($_GET['login']) && isset($_GET['password']) && isset($_GET['mac']) && $do) {
        $slogin = htmlentities($_GET['login']);
        $spassw = htmlentities($_GET['password']);
        $mac = htmlentities($_GET['mac']);
        $login = hash("sha512", $slogin);
        $passw = hash("sha512", $spassw);
        $login_id = hash("sha512", $login.$mac);
        include "./hashes.php";
        include "./hash_eq.php";
        foreach ($hashes as $hashp) {
            if (hash_equals($hashp[0], $login) && hash_equals($hashp[1], $passw)){
                $auth = true;
                break;
            }
        }
    }
	if ($auth) echo("$auth\n$login\n$passw\n$login_id");
	else echo(0);
?>