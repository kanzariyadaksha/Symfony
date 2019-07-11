<?php 
date_default_timezone_set('America/Los_Angeles');
/**
 * Cake Multi-Domain Submission Processor
 * Author: Bill Wheeler for Delfi-Net
 * Date: 6/6/16
 */

include_once('./vendor/autoload.php');
include_once('init.php');

// Get the subfolder request
$fileName = './routes/' . trim( str_replace(dirname($_SERVER['SCRIPT_NAME']), '', strtok($_SERVER['REQUEST_URI'], '?')), '/') . '.php';
if(file_exists($fileName)) {
    require_once($fileName);
} else {
    require_once('./routes/store.php');
}

/*
 * These pages were used for reference in creation of this code
 *
 * https://support.getcake.com/support/solutions/articles/5000546408-how-do-i-implement-server-to-server-tracking-
 * https://support.getcake.com/support/solutions/articles/5000546322-how-do-i-track-conversions-
 */