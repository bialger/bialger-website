<?php
    $do = true;
    $auth = false;
    foreach ($_POST as $post) {
        if (($post == "") || (trim($post) == "")) $do = false;
    }
    if ((count($_POST) == 2) && $do) {
        $slogin = htmlentities($_POST['login']);
        $spassw = htmlentities($_POST['password']);
        $login = hash("sha512", $slogin);
        $passw = hash("sha512", $spassw);
        $login_id = hash("sha512", $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        include "./hashes.php";
        include "./hash_eq.php";
        foreach ($hashes as $hashp) {
            if (hash_equals($hashp[0], $login) && hash_equals($hashp[1], $passw) && ($hashp[3] === '0')) {
                $auth = true;
                break;
            }
        }
    }
    if ($auth) {
		$filenames = array("admin.html", "clav.html", "crypt0.html", "defacto.html","easymusic.html", "holocorn.html", "holocron.html", "incorrect.html", "index.html", "main.html", "pycl.html", "user_gen.html", "user_req.html", "weather-forecast.html", "err/400.html", "err/403.html", "err/404.html", "err/500.html", "err/index.html", "scripts/index.html", "scripts/js/index.html", "scripts/js/player.js", "scripts/js/validation.js", "scripts/php/auth_gen.php", "scripts/php/dblib.php", "scripts/php/hash_eq.php", "scripts/php/html_incl.php", "scripts/php/index.html", "scripts/php/message.php", "scripts/php/testcode.php", "scripts/php/user_req.php", "scripts/php/auth.php", "scripts/php/checkAuth.php", "scripts/php/guest.php", "scripts/php/important.php", "scripts/php/mail.php", "scripts/php/refresh.php", "scripts/php/testmail.php", "scripts/php/refresh_easymusic.php", "style/index.html", "style/style.css", "style/style-login.css");
		foreach($filenames as $filename) {
            $file = fopen("../../".$filename, "w");
            fwrite($file, file_get_contents("https://raw.githubusercontent.com/bialger/bialger-website/master/".$filename));
            fclose($file);
        }
	}
?> 
