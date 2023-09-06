<?php
    if (isset($_GET['type'])) {
        $type = htmlentities($_GET['type']);
        if ($type == "Alpha") {
            header('Location: https://disk.yandex.ru/d/gZX3vKW4ng6Lpg'); # 1.0.3
        }
        else if ($type == "Beta") {
            header('Location: https://disk.yandex.ru/d/YRQOeu3gzP0Xpg'); # 0.9.8
        }
        else {
            header('Location: https://disk.yandex.ru/d/T1p4FIzzbn_b0Q'); # 1.0.0
        }
    }
    else {
        header('Location: https://disk.yandex.ru/d/T1p4FIzzbn_b0Q'); # 1.0.0
    }
?>