<?php

$emails_list = ["spellmell@protonmail.com"];
if(!in_array("spellmell@protonmail.com",$emails_list)){
	echo "NO ESTA";
	print_r($emails_list);
} else {
	echo "SI ESTA";
	print_r($emails_list);
}

 ?>
