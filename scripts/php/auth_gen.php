<?php
    include "./hashes.php";
    include "./hash_eq.php";
    include "./mail.php";
    include "./dblib.php";
    include "./checkAuth.php";
    checkAuth(0);
    $file = "./wanted.php";
    $data = file_get_contents($file);
    $file1 = fopen($file, 'w');
    $slogin = htmlentities($_POST['login']);
    $spassw = htmlentities($_POST['password']);
    $scat = htmlentities($_POST['cat']);
    $semail = htmlentities($_POST['email']);
    $logon = htmlentities($_POST['logon']);
    if ($logon != "Cancel") {
        $cat = "./hashes.php";
        $nlogin = hash("sha512", $slogin);
        $npassw = hash("sha512", $spassw);
        $data1 = file_get_contents($cat);
        $file2 = fopen($cat, 'w');
        $ndata1 = adstr($data1, array($nlogin, $npassw, $semail, $scat), $slogin);
        fwrite($file2, $ndata1);
        nmail($semail,
        "Ваша заявка одобрена",
        "Поздравляем! Ваша заявка на присоединение к сообществу bialger.com одобрена!\r\nВаш логин: $slogin, ваш пароль: $spassw."
        );
        header('Location: https://bialger.com/user_gen.html');
    }
    else {
        nmail($semail,
        "Ваша заявка отклонена",
        "Упс! К сожалению, Ваша заявка на присоединение к сообществу bialger.com отклонена!\r\nВаш желаемый логин: $slogin, ваш желаемый пароль: $spassw.\r\nНе расстраивайтесь."
        );
        header('Location: https://bialger.com/user_gen.html');
    }
    $ndata = rmstr($data, $slogin);
    fwrite($file1, $ndata);
?>
