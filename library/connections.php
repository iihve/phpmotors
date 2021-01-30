<?php
/*
* Proxy connection to the phpmotors database
*/

/*to test try adding a value (1) to the end 
of functions and check on browser to see changes
then erase the value to check it works correctly*/

function phpmotorsConnect()
{
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'eYXCuISLYEQcJaNd';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $db = new PDO($dsn, $username, $password, $option);
       return $db;
    } catch (PDOException $e) {
        //echo "It didn't work, error: " . $e->getMessage();
        header('Location: http://localhost/phpmotors/view/500.php');
        exit;
    }
}

//remember to take this off when you finish testing
//phpmotorsConnect();

?>
