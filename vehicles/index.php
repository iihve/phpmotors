<?php
// This is the vehicles controller for the site

//this code is to create or access a session
session_start();

//this code checks that a client is "loggedin" AND has a clientLevel 
//greater than "1" to access the view. If not, redirect the client 
//back to the phpmotors controller to deliver the PHP Motors home view.

        // Get the database connection file
        require_once '../library/connections.php';
        // Get the PHP Motors model for use as needed
        require_once '../model/main-model.php';
        // get the the accounts vehicle model
        require_once '../model/vehicles-model.php';

        require_once '../library/functions.php';

        require_once '../model/reviews-model.php';

        // Get the array of classifications
        $classifications = getClassifications();

//var_dump($classifications);
//exit;
// build a navigation bar using the $classifications array

$navList = buildNav($classifications);

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    }

        switch ($action){

        case 'addCarClassification':
        //filter and store data
        $classificationName = filter_input(INPUT_POST, 'classificationName');
        //check for missing data
        if (empty($classificationName)) {
            $message = "'<p class='alert-red'>Please provide information for empty form field.</p>";
            include '../view/add-classification.php';
            exit;
        }


        //send the data to the model
        $regOutcome = regClassification($classificationName);
        //check and report
        if ($regOutcome === 1) {
            header("Location:../vehicles/index.php");
        } else {
            $message = "<p class='alert alert-red'>Sorry, but the registration failed. please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;

            case 'addVehicle':
                //filter and store data
                $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
                $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
                $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
                $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
                $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
                $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING );
                $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
                $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);


                $checkMake = isAlpha($invMake);
                if(!$checkMake) {$invMake='';}
                $checkModel = isAlpha($invModel);
                if(!$checkModel) {$invModel='';}
                $checkDescription = isSpecialAlpha($invDescription);
                if(!$checkDescription) {$invDescription='';}
                $checkImage = isImage($invImage);
                if(!$checkImage) {$invImage='';}
                $checkThumbnail = isImage($invThumbnail);
                if(!$checkThumbnail) {$invThumbnail='';}
                $checkColor = isAlpha($invColor);
                if(!$checkColor) {$invColor='';}

                //check for missing data
                if(empty($_POST['classificationId']) || !$checkMake || !$checkModel || 
                   !$checkDescription || !$checkImage || !$checkThumbnail || 
                   empty($_POST['invPrice']) || empty($_POST['invStock']) || !$checkColor){
                   $message = '<p class="center">Please provide information for all empty form fields.</p>';
                   include '../view/add-vehicle.php';
                   exit;
                }
                // send data to the model if no errors exist
                $regOutcome = regVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

                // check and report the results
                if($regOutcome === 1){
                    $message = "<p>The $invMake has been registered.</p>";
                    include '../view/add-vehicle.php';
                    exit;
                } else {
                    $message = "<p>Sorry but the rigistration failed for $invMake,. Please try again.<?p>";
                    include '../view/add-update.php';
                    exit;
                }

                break;


                case 'vehicle-man':
                include '../view/vehicle-man.php';
                break;

                case 'add-classification':
                    include '../view/add-classification.php';
                break;

                case 'add-vehicle':
                include '../view/add-vehicle.php';
                break;

                //this code is for Get vehicles by classificationId
                //Used for starting Update & Delete process W9

                case 'getInventoryItems';
                //get the classificationId
                $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
                //fetch the vehicles by classificationId frpm DB
                $inventoryArray = getInventoryByClassification($classificationId);
                // convert the array to a Json object and send it back
                echo json_encode($inventoryArray);
                break;

                // added W9-step 1of2
                case 'mod':
                $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $invInfo = getInvItemInfo($invId);
                if (count($invInfo)<1) {
                $message = 'Sorry, no vehicle information could be found.';
                }
                include '../view/vehicle-update.php';
                exit;
                break;

        //added W9 step2-2
    case 'updateVehicle':
        //this code is to filter and store data
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId',  FILTER_SANITIZE_NUMBER_INT);

        
        //up aboth code Add W9 pastt 2-2 (invIf)
        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="notice">Please provide information for all empty form fields</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
        
        if ($updateResult) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
           // include '../view/new-item.php';
            $SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = '<p class="notice">The new vehicle could not be updated at this time. Please try again later</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        break;

        case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

        case 'deleteVehicle':
            //this code is to filter and delete data
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId',  FILTER_SANITIZE_NUMBER_INT);
        
            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
                // include '../view/new-item.php';
                $SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = '<p class="notice">Error: $invMake $invModel was not deleted.</p>';
                header('location: /phpmotors/vehicles/');
                exit;
            }
        break;

    case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
            $vehicles = getVehiclesByClassification($classificationName);
            if (!count($vehicles)) {
                $message = "<p class='notice'>Sorry, no $classificationName vehicle could be found./</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
        // echo $vehicleDisplay;
        // exit;
            include '../view/classification.php';
        break;

        case 'details':
            $invId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $vehicle = getVehicle($invId);
            if (!isset($vehicle['invId'])) {
                $message = "<p class='notice'>The vehicle could not be found.</p>";
            } else {
                $vehicleDisplayDetails = buildVehicleDetail($vehicle);
                $reviews = buildReviews(getReviewsByVehicle($invId));
            }
            include '../view/vehicle-detail.php';
            break;

    

        default:
            //added W9
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-man.php';
            exit;
            break;
    
}
