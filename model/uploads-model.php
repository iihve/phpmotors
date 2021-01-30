<?php
// W11-This model is for vehicle inventory image uploads.

// W11- this code adds image information to the database table
function storeImages($imgPath, $invId, $imgName, $imgPrimary) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
    $stmt = $db->prepare($sql);
 
    //W11- this codes stores the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
    
    // w11-this code makes and stores the thumbnail image information
    // it changes name in file name
    $imgPath = makeThumbnailName($imgPath);
    // W11- this changes the name in the file name
    $imgName = makeThumbnailName($imgName);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
// W11- this code gets the image information from the images table 
function getImages() {
    $db = phpmotorsConnect();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}
// W11- this code deletes the image information from the image table
function deleteImages($imgId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}
// W11- This function checks to make sure an image of the same name does not already exist in the database table. 
// If so, it returns TRUE so the image is not added again:
// this code checks for an existing image
function checkExistingImage($imgName) {
    $db = phpmotorsConnect();
    $sql = "SELECT imgName FROM images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}

function getVehicleThumbnails($invId) {
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM images WHERE invId = :invId and imgPath  LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $thumbnails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $thumbnails;
}

?>

