<?php
session_start();

// Assuming you have a config.php for PDO initialization
include('config.php');

// Destroy session data
session_destroy();

// Redirect to home page
header('Location: index.php');
