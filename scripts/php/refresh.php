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
		$filenames = array("index.html"); # TODO: enlarge
		foreach($filenames as $filename) {
            $file = fopen("../../".$filename, "w");
            fwrite($file, file_get_contents("https://raw.githubusercontent.com/bialger/bialger-website/master/".$filename));
            fclose($file);
        }
	}
?> 
