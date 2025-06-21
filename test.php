<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
echo "Session started OK!<br>";

require_once 'app/database.php';
echo "DB file included.<br>";
