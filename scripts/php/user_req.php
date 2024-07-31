<?php
    include "./wanted.php";
    include "./hashes.php";
    include "./mail.php";
    include "./dblib.php";
    $slogin = htmlentities($_POST['login'], ENT_QUOTES);
    $spassw = htmlentities($_POST['password'], ENT_QUOTES);
    $semail = htmlentities($_POST['email'], ENT_QUOTES);
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
    if (checkUniq($wanted, $hashes, $slogin)) {
        $file = "./wanted.php";
        $data = file_get_contents($file);
        $file1 = fopen($file, 'w');
        $new = array($slogin, $spassw, '1', $semail);
        $ndata = adstr($data, $new);
        fwrite($file1, $ndata);
        nmail($semail,
        "Вы оставили заявку",
        "Поздравляем! Вы оставили заявку на присоединение к сообществу bialger.com с логином '$slogin' и паролем '$spassw'"
        );
        header('Location: https://bialger.com/index.html');
    }
    else {
        $msg = 'К сожалению, логин '.$slogin.' уже занят. Выберите, пожалуйста, другой.';
        header('Location: https://bialger.com/user_req.html?q='.$msg);
    }
    die();
?>
