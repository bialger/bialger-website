<?php
    include "./checkAuth.php";
    if (checkAuth() && isset($_GET['owner'])) {
        include "./hashes.php";
        include "./about.php";
        include "./projects.php";
        include "./friends.php";
        include "./sounds.php";
        $user = htmlentities($_GET['user']);
        $owner = htmlentities($_GET['owner']);
        $email = "";
        foreach ($hashes as $hash) {
            if (hash_equals($hash[0], $user)) {
                $email = $hash[2];
                break;
            }
        }
        $do = false;
        foreach ($friends as $friend) {
            if ($friend[0] == $email) {
                $do = in_array($email, $friend);
                break;
            }
        }
        if ($do) {
            $info = array("", "", array(), array(), array());
            $i = 0;
            while ($i < count($hashes)) {
                if ($hashes[$i][2] == $owner) {
                    $info[0] = $owner;
                    $info[1] = $about[$i][1];
                    $info[2] = array_slice($friends[$i], 1);
                    $info[3] = array_slice($sounds[$i], 1);
                    $info[4] = array_slice($projects[$i], 1);
                    break;
                }
                $i++;
            }
            echo("1\n".$info[0]."\n".$info[1]."\n");
            for ($i = 0; $i < count($info[2]); $i++) {
                echo($info[2][$i]);
                if ($i != count($info[2]) - 1) echo(";");
            }
            echo("\n");
            for ($i = 0; $i < count($info[3]); $i++) {
                echo($info[3][$i]);
                if ($i != count($info[3]) - 1) echo(";");
            }
            echo("\n");
            for ($i = 0; $i < count($info[4]); $i++) {
                echo($info[4][$i]);
                if ($i != count($info[4]) - 1) echo(";");
            }
        }
        else echo(0);
	}
	else echo(0);
?>