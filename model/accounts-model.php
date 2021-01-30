<?php
/* this is the accounts model */

//the following function will handle site registrations.

//register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    //create a connection ogject using the phpmotors connection function
    $db = phpmotorsConnect();
    //theSQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    //create the paramet estament using the php_motors connection
    $stmt = $db->prepare($sql);
    //the next four lines replace the placeholders in the SQL 
    //statement with the actual values in the varable
    //and tells the database the type of data itb is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as a results of our insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    return $rowsChanged;
}



// this function will check for an existing email address.

function checkExistingEmail($clientEmail) {
    $db = phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
      return 0;
    } else {
      return 1;
    }
    // w8- this code is to check if the return part of the function works 
    //make sure to comment it out after testing
    // if (empty($matchEmail)) {
    //     echo 'Nothing found';
    //      exit;
    //  } else {
    //      echo 'Match found';
    //      exit;
    //  }
}

//this code is to get clients data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

function updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail)
{
  $db = phpmotorsConnect();
  $sql = 'UPDATE clients set clientFirstname = :clientFirstname, clientLastname = :clientLastname, 
    clientEmail = :clientEmail WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}
function getClientById($clientId)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function changePassword($clientId, $clientPassword)
{
  $db = phpmotorsConnect();
  $sql = 'UPDATE clients set clientPassword = :clientPassword WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

?>
