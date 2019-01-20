<?php
// Start a session whenever we use global functions
session_start();

// Includes
require_once('config.php');   // Configuration
require_once('database.php'); // Database object



$GLOBALS['db'] = new DBPDO();