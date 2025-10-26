<?php

$file = __DIR__ . '/../static/data.json';
$jsonContent = file_get_contents($file);

if ($jsonContent === false)
  die("Error: couldn't read file");

$data = json_decode($jsonContent, true);

if ($data === null)
  die("Error: Invalid JSON format in file");