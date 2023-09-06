<?php
    include "./checkAuth.php";
    if (checkAuth()) {
        echo(1);
        include "./hashes.php";
        $user = htmlentities($_GET['user']);
        $email = "";
        foreach ($hashes as $hashp) {
            if (hash_equals($hashp[0], $user)) {
                $email = $hashp[2];
                break;
            }
        }
        $uploaddir = "./users/$email/";
        $name = $_FILES['userfile']['name'];
        $uploadfile = $uploaddir.basename($name);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo(1);
            $name = substr($name, 0, -7);
            include "./useful.php";
            include "./projects.php";
            if (!in_array($name, $projects[indexInDB($email, $projects)])) {
                include "./dblib.php";
                $cat = "./projects.php";
                $data = file_get_contents($cat);
                $oldstr = "";
                foreach ($projects as $proj) {
                    if ($proj[0] == $email) {
                        foreach ($proj as $proj_el) {
                            $oldstr .= "'$proj_el', ";
                        }
                        break;
                    }
                }
                $oldstr = substr($oldstr, 0, -2);
                $newstr = $oldstr.", '$name'";
                $ndata = chpar($data, $oldstr, $newstr);
                $file = fopen($cat, 'w');
                fwrite($file, $ndata);
                fclose($file);
            }
        }
        else echo(0);
	}
	else echo(0);
?>