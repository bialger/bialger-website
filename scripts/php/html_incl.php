<?php
    function head ($header, $style="style.css") {
        $msg = '<link rel="icon" size="32x32" type="image/png" href="https://bialger.com/assets/logo.png">
        <title>'.$header.'</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/style/'.$style.'">'."\n";
        echo $msg;
    }
    function keywords ($array) {
        $str = "";
        foreach ($array as $elem) {
            $str .= $elem.", ";
        }
        $str = substr($str, 0, (strlen($str) - 2));
        echo '        <meta name="Keywords" content="'.$str.'">'."\n";
    }
?>
