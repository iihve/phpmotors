<?php
//this code checks that a client is "loggedin" AND has a clientLevel 
//greater than "1" to access the view. If not, redirect the client 
//back to the phpmotors controller to deliver the PHP Motors home view.
if (!$_SESSION['loggedin']) {
    header('location:/phpmotors/');
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


    <title>Client Update Information | PHPMotors</title>
</head>

<body>



    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>


    <!-- tis nav is part of the modules is excluded to make the nav dinamic MVC -->
    <!-- php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
    <nav>
        <?php echo $navList; ?>
    </nav>

    <main>

        <!-- Account Update form -->
        <div>
            <h1 class="title">Update Account Information</h1>
        </div>
        <h3 class="sub-title">Update Account Information</h3>

        <!--  <p>Sorry Admin, we could not update your account information. Please try again.</p> -->


        <form method="POST" action="/phpmotors/accounts/index.php">
            <ul>
                <li>
                    <label for="fname">First Name: </label><br>
                    <input type="text" id="fname" name="clientFirstname" value="<?php if (isset($clientFirstname)) {
                                                                                    echo $clientFirstname;
                                                                                } else {
                                                                                    echo $_SESSION['clientData']['clientFirstname'];
                                                                                } ?>">
                </li>
                <li>
                    <label for="lname">Last Name: </label><br>
                    <input type="text" id="lname" name="clientLastname" value="<?php if (isset($clientLastname)) {
                                                                                    echo $clientLastname;
                                                                                } else {
                                                                                    echo $_SESSION['clientData']['clientLastname'];
                                                                                } ?>">
                </li>
                <li>
                    <label for="email">E-mail: </label><br>
                    <input type="email" id="email" name="clientEmail" value="<?php if (isset($clientEmail)) {
                                                                                    echo $clientEmail;
                                                                                } else {
                                                                                    echo $_SESSION['clientData']['clientEmail'];
                                                                                } ?>">
                </li>
            </ul>
            <input type="submit" name="updateInfo" id="btn" value="Update Info">
            <!-- add the action name - value pair -->
            <input type="hidden" name="action" value="update">
        </form>


        <!-- Update Password form -->
        <div>
            <h1 class="title">Update Password</h1>
        </div>

        <!--  <p>Error ocurred the password was not changed.</p> -->


        <form method="POST" action="/phpmotors/accounts/index.php">
            <ul>
                <li><span>Password must be at least 8 characters <br>and contain at least 1 number, 1 capital letter and 1 special character</span></li>
            </ul>
            <p class="notice">*note your original password will be changed.</p>
            <ul>
                <li>
                    <!-- <label for="password">Password: </label><br>
                        <input type="password" id="password" name="clientPassword"> -->
                    <label for="clientPassword">Password:</label><br>
                    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=.{8,}$)(?=.*\d((?=.*\W+)(?=.![.\n)(?=.*[A-Z])(?=.*[a-z].*$"><br>

                    <!-- remembert to change from type="text" to "password" after testing "IMPORTANT" and backward for test-->
                </li>

            </ul>
            <input type="submit" name="submit" id="regbtn" value="Password">
            <!-- add the action name - value pair -->
            <input type="hidden" name="action" value="newPassword">
        </form>



        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <hr class="one">

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>

</html>