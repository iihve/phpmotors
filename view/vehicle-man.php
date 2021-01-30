<?php
//add W9 if not done in W8 extracredit
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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


    <title>Vehicle Management | PHPMotors</title>
</head>

<body>



    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>


    <!-- tis nav is part of the modules is excluded to make the nav dinamic MVC -->
    <!-- php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
    <nav>
        <?php echo $navList; ?>
    </nav>

    <main>
        <div>
            <h1 class="title">Vehicle Management</h1>
        </div>
        <ul>
            <li><a href="/phpmotors/vehicles?action=add-classification">Add Classification</a></li>
            <li><a href="/phpmotors/vehicles?action=add-vehicle">Add Vehicle</a></li>
        </ul>
        <!--add W9 to show a select menue -->
        <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($classificationList)) {
            echo '<h2 class="h2-2">Vehicles By Classification</h2>';
            echo '<p class="notice">Choose a classification to see those vehicles</p>';
            echo $classificationList;
        }
        ?>
        <noscript>
            <!-- This code shows only if javascript is desable-->
            <p><strong>JaveScript Must Be Enable to Use this page.</strong></p>
        </noscript>
        <!--this code will be used as a JavaScript hook to know where to inject the inventory list. -->
        <table id="inventoryDisplay"></table>


        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <br>
        <hr class="one">
    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


    <script src="../js/inventory.js"></script>
</body>

</html>

<?php unset($_SESSION['message']); ?>


<!--add-classification.php
add-vehicle.php -->