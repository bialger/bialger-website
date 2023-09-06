<?php
	function checkAuth () {
        include "./hashes.php";
        include "./hash_eq.php";
		$auth = false;
		if (isset($_GET['user']) && isset($_GET['passw']) && isset($_GET['lid']) && isset($_GET['mac'])) {
            $login = $_GET["user"];
			$passw = $_GET["passw"];
			$login_id = $_GET["lid"];
            $mac = $_GET["mac"];
			foreach ($hashes as $hashp) {
				if (hash_equals($hashp[0], $login) && hash_equals($hashp[1], $passw)){
					$auth = true;
					break;
                }
            }
			if (!hash_equals($login_id, hash("sha512", $login.$mac))) $auth = false;
		}
		return $auth;
	}
?>