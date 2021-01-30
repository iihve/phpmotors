<?php
//this code checks that a client is "loggedin" AND has a clientLevel 
//greater than "1" to access the view. If not, redirect the client 
//back to the phpmotors controller to deliver the PHP Motors home view.
if (!$_SESSION['loggedin']) {
    header('location:/phpmotors/');
    exit;
}
$reviews = buildReviews(getReviewsByClient($_SESSION['clientData']['clientId']));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">


    <title>Admin | PHPMotors</title>
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
            <!--add user first name from registration -->
            <h1 class="title">
                <?php
                echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];
                ?>
            </h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </div>
        <h3 class="sub-title">You are logged in.</h3>
        <!--   <p>Admin, your information has been updated.</p> -->
        <div>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?> </li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?> </li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?> </li>
            </ul>
        </div>


        <br>

        <h2 class="h2-2">Account Management</h2><br>
        <p class="choose">Use this link to udate account information.</p><br>
        <div>
            <?php
            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<a href="/phpmotors/accounts?action=client-update">Update Account Information</a>';
            }
            ?>


        </div>
        <h2 class="h2-2">Inventory Management.</h2><br>
        <p class="choose">Use this link to manage the inventory.</p>

        <?php
        if ($_SESSION['clientData']['clientLevel'] > 1) {
            echo '<a href="/phpmotors/vehicles">Vehicle Management</a>';
        }
        ?>
        <hr>
        <br>
        <!-- W12-13 ECHO REVIEWS -->
        <?php echo $reviews ?>


        <br>
        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <hr class="one">

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>

</html>