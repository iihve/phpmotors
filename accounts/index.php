<?php

// This is the accounts controller for the site

//this code is to create or access a session
session_start();

        // Get the database connection file
        require_once '../library/connections.php';
        // Get the PHP Motors model for use as needed
        require_once '../model/main-model.php';
        // get the accounts model
        require_once '../model/accounts-model.php';
        // checks the email
        require_once '../library/functions.php';
        require_once '../model/reviews-model.php';

        // Get the array of classifications
        $classifications = getClassifications();

        //var_dump($classifications);
        //exit;

        // Build a navigation bar using the $classifications array
        $navList = buildNav($classifications);

        //echo $navList;
        //exit;

        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = filter_input(INPUT_POST, 'action');
        }

        switch ($action){
            case 'register':
                //filter and store data
                $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
                $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
                $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
                $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
                $clientEmail = checkEmail($clientEmail);
                $checkPassword = checkPassword($clientPassword);

                //this code is for checking if the email allready exist
                $existingEmail = checkExistingEmail($clientEmail);

                //this code (an if statement) is to return a message to the user if an 
                //email already exist during registration
                if($existingEmail){
                    $message = '<p class="notice">This email address already exists. Do you want to login instead?</p>';
                    include '../view/login.php';
                    exit;
                }

                 //check for missing data
                if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                    $message = '<p class="center">Please provide information for all empty form fields.</p>';
                    include '../view/register.php';
                    exit;
                }

                //hash the checked password
                $password = password_hash($clientPassword, PASSWORD_DEFAULT);

                // send data to the model if no errors exist
                $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $password);

                // check and report the results
                if($regOutcome === 1){
                    // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');//change time from +1 year to 60 seconds to test//
                    $message = "<p>Thanks for registering $clientFirstname. please use your email and password to login,</p>";
                    include '../view/login.php';
                    exit;
                } else {
                    $message = "<p>Sorry $clientFirstname, but the rigistration failed. Please try again.</p>";
                    include '../view/register.php';
                    exit;
                }
                break;

               //     $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                //     header('Location: /phpmotors/accounts/?action=login');
                //    include '../view/login.php';
                //    //the up about code was changed w8 to the header('Location...)
                //     exit; 

                

    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
    
        $clientPassword = filter_input(INPUT_POST , 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);

        //this code is to run basic check, return if error
        if (empty($clientEmail) || empty($passwordCheck)) {
            $_SESSION['message'] = '<p class="notice">Please provide a valid address and password.</p>';
            include '../view/login.php';
            exit;
        }

        //this code is to verify if a valid password exist, then procced with the loging process
        //it queries the data based on the email addresss
        $clientData = getClient($clientEmail);
        //this code is to compare the password just submited against
        //the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        //this code is in case the hashes don't match it creates an error
        //and returns to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
    
        //this code is to check if a valid user exists, then log them in
        $_SESSION['loggedin'] = TRUE;
        setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');

        //this code removes the password from the array
        //the array_pop function removes the last element from the array
        array_pop($clientData);
        //this code stores the array into the session
        $_SESSION['clientData'] = $clientData;
        //this code is to sent them to the admin view
        
        header('Location: ./');
        exit;
        break;

        case 'logout':
            session_destroy();
            setcookie('firstname', '', time() - 3600, '/');
            header('Location: /phpmotors');
            exit;
        break;
        
    case 'login':
        include '../view/login.php';
    break;

    case 'registration':
        include '../view/register.php';
        break;

        case 'client-update':
            include '../view/client-update.php';
        break;
        
        case 'update':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        if (!isAlpha($clientFirstname))
        $clientFirstname = "";
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        if (!isAlpha($clientLastname))
        $clientLastname = "";
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);

        // See if any of the fields are empty
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p>Please provide information for all fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            if (checkExistingEmail($clientEmail)) {
                $message = '<p>That email already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        $update = updateClient($_SESSION['clientData']['clientId'], $clientFirstname, $clientLastname, $clientEmail);
        if ($update === 1) {
            $clientData = getClientById($_SESSION['clientData']['clientId']);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $message = '<p>' . $clientFirstname . ' the information has been updated.</p>';
        } else {
            $message = '<p>Something went wrong when trying to update your information</p>';
        }
        include '../view/admin.php';
        exit; 

        break;

        case 'newPassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        if (checkPassword($clientPassword)) {
            // Good to update password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            $passChange = changePassword($_SESSION['clientData']['clientId'], $hashedPassword);
            if ($passChange === 1) {
                $message = '<p>' . $_SESSION['clientData']['clientFirstname'] . ', your information has been updated.</p>';
            } else {
                $message = '<p>Something went wrong when trying to update your password.</p>';
            }
        } else {
            // Password failed requirements
            $message = '<p>Please enter a valid password.</p>';
        }
        include '../view/admin.php';
        exit;

        break;

    default:

    
        include '../view/admin.php';
        break;
        
        }


?>