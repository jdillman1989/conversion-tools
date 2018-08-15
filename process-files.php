<?php

// cat ./content/* > ./content/_compiled.html
// search-replace in compiled file for the start of each front matter with some unique string: '%%%' in this example
// Run compiled file through https://www.freeformatter.com/html-formatter.html

$content = file_get_contents('./raw/_compiled.html');
$state_markup = explode('%%%', $content);

foreach ($state_markup as $state) {
	$filename_one = explode('permalink: /online-degrees/', $state);
	$filename_two = explode('/', $filename_one[1]);

	$new_state = fopen('./complete/'.$filename_two[0].'.html', "w") or die("Unable to open file!");
	fwrite($new_state, $state);
	fclose($new_state);
}

// $: php process-files.php