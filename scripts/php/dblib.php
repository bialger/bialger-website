<?php
    /*This is a library of functions for manipulating pseudo-databases, which are PHP arrays. 
    It includes the functions of adding and removing "rows", as well as changing a specific variable by value or index.
    All functions work only with values, you should write code, which works with files, on your on.
    Example of code:
    $file_handle = fopen($database_filename, "r");
    $data = fread($file_handle, 8192);
    $new_data = rmstr($data, $value_in_row_to_delete);
    $new_data = adstr($new_data, $array_new_row, $comment);
    $new_data = chpar($new_data, $value_to_change, $new_value);
    fwrite($file_handle, $new_data);
    fclose($file_handle);
    */
    function rmstr ($instr, $parstr) {
        $outstr1 = strstr($instr, $parstr);
        $outstr0 = strstr($instr, $parstr, true);
        $outstr0 = substr($outstr0, 0, (strlen($outstr0) - strlen(strrchr($outstr0, "\n"))));
        $outstr1 = strstr($outstr1, "\n");
        $outstr = $outstr0.$outstr1;
        return $outstr;
    }
    function chpar ($instr, $oldstr, $newstr) {
        $outstr1 = strstr($instr, $oldstr);
        $outstr0 = strstr($instr, $oldstr, true);
        $outstr1 = substr($outstr1, strlen($oldstr), (strlen($outstr1) - strlen($oldstr)));
        $outstr = $outstr0.$newstr.$outstr1;
    }
    function adstr ($instr, $adarr, $comment="default") {
        $strarr = "'";
        foreach ($adarr as $adstr) {
            $strarr .= $adstr."', '";
        }
        $strarr = substr($strarr, 0, (strlen($strarr) - 3));
        if ($comment == "default") {
            $date = date("d M Y D H:i:s", time());
            $insert = "
		array($strarr), //$date
	);
?>";
        }
        else {
            $insert = "
		array($strarr), //$comment
	);
?>";
        }
        $outstr = substr($instr, 0, (strlen($instr) - 7)).$insert;
        return $outstr;
    }
?>