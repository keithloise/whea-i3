<?php

global $project;
$project = 'mysite';

global $database;
$database = 'whea';

// find the database name from the environment file
if(defined('SS_DATABASE_NAME') && SS_DATABASE_NAME) {
	$database = SS_DATABASE_NAME;
} else {
	$database = 'whea';
}

require_once('conf/ConfigureFromEnv.php');

date_default_timezone_set('Pacific/Auckland');
Object::add_extension('SiteConfig', 'SiteConfigExtension');
