<?php

require 'vendor/autoload.php';

use App\Model\Project\Project;
use App\Model\Task\Task;

/**
 * If you would like to test the code by running it directly, you can easily do
 * so in this file.
 */

$project = new Project('');
$project->addTask(new Task(0, 'Book pre-wrap inspection'));

print_r($project);

