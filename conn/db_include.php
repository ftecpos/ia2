<?php
require 'sql_connect.php';
$db = new sql_connect("localhost", "root", "qqqwdresa", "3shop");

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'rootpass';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbsocket' => 0,
);

$CFG->wwwroot   = 'http://localhost';
$CFG->dataroot  = 'C:\\MoodleWindowsInstaller-latest-22\\server\\moodledata';
$CFG->admin     = 'admin';
?>