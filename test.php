<?php

$emails_list = ["spellmell@protonmail.com"];
if(array_search("spellmell@protonmail.com",$emails_list)){
	echo "NO ESTA";
	// print_r($emails_list);
	print(array_search("spellmell@protonmail.com",$emails_list));
} else {
	echo "SI ESTA";
	// print_r($emails_list);
	print(array_search("spellmell@protonmail.com",$emails_list));
}

 ?>
