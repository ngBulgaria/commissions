<?php
require_once 'app/start.php';

use Calculator\Controllers\ParseCommandLine;
use Calculator\Controllers\ParseInput;
use Calculator\Controllers\PrintOutput;

$cmd = new ParseCommandLine($argv);
$input = new ParseInput();
$rows = $input -> parseCsv($cmd->getArgv());
$output = new PrintOutput();
$output->printOutput($rows);
?>