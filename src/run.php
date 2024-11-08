<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Get command line arguments (first arg is always the script name)
$args = array_slice($argv, 1);

// Run the application with optional arguments
App::run($args); 