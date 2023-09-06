<?php
    include "./checkAuth.php";
    if (checkAuth()) {
        echo(1);
        include "./hashes.php";
        include "./about.php";
        include "./projects.php";
        include "./friends.php";
        include "./sounds.php";
        $user = htmlentities($_GET['user']);
        $info = array("", "", array(), array(), array());
        $i = 0;
        while ($i < count($hashes)) {
            if (hash_equals($hashes[$i][0], $user)) {
                $info[0] = $hashes[$i][2];
                $info[1] = $about[$i][1];
                $info[2] = array_slice($friends[$i], 1);
                $info[3] = array_slice($sounds[$i], 1);
                $info[4] = array_slice($projects[$i], 1);
                break;
            }
            $i++;
        }
        echo("\n".$info[0]."\n".$info[1]."\n");
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
?>