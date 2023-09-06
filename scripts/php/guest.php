<?php
	setcookie ("user-bialger", "guest", time()+(86400), "/");
	setcookie ("passw-bialger", "password", time()+(86400), "/");
	if ((count($_GET) >= 1) and isset($_GET['retpath'])) {
	    header('Location: https://bialger.com/'.substr($_GET['retpath'], 1));
	}
	else {
        header('Location: https://bialger.com/main.html');
	}
?>