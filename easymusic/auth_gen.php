<?php
	include "./hashes.php";
	include "./hash_eq.php";
	include "./mail.php";
	include "./dblib.php";
	include "./wanted.php";
	if (isset($_GET['login']) && isset($_GET['token'])) {
        $slogin = htmlentities($_GET['login']);
        $spassw = "";
        foreach ($wanted as $want) {
            if ($want[0] == $slogin) {
                $spassw = $want[1];
                break;
            }
        }
        $semail = $slogin;
        $token = htmlentities($_GET['token']);
        if (hash_equals($token, hash("sha512", $slogin.$spassw)) && $spassw != "") {
            $cat = "./hashes.php";
            $cat1 = "./about.php";
            $cat2 = "./friends.php";
            $cat3 = "./sounds.php";
            $cat4 = "./projects.php";
            $nlogin = hash("sha512", $slogin);
            $npassw = hash("sha512", $spassw);
            $data1 = file_get_contents($cat);
            $data2 = file_get_contents($cat1);
            $data3 = file_get_contents($cat2);
            $data4 = file_get_contents($cat3);
            $data5 = file_get_contents($cat4);
            $file2 = fopen($cat, 'w');
            $ndata1 = adstr($data1, array($nlogin, $npassw, $semail), $slogin);
            fwrite($file2, $ndata1);
            fclose($file2);
            mkdir("./users/$semail");
            $file2 = fopen($cat1, 'w');
            $ndata2 = adstr($data2, array($semail, ""));
            fwrite($file2, $ndata2);
            fclose($file2);
            $file2 = fopen($cat2, 'w');
            $ndata3 = adstr($data3, array($semail));
            fwrite($file2, $ndata3);
            fclose($file2);
            $file2 = fopen($cat3, 'w');
            $ndata4 = adstr($data4, array($semail));
            fwrite($file2, $ndata4);
            fclose($file2);
            $file2 = fopen($cat4, 'w');
            $ndata5 = adstr($data5, array($semail));
            fwrite($file2, $ndata5);
            fclose($file2);
            nmail($semail,
            "Request approved",
            "Congratulations! You joined EasyMusic community!\r\nYour login: $slogin, your password: $spassw."
            );
            $file = "./wanted.php";
            $data = file_get_contents($file);
            $file1 = fopen($file, 'w');
            $ndata = rmstr($data, $slogin);
            fwrite($file1, $ndata);
            fclose($file1);
            echo("Account created succesfully! Now sign in in the EasyMusic app.");
        }
        else echo("Something went wrong...");
	}
	else echo("Something went wrong...");
?>