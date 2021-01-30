<?php
//This file will become a library of custom functions that we will use in our code to perform a variety of tasks.

// this function check the email 
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

//this function checks the password for a minimum of 8 characters, 
//at least 1 capital letter, at least 1 number and
// at least 1 special character W7?
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}
function isAlpha($value)
{
    $pattern = '/^[a-zA-Z\s]*$/';
    return preg_match($pattern, $value);
}
function isSpecialAlpha($value)
{
    $pattern = '/^[a-zA-Z0-9\s\!\.\,\?\'\"\(\&\%\$]+$/';

    return preg_match($pattern, $value);
}
function isImage($value)
{
    $pattern = '/([\/|.|\w|\s|-])*\.(?:jpg|gif|png)/';
    return preg_match($pattern, $value);
}

function buildNav($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/index.php?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }//the $navList link was changed from index.php to vehicles.php W10
    $navList .= '</ul>';
    return $navList;
}

//W9-this code is to build the classifications select list 
function buildClassificationList($classifications){
$classificationList = '<select name="classificationId" id="classificationList">';
$classificationList .= "<option>Choose a classification</option>";
foreach ($classifications as $classification) {
$classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .='</select>';
return $classificationList;
}

//W10 this function will build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $price = '$' . number_format($vehicle['invPrice']. 0);
        $dv .= '<li>';
        $dv .= "<div class='detailImage'><a href='/phpmotors/vehicles/?action=details&id=$vehicle[invId]'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a></div>";
        $dv .= '<hr>';
        $dv .= "<h2><a href=' /phpmotors/vehicle/?action=details&id=$vehicle[invId]'></a>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$price</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

// W10 this code is to link the image with the description 
// it needs to be stiled in the css to make it responcive and 
// presentable. 

function buildVehicleDetail($vehicle)
{

    // $detail = "<h1 class='title2'>$vehicle[invMake] $vehicle[invModel]</h1>";
    $detail = "<div class='vehicle_detail'>";
    if ($vehicle) {
        $thumbnails='';
        foreach($vehicle['thumbnails'] as $thumbnail){
            $thumbnails .= "<img class='thumbnail' src='$thumbnail[imgPath]' alt='$vehicle[invMake] $vehicle[invModel]'>";
            $thumbnails .= "<img class='thumbnailBig' src='$thumbnail[imgPath]' alt='$vehicle[invMake] $vehicle[invModel]'><br>";
        }
        // $price = '$' . number_format($vehicle['invPrice'], 0);
        $detail .= "<h1 class='title2'>$vehicle[invMake] $vehicle[invModel]</h1>";
        $detail .= "<h2 class= 'title-review'>Reviews for this vehicle can be seen at the bottom of the page.</h2>";
        $detail .= $thumbnails;
        // $detail .= "<div class='vehicle_detail'>";
        $detail .= "<img class='detail_image' src='$vehicle[invImage]' alt='$vehicle[invMake] $vehicle[invModel]'>";
        $detail .= "</div>";
        
        $detail .= "<div class='detail_description'><p>$vehicle[invDescription]</p></div>";
        $detail .= "<hr>";
        $detail .= "<div id='vehicle_other'>";
        $detail .= "<ul>";
        $detail .= "<li>Classification: $vehicle[classificationName]</li>";
        $detail .= "<li>Color Available: $vehicle[invColor]</li>";
        $detail .= "<li>$vehicle[invStock] vehicles in stock </li>";
        $price = '$' . number_format($vehicle['invPrice'], 0);
        $detail .= "<li class='car-price'>Price: $price</li>";
        $detail .= "</ul>";
        $detail .= "</div>";
    } else {
        $detail = '<p class="message">No vehicle found</p>';
    }
    return $detail;
    // $detail .= "<div class='altura'><img class='detail_image' src='$vehicle[invImage]' alt='$vehicle[invMake] $vehicle[invModel]'></div>";
}

// W11- /* * ********************************
// *  Functions for working with images
// * ********************************* */
// Notice this function does not make a thumbnail, it adds the thumbnail designation "-tn" to an image name. 
// Add the following function code beneath the comment you added previously:
// W11- This code adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}
// W11-This function is responsible for taking a multi-dimensional array of image information
// from the database and wrapping it up in HTML for display in the view. Add the following
// comment and function below the previous function:
// W11- this code builds the images display for the image manegement view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
    $id .= '<li class="car-disp">';
    $id .= "<img class='car-img' src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP motors.com' alt='$image[invMake] $image[invModel] image on PHP motors.com'></li>";
    $id .= "<p class='car-delete'><a  href='/phpmotors/uploads>action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';  
    }
    $id .= '</li>';
    return $id;
}
// W11- This function takes a list of inventory vehicle makes, models and id's
// this code builds the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Chose a vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}
// W11-This code stores the physical file to the server and returns the path of where the file was stored. 
// That path will then be inserted to the database.
// This code handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // this code gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // this code gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // this code gets the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // this code seets the new path - image folder in this directory
        $target = $image_dir_path . '/' .$filename;
        // this code moves the file to the target folder
        move_uploaded_file($source, $target);
        // this code sends the file for furter processing
        processImage($image_dir_path, $filename);
        // this code sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // this code returns the path where the file is stored
        return $filepath;
    }
}
// W11- This function builds the actual paths for storing the images and also calls a function that
// will resize images to dimensions that are specified. It actually replaces the original file
// with the modified file and creates the thumbnail file in the same location as other images.
// this code processes the images by getting paths and creating smaller versions of the images.
function processImage($dir, $filename) {
    // this code sets up the variables
    $dir = $dir . '/';

    // this code sets up the image path
    $image_path = $dir . $filename;

    // this code sets up the tumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // this code creates a thumbnail image that is a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // this code resizes the original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}
// W11- This is the true work horse function. It is responsible for: 1) checking that only image files
// are being uploaded, 2) checking the size of the image and resizing it if it is larger than
// what was specified, 3) replacing old images with new versions and 4) destroying temporary files that may exist.
// this code checks and resizes images
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    // this code gets the image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // this code sets up function name
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromfif';
            $image_to_file = 'imagegif';
        break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;
        default:
        return;
    } 
    // this code ends the switch

    // this code gets the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // this code calculates height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // this code works incase image is larger than specified ratio, it creates the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
        // this code calculates height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
   
    // this code creates the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // this code sets the transparency according to the type
    if ($image_type == IMAGETYPE_GIF) {
        $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagecolortransparent($new_image, $alpha);
    }

    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
    }

    // this code copys the old image to a new image - this code resizes the image 
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

    // this code writes the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // this code frees any memory associated with the new image
    imagedestroy($new_image);
} else {
    // this code writes the old message to a new file
    $image_to_file($old_image, $new_image_path);
    }

    // this code frees any memory associated with the old image
    imagedestroy($old_image);
}
// here is where the resizeImage function ends.

// NOTE: if there is any problems uploading the image as a .jpg you will need to
// use an image editor application to open and then export the file as a ".jpg" file. 
// You can't simply change the extension, you have to export or save the file as a JPG file 
// with the three letter extension.
// Once that is done, then run the image through the upload process. This seems to solve the issue.

// PROJECT W12-13 
function buildReviews($reviews) {
    $detail = "<div class='reviews'>";
    foreach($reviews as $review) {
        $time = strtotime($review['reviewDate']);
        $date = date("m/n/y g:i A", $time);
        $username = substr($review['clientFirstname'], 0, 1) . $review['clientLastname'];
        $detail .= "<div class='review'>";
        $detail .= "<div class='review_date_name'>$date - $username</div>";
        $detail .= "<div class='review_make_model'>$review[invMake] $review[invModel]</div>";
        $detail .= "<div class='review_text'>$review[reviewText]</div>";
        // show admin link when client is the autor
       
        if (isset($_SESSION['clientData'])&& $_SESSION['clientData']['clientId'] == $review['clientId']) {
            $detail .="<div class='review_button'><a href='/phpmotors/reviews/?action=editReview&reviewId=$review[reviewId]'>update</a>";
            // &nbsp; this is a non breaking space to give a little of space betwen theme 
            $detail .="&nbsp;&nbsp; &nbsp; <a href='/phpmotors/reviews/?action=deleteReviewPreview&reviewId=$review[reviewId]'>Delete</a></div>";
        }
        $detail .= "</div>";
    }
    $detail .= "</div>";
    return $detail;
}

?>