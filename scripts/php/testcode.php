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
    $gate = "<?php
    include \"./hashes.php\";
    include \"./hash_eq.php\";
    include \"./checkAuth.php\";
    checkAuth(0); 
?>
";
    if ((count($_POST) == 2) && $do) {
        $text = $_POST['code'];
        $file = fopen($filename, "w");
        fwrite($file, $gate.$text);
        fclose($file);
        header('Location: https://bialger.com/scripts/php/'.$filename);
        die();
    }
?>
<html>
    <head>
        <?php
            include "./html_incl.php";
            head("Тест кода", "style.css");
        ?>
    </head>
    <body>
        <style>@import url(https://fonts.googleapis.com/css?family=Corbel);</style>
        <p class="bodytitle">Тест кода</p>
        <p>
            <form style="margin-left:3%;font-family:'Corbel' sans-serif;font-size:18px;" action="./testcode.php" method="post">
                <textarea style="font-family:'Courier';font-size:18px;width:97%;height:50%;"name="code"><?php 
                    if (file_exists($filename)) {
                        $content = file_get_contents($filename);
                        if (substr($content, 0, strlen($gate)) == $gate) {
                            $content = substr($content, strlen($gate));
                        }
                        echo $content;
                    }
                    else {
                        $file_tmp = fopen($filename, "w");
                        fwrite($file_tmp, $gate);
                        fclose($file_tmp);
                    }
                ?></textarea><br><br>
                <input style="font-family:'Corbel' sans-serif;font-size:18px;width:20%" type="submit" name="logon" value="Протестировать"/>
            </form>
        </p>
    </body> 
</html> 
