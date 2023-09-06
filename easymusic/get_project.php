<?php
    include "./checkAuth.php";
    if (checkAuth()) {
        if (isset($_GET['owner']) && isset($_GET['name'])) {
            $owner = htmlentities($_GET['owner']);
            $name = htmlentities($_GET['name']);
            include "./hashes.php";
            include "./projects.php";
            include "./friends.php";
            $user = htmlentities($_GET['user']);
            $email = "";
            foreach ($hashes as $hashp) {
                if (hash_equals($hashp[0], $user)) {
                    $email = $hashp[2];
                    break;
                }
            }
            $do = false;
            for ($i = 0; $i < count($friends); $i++) {
                if ($friends[$i][0] == $owner) {
                    $do = in_array($name, $projects[$i]);
                    break;
                }
            }
            if ($do) {
                $dir = "./users/$owner/";
                $full_name = $dir.$name.".emproj";
                $data = file_get_contents($full_name);
                echo("1\n");
                echo($data);
            }
            else echo(0);
        }
        else echo(0);
	}
	else echo(0);
?>