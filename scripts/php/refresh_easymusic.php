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
		$filenames = array("auth.php", "checkAuth.php", "download_current_app.php", "get_friend_info.php", "get_project.php", "mail.php", "prove_login.php", "useful.php", "auth_gen.php", "change_info.php", "dblib.php", "get_info.php", "hash_eq.php", "index.html", "upload_project.php", "user_req.php", "textResources/faq.txt", "textResources/terms.txt", "textResources/tutorial.txt", "textResources/version.txt");
		foreach($filenames as $filename) {
            $file = fopen("../../easymusic/".$filename, "w");
            fwrite($file, file_get_contents("https://raw.githubusercontent.com/bialger/easymusic-backend/master/".$filename));
            fclose($file);
        }
	}
?> 
