/*
    PHPToolkit v1.0.0
    Starting PHP's empire
*/

<?php

if (PHP_SAPI == 'cli')
	die('This file should only be run on a web server but you can use ptk-cli.php for command line usage.');

// Don't use PHPToolkit on other open-source webapplications or content managment systems (Even WordPress).
if (defined('ABSPATH') && !file_exists('.PHPToolkitTMP')) {
  die('Please read `.PHPToolkitTMP` file and then refresh to continue.');
  file_put_content('.PHPToolkitTMP', 'ABSPATH already exists.');
}

require 'bootstrap.php';
