<?php
	include "./hashes.php";
	include "./hash_eq.php";
    include "./checkAuth.php";
    checkAuth(0);
    $do = true;
    foreach ($_POST as $post) {
        if (($post == "") || (trim($post) == "")) $do = false;
    }
    $filename = "autogen_".substr($_COOKIE['user-bialger'], 23, 9).".php";
    if ((count($_POST) == 2) && $do) {
	    $text = $_POST['code'];
	    $file = fopen($filename, "w");
	    fwrite($file, $text);
	    header('Location: https://bialger.com/scripts/php/'.$filename);
    }
?>
<html>
    <head>
        <link rel="icon" sizes="32x32" type="image/png" href="https://yt3.ggpht.com/a/AATXAJwNdGwTvJkJt7H-vq8OP-zUQULu7co4wKhQlg=s900-c-k-c0xffffffff-no-rj-mo">
        <title>Тест кода</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/style/style.css">
    </head>
    <body>
        <style>@import url(https://fonts.googleapis.com/css?family=Corbel);</style>
        <p class="bodytitle">Тест кода</p>
        <p>
            <form style="margin-left:3%;font-family:'Corbel' sans-serif;font-size:18px;" action="./testcode.php" method="post">
                <textarea style="font-family:'Courier';font-size:18px;width:97%;height:50%;"name="code"><?php echo file_get_contents($filename); ?></textarea><br><br>
                <input style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" type="submit" name="logon" value="Протестировать"/>
            </form>
		</p>
    </body> 
</html> 