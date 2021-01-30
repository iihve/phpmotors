<?php
//add W9 if not done in W8 extracredit
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
// build a dynamic list using the classifications array
$classificationList = '<select id="classificationId" name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] === $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
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
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
            } ?> | PHPMotors</title>
</head>

<body>
    <div class="container">


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
                                    } elseif (isset($invMake) && isset($invModel)) {
                                        echo "Modify $invMake $invModel";
                                    } ?>Modifying Vehicle</h1>
            </div>
            <br>
            <div class="span"><span style="color: red; font-weight: bold;">*</span>All fields are required.</div>
            <ul>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="/phpmotors/vehicles/index.php">

                    <label for="classificationId">Choose a classification:</label>
                    <!-- create a drop down list to select a car -->
                    <?php
                    echo $classificationList;
                    ?>
                    <br>
                    <label for="make">Make: </label><br>
                    <input type="text" id="make" name="invMake" pattern="^[a-zA-Z\s]*$" <?php if (isset($invMake)) {
                                                                                            echo "value= '$invMake' ";
                                                                                        } elseif (isset($invInfo['invMake'])) {
                                                                                            echo "value='$invInfo[invMake]'";
                                                                                        } ?> required>
                    <br>
                    <label for="model">Last Model: </label><br>
                    <input type="text" id="model" name="invModel" pattern="^[a-zA-Z\s]*$" <?php if (isset($invModel)) {
                                                                                                echo "value= '$invModel' ";
                                                                                            } elseif (isset($invInfo['invModel'])) {
                                                                                                echo "value='$invInfo[invModel]'";
                                                                                            } ?> required>
                    <br>
                    <label for="description">Description: </label><br>
                    <textarea id="description" name="invDescription" required><?php if (isset($invDescription)) {
                        echo $invDescription;
                    } elseif (isset($invInfo['invDescription'])) {
                        echo $invInfo['invDescription'];
                    } ?></textarea>
                    <br>
                    <label for="image">Image Path: </label><br>
                    <input type="text" id="image" name="invImage" value="/images/no-image.png" placeholder="Vehicle Image Path" pattern="([/|.|\w|\s|-])*\.(?:jpg|gif|png)" <?php if (isset($invImage)) {
                                                                                                                                                                                echo "value= '$invImage' ";
                                                                                                                                                                            } elseif (isset($invInfo['invImage'])) {
                                                                                                                                                                                echo "value='$invInfo[invImage]'";
                                                                                                                                                                            } ?> required>
                    <br>
                    <label for="thumbnail">Thumbnail Path: </label><br>
                    <input type="text" id="thumbnail" name="invThumbnail" placeholder="Thumbnail" pattern="([/|.|\w|\s|-])*\.(?:jpg|gif|png)" <?php if (isset($invThumbnail)) {
                                                                                                                                                    echo "value= '$invThumbnail' ";
                                                                                                                                                } elseif (isset($invInfo['invThumbnail'])) {
                                                                                                                                                    echo "value='$invInfo[invThumbnail]'";
                                                                                                                                                } ?> required>
                    <br>
                    <label for="price">Price: </label><br>
                    <input type="text" id="price" name="invPrice" pattern="^[+-]?[0-9]{1,3}(?:[0-9]{3})*(?:\.[0-9]{2})?$" <?php if (isset($invPrice)) {
                                                                                                                                echo "value= '$invPrice' ";
                                                                                                                            } elseif (isset($invInfo['invPrice'])) {
                                                                                                                                echo "value='$invInfo[invPrice]'";
                                                                                                                            } ?> required>
                    <br>
                    <label for="stock"># in stock:</label><br>
                    <input type="number" id="stock" name="invStock" pattern="^\d+$" <?php if (isset($invStock)) {
                                                                                        echo "value= '$invStock' ";
                                                                                    } elseif (isset($invInfo['invStock'])) {
                                                                                        echo "value='$invInfo[invStock]'";
                                                                                    } ?> required>
                    <br>
                    <label for="color">color:</label><br>
                    <input type="text" id="color" name="invColor" pattern="^[a-zA-Z\s]*$" <?php if (isset($invColor)) {
                                                                                                echo "value= '$invColor' ";
                                                                                            } elseif (isset($invInfo['invColor'])) {
                                                                                                echo "value='$invInfo[invColor]'";
                                                                                            } ?> required>
                    <br>
                    <input type="submit" name="submit" id="regbtn" value="Update Vehicle">
                    <!-- action name value pair will be added here -->
                    <br>
                    <!-- W9 step 1-2 -->
                    <input type="hidden" name="action" value="updateVehicle">
                    <!-- W9 step 2-2 -->
                    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                    echo $invInfo['invId'];
                                                                } elseif (isset($invId)) {
                                                                    echo $invId;
                                                                } ?>">
                    <br>
                </form>
            </ul>
            <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
            <hr class="one">
        </main>

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

    </div>
</body>

</html>