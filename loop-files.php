<?php

$dir = new DirectoryIterator('content');
$files = array();
foreach ($dir as $fileinfo) {
  $name = $fileinfo->getFilename();
  $files[] = $name;
}

foreach ($files as $file) {
  $statename = explode(' - ', $file);
  $stateformat = strtolower($statename[0]);
  $state = str_replace("-"," ",$stateformat);
  $filename = 'social-work-licensure-'.$state.'.html';

  $content = file_get_contents('./content/'.$file);
  // 0: <h1>title</h1>, 
  // 1: title: Page ...,
  // 2: <p> Content ...
  $content_array = explode('---', $content);
  $new_content_array = array(
    '---', 
    $content_array[1], 
    '---', 
    $content_array[0], 
    $content_array[2],
  );
  $new_content = implode("%%%", $new_content_array);
  $new_file = fopen('./complete/'.$filename, "w") or die("Unable to open file!");
  fwrite($new_file, $new_content);
  fclose($new_file);
}