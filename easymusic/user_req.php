<?php
    include "./wanted.php";
	include "./hashes.php";
	include "./mail.php";
	include "./dblib.php";
	if (isset($_GET['login']) && isset($_GET['password'])) {
        $slogin = htmlentities($_GET['login'], ENT_QUOTES);
        $spassw = htmlentities($_GET['password'], ENT_QUOTES);
        $semail = $slogin;
        function checkUniq ($wanted, $hashes, $slogin) {
            $uniq = true;
            foreach ($wanted as $want) {
                if ($want[0] == $slogin) {
                    $uniq = false;
                    break;
                }
            }
            foreach ($hashes as $hashp) {
                if ($hashp[0] == hash("sha512", $slogin)) {
                    $uniq = false;
                    break;
                }
            }
            return $uniq;
        }
        if (checkUniq($wanted, $hashes, $slogin) && $slogin != "") {
            echo(true);
            $file = "./wanted.php";
            $data = file_get_contents($file);
            $file1 = fopen($file, 'w');
            $new = array($slogin, $spassw, $semail);
            $ndata = adstr($data, $new);
            fwrite($file1, $ndata);
            fclose($file1);
            $link = "https://bialger.com/easymusic/auth_gen.php?login=$slogin&token=".hash("sha512", $slogin.$spassw);
            $invite = "<a href='$link'>link</a>";
            nmail($semail,
            "You left a request",
            "Congratulations! You have left a request to join the EasyMusic community with login '$slogin' and password '$spassw'.\r\nTo activate account please click on the $invite."
            );
        }
        else echo(0);
	}
    else echo(0);
?>