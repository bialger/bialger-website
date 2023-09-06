<?php
    include "./checkAuth.php";
    if (checkAuth()) echo(1);
    else echo(0);
?>