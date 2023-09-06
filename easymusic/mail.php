<?php
    function nmail ($to, $subject, $text, $from="no-reply@bialger.com") {
        $charset = 'utf-8';
        $vars = array("no-reply@bialger.com"=>"Support service of EasyMusic", "admin@bialger.com"=>"Administration of EasyMusic");
        $fromName = $vars[$from];
        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: =?$charset?B?".base64_encode($fromName)."?= <$from>\n";
        $headers .= "Content-type: text/html; charset=$charset\n";
        $headers .= "Content-Transfer-Encoding: base64\n";
        return mail("=?$charset?B?".base64_encode($to)."?= <$to>", "=?$charset?B?".base64_encode($subject)."?=", chunk_split(base64_encode($text)), $headers, "-f$from");
    }
?>