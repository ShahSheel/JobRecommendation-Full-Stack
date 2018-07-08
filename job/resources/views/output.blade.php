<?php


$myfile = fopen(base_path().'Description\test.txt', "w") or die("Unable to open file!");
$newline = "\r\n";


foreach($result as $key=>$value) {
    echo "</BR>";
    echo $value;
    echo "</BR>";

	$txt = $value;
	fwrite($myfile, $value);

	}
	fclose($myfile);


	?>
