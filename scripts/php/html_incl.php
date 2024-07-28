<?php
    function head ($header, $style="style.css") {
        $msg = '<link rel="icon" size="32x32" type="image/png" href="https://yt3.ggpht.com/a/AATXAJwNdGwTvJkJt7H-vq8OP-zUQULu7co4wKhQlg=s900-c-k-c0xffffffff-no-rj-mo">
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
        echo '<meta name="Keywords" content="'.$str.'">'."\n";
    }
?>
