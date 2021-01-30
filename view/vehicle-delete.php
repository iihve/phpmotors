<?php
//add W9 if not done in W8 extracredit
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">


    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHPMotors</title>
</head>

<body>
    


        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>


        <!-- this nav is part of the modules is excluded to make the nav dinamic MVC -->
        <!-- php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <div>
                <h1 class="title"><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                                        echo "Modify $invInfo[invMake] $invInfo[invModel]";
                                    } ?> | PHP Motors</h1>

                <p class="center red">Comfirm Vehicle Deletion. the delete is permanent.</p>
            </div>
            <br>
         <!--   <div class="span"><span style="color: red; font-weight: bold;">*</span>All fields are required.</div> -->
            <ul>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="/phpmotors/vehicles/">
                  <!--  <fieldset> -->
                    
                    <label for="invMake">Vehicle Make: </label><br>
                    <input type="text" readonly id="invMake" name="invMake" <?php if (isset($invInfo['invMake'])) {
                                                                                            echo "value= '$invInfo[invMake]' ";
                                                                                        } ?>> <!-- required> -->
                    <br>
                    <label for="invModel">Vehicle Model: </label><br>
                    <input type="text" readonly id="invModel" name="invModel" <?php if (isset($invInfo)) {
                                                                                                echo "value= '$invInfo[invModel]' ";
                                                                                            }  ?>>
                    <br>
                    <label for="description">Vehicle Description: </label><br>
                    <textarea id="invDescription" name="invDescription">
                    <?php if (isset($invInfo['invDescription'])) {
                        echo $invInfo['invDescription'];
                    } ?></textarea>
                    <br>
                  
                    <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">
                    <!-- action name value pair will be added here -->
                    <br>
                    <!-- W9 step 1-2 -->
                    <input type="hidden" name="action" value="deleteVehicle">
                    <!-- W9 step 2-2 -->
                    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                    echo $invInfo['invId'];
                                                                } ?>">
                    <br>
                   <!-- </fieldset> -->
                </form>
                
            </ul>
            <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
            <hr class="one">
        </main>

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

   
</body>

</html>