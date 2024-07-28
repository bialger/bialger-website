<?php
    include "./scripts/php/message.php";
    if ($show) {
        $tab = "    ";
        $n = "\n";
        echo $tab.$tab.'<hr>'.$n;
        echo $tab.$tab.'<div class="important">'.$n;
        echo $tab.$tab.$tab.'<h2 class="imtitle">'.$head.'</h2>'.$n;
        echo $tab.$tab.$tab.'<p>'.$text.'</p>'.$n;
        echo $tab.$tab.'</div>'.$n;
    }
?>
