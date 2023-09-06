<?php
	include "./scripts/php/message.php";
	if ($show) {
		$tab = "	";
		$n = "\n";
		echo $tab.'<hr>'.$n;
		echo $tab.'<div class="important">'.$n;
		echo $tab.$tab.'<h2 class="imtitle">'.$head.'</h2>'.$n;
		echo $tab.$tab.'<p>'.$text.'</p>'.$n;
		echo $tab.'</div>'.$n;
	}
?>