<?php
// W11-this is the "Image uploads controller".
session_start();
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';

//W11- this code gets the array of classifications 
$classifications = getClassifications();

//W11- this code builds a navigation bar using the $classifications array
// $navList = buildNavigation($classifications);
$navList = buildNav($classifications);

// W11- this code collect the "action" value from the "post" or "get" options of the "request" from the browser
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

// W11- ** this are Variables for use with the Image Upload Functionality ** */

// directory name where upload images are stored
$image_dir = '/phpmotors/images/vehicles';
// the path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action) {
    case 'upload':
        // W11-Store the incoming vehicle id and primary picture indicator
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
     
        $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

        // W11- Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];

        $imageCheck = checkExistingImage($imgName);
        
        if($imageCheck){
            $message = '<p class="notice">An image by that name already exists.</p>';   
            } elseif (empty($invId) || empty($imgName)) { 
                $message = '<p class="notice">You must select a vehicle and image file for the vehicle.</p>'.$imgName;   
            } else {
                // W11-Upload the image, store the returned path to the file
                $imgPath = uploadFile('file1');

                // W11-Insert the image information to the database, get the result
                $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

                // W11- Set a message based on the insert result
                if($result) {
                    $message = '<p class="notice">The upload succeeded.</p>';
                } else {
                    $message = '<p class="notice">Sorry, the upload failed.</p>';
                }
            }
                // Store message to session
                $_SESSION['message'] = $message;

                // Redirect to this controller for default action
                header('location: .');
    break;

    case 'delete':
        // W11- this code gets the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
        // W11- this code builds the full path to the image to be deleted
        $target = $image_dir_path . '/' . $filename;
        // W11-this code checks that the file exists in that location
        if (file_exists($target)) {
            // W11- this code deletes the file in the folde
            $result = unlink($target);
        }
        // W11- this code removes it from the database only if physical file deleted
        if ($result) {
            $remove = deleteImages($imgId);
        }

        // W11- this code sets a message based on the delete result
        if ($remove) {
            $message = "<p class='notice'>$filename was successfully deleted.</p>";
        } else {
            $message = "<p class='notice'>$filename was NOT deleted.</p>";
        }
        
        // W11- this code stores message to session
        $_SESSION['message'] = $message;

        // W11- this code redirects to this controller for default action
        header('location: .');
    break;

    default:
    // W11- this code calls the function to return image info from the database
    $imageArray = getImages();

    // W11- this code builds the image information into HTML for display
    if (count($imageArray)) {
        $imageDisplay = buildImageDisplay($imageArray);
    } else {
        $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
    }

    // W11- this code gets the vehicle information from the databade
    $vehicles = getVehicles();
    
    // W11- this code builds a select list of vehicles information for the view
    $prodSelect = buildVehiclesSelect($vehicles);

    include '../view/image-admin.php';
    exit;
    
break;
}



// var_dump();
// exit;








?>