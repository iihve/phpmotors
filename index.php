<?php

// This is the main controller for the site

//this code is to create or access a seccion
session_start();


// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors main model for use as needed
require_once 'model/main-model.php';
require_once './library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

//Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

//this code is to check if the first cookie exist, and get its value


//var_dump($classifications);
//exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
    case 'template':
        include 'view/template.php';
    break;
    default:
    
        include 'view/home.php';
}

?>
