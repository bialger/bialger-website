<?php
    if (isset($_GET['type'])) {
        $type = htmlentities($_GET['type']);
        if ($type == "Alpha") {
            header('Location: https://github.com/bialger/EasyMusic/releases/download/v1.0.5/EasyMusic-1.0.4-alpha.apk'); # 1.0.4
        }
        else if ($type == "Beta") {
            header('Location: https://github.com/bialger/EasyMusic/releases/download/v1.0.5/EasyMusic-1.0.5-beta.apk'); # 1.0.5
        }
        else {
            header('Location: https://github.com/bialger/EasyMusic/releases/download/v1.0.5/EasyMusic-1.0-stable.apk'); # 1.0.0
        }
    }
    else {
        header('Location: https://github.com/bialger/EasyMusic/releases/download/v1.0.5/EasyMusic-1.0-stable.apk'); # 1.0.0
    }
    die();
?>
