<?php
    function indexInDB ($email, $array) {
        $i = 0;
        while ($i < count($array)) {
            if ($array[$i][0] == $email) break;
            $i++;
        }
        return $i;
    }
?>