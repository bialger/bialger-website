<?php
    if (isset($_GET['type'])) {
        $type = htmlentities($_GET['type']);
        if ($type == "Alpha") {
            header('Location: https://disk.yandex.ru/d/n2TH7Px8KByRLg'); # 1.0.4
        }
        else if ($type == "Beta") {
            header('Location: https://disk.yandex.ru/d/8T2nEOnSAal7VQ'); # 1.0.5
        }
        else {
            header('Location: https://disk.yandex.ru/d/T1p4FIzzbn_b0Q'); # 1.0.0
        }
    }
    else {
        header('Location: https://disk.yandex.ru/d/T1p4FIzzbn_b0Q'); # 1.0.0
    }
?>
