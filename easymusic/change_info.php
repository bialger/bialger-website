<?php
    include "./checkAuth.php";
    if (checkAuth() && isset($_GET['edit']) && isset($_GET['value'])) {
        function addElement ($db_name, $email, $element) {
            include "./dblib.php";
            include "./useful.php";
            include "./$db_name.php";
            $array = array();
            if ($db_name == "sounds") {
                $array = $sounds;
            }
            else if ($db_name == "friends") {
                $array = $friends;
            }
            else {
                $array = $about;
            }
            $oldstr = "(";
            foreach ($array[indexInDB($email, $array)] as $arr_el) {
                $oldstr .= "'$arr_el', ";
            }
            $cat = "./$db_name.php";
            $data = file_get_contents($cat);
            $oldstr = substr($oldstr, 0, -2);
            if ($db_name == "sounds" && !in_array(str_replace("AMPERSAND", "&", $element), $sounds[indexInDB($email, $sounds)])) {
                $element = str_replace("AMP", "&", $element);
                $newstr = $oldstr.", '$element'";
                $ndata = chpar($data, $oldstr, $newstr);
                $file = fopen($cat, 'w');
                fwrite($file, $ndata);
                fclose($file);
            }
            if ($db_name == "about") {
                $newstr = "('$email', '$element'";
                $ndata = chpar($data, $oldstr, $newstr);
                $file = fopen($cat, 'w');
                fwrite($file, $ndata);
                fclose($file);
            }
            if ($db_name == "friends" && !in_array($element, $friends[indexInDB($email, $friends)])) {
                $newstr = $oldstr.", '$element'";
                $ndata = chpar($data, $oldstr, $newstr);
                $file = fopen($cat, 'w');
                fwrite($file, $ndata);
                fclose($file);
                $oldstr2 = "(";
                foreach ($friends[indexInDB($element, $friends)] as $arr_el) {
                    $oldstr2 .= "'$arr_el', ";
                }
                $oldstr2 = substr($oldstr2, 0, -2);
                $newstr2 = $oldstr2.", '$email'";
                $data2 = file_get_contents($cat);
                $ndata2 = chpar($data2, $oldstr2, $newstr2);
                $file2 = fopen($cat, 'w');
                fwrite($file2, $ndata2);
                fclose($file2);
            }
        }
        include "./hashes.php";
        $user = htmlentities($_GET['user']);
        $email = "";
        foreach ($hashes as $hashp) {
            if (hash_equals($hashp[0], $user)) {
                $email = $hashp[2];
                break;
            }
        }
        $do = false;
        if ($_GET['edit'] == "friends") {
            foreach ($hashes as $hashp) {
                if ($hashp[2] == $_GET['value']) {
                    $do = true;
                    break;
                }
            }
        }
        else $do = true;
        if ($do) {
            echo(1);
            addElement(htmlentities($_GET['edit']), $email, htmlentities($_GET['value']));
        }
        else echo (0);
	}
	else echo(0);
?>