<?php
	include "./hashes.php";
	include "./hash_eq.php";
    include "./checkAuth.php";
    include "./mail.php";
    checkAuth(0);
    $do = true;
    foreach ($_POST as $post) {
        if (($post == "") || (trim($post) == "")) $do = false;
    }
    if ((count($_POST) == 5) && $do) {
        $subj = htmlentities($_POST['subj']);
        $email = htmlentities($_POST['email']);
        $text = htmlentities($_POST['text']);
        $to = htmlentities($_POST['to']);
        $bool_mail = nmail($to, $subj, $text, $email);
        if ($bool_mail) $mail = "Доставлено!";
        else $mail = "Ошибка!";
    }
?>
<html>
    <head>
        <link rel="icon" sizes="32x32" type="image/png" href="https://yt3.ggpht.com/a/AATXAJwNdGwTvJkJt7H-vq8OP-zUQULu7co4wKhQlg=s900-c-k-c0xffffffff-no-rj-mo">
        <title>Тест mail()</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/style/style.css">
    </head>
    <body>
        <style>@import url(https://fonts.googleapis.com/css?family=Corbel);</style>
        <p class="bodytitle">Тест mail()</p>
        <p><?php if (isset($mail)){
            echo '<script> alert("'.$mail.'");';
        }?></p>
        <?php if (isset($mail)){
            header('Location: https://bialger.com/scripts/php/testmail.php');
        }?>
        <p>
            <form style="margin-left:3%;font-family:'Corbel' sans-serif;font-size:18px;" method="post">
                <select style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" name="email">
                    <option value="admin@bialger.com">Администратор</option>
                    <option selected value="no-reply@bialger.com">Поддержка</option>
                    <option value="bialger@bialger.com">Хозяин сайта</option>
                </select><br><br>
                <input required style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" type="text" name="to" value="bigulov.sasha@gmail.com"/><br><br>
                <input required style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" type="text" name="subj" value="Тема"/><br><br>
                <textarea required style="font-family:'Corbel' sans-serif;font-size:18px;width:97%;height:50%;" name="text"></textarea><br><br>
                <input style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" type="submit" name="logon" value="Послать"/>
            </form>
		</p>
    </body> 
</html>