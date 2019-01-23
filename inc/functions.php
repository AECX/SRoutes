<?php
// Start a session whenever we use global functions
session_start();

// Includes
require_once('config.php');   // Configuration
require_once('database.php'); // Database object

// object includes
foreach(scandir('objects') as $Object)
{
	if(is_dir('objeccts/'.$Object)) continue; // skip . and ..
	require_once('objeccts/'.$Object);
}


$GLOBALS['db'] = new DBPDO();


// Global functions


/*
 * SQLf -> fetch() wrapper
*/
function SQLf($query, $vars = array())
{
	return $GLOBALS['db']->fetch($query, $vars);
}

/*
 * SQLfa -> fetchAll() wrapper
*/
function SQLfa($query, $vars = array())
{
	return $GLOBALS['db']->fetchAll($query, $vars);
}

/*
 * SQLe -> execute() wrapper
*/
function SQLe($query, $vars = array())
{
	return (bool) $GLOBALS['db']->execute($query, $vars);
}

