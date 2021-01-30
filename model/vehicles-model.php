<?php
require_once '../model/uploads-model.php';
/* this is the vehicle-model model */

//the following function will handle vehicle-models.
//remove and transform the function 
//register a new car model

function regClassification($classificationName){
    $db = phpmotorsConnect();
    //theSQL statement
    $sql =
        'INSERT INTO carClassification (classificationName)
VALUES (:classificationName)';
    //create the paramet estament using the php_motors connection
    $stmt = $db->prepare($sql);
    //the next nine lines replace the placeholders in the SQL
    //statement with the actual values in the varable
    //and tells the database the type of data itb is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    //Ask how many rows changed as a results of our insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    //return the indication of success (row changed)
    return $rowsChanged;
}

function regVehicle($classificationId, $invMake, $invDescription, $invModel, $invImage, $invColor, $invStock, $invThumbnail, $invPrice){
//create a connection ogject using the phpmotors connection function
$db = phpmotorsConnect();
//theSQL statement
$sql =
    'INSERT INTO `inventory`(`invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
     (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId )';
//create the paramet estament using the php_motors connection
$stmt = $db->prepare($sql);
//the next nine lines replace the placeholders in the SQL
//statement with the actual values in the varable
//and tells the database the type of data itb is
$stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
$stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
$stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
$stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
//Insert the data
$stmt->execute();
//Ask how many rows changed as a results of our insert
$rowsChanged = $stmt->rowCount();
//close the database interaction
$stmt->closeCursor();
//return the indication of success (row changed)
return $rowsChanged;

}


//W9-this code is to get vehicles by classificationId
function getInventoryByClassification($classificationId) {
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// W9-this code is to indicating that you are selecting a single vehicle based on its id
//Below the comment add this function (your connection function may be named differently):
//Get vehicle information by invId(inventory Id)
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//W9- step 2-2 this code is that the function will update a vehicle.
function updateVehicle($classificationId, $invMake, $invDescription, $invModel, $invImage, $invColor, $invStock, $invThumbnail, $invPrice, $invId)
{   //create a connection ogject using the phpmotors connection function
    $db = phpmotorsConnect();
    //theSQL statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
    classificationId = :classificationId WHERE invId = :invId';
    //create the paramet estament using the php_motors connection
    $stmt = $db->prepare($sql);
    //the next nine lines replace the placeholders in the SQL
    //statement with the actual values in the varable
    //and tells the database the type of data itb is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    //W9 step 2-2 add invId
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as a results of our insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    //return the indication of success (row changed)
    return $rowsChanged;
}

//W9- step 2-2 this code is that the function will delete a vehicle.
function deleteVehicle($invId)
{   //create a connection ogject using the phpmotors connection function
    $db = phpmotorsConnect();
    //theSQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    //create the paramet estament using the php_motors connection
    $stmt = $db->prepare($sql);
    //delete all but the invId
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as a results of our insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    //return the indication of success (row changed)
    return $rowsChanged;
}

//W10 this new function will get a list of vehicles based on the classification.
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory JOIN images on inventory.invId = images.invId and images.imgPrimary=1 and imgPath like '%-tn%' WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $Vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $Vehicles;
}
function getVehicle($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, carclassification.classificationName 
   FROM inventory JOIN carclassification ON carclassification.classificationId = inventory.classificationId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    if (!$vehicle = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $vehicle = 0;
    }
    $vehicle['thumbnails']=getVehicleThumbnails($invId);
    $stmt->closeCursor();
    return $vehicle;
}


// W-11 this code is where the function will obtain information about all vehicles in inventory.
// get information for all vehicles

function getVehicles() {
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

?>