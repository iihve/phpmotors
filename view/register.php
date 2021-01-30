<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">

    <title>Register | PHPMotors</title>
</head>

<body>
   

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <div>
                <h1 class="title">Register</h1>
            </div>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/accounts/index.php" method="POST">
                <ul>
                    <li>
                        <label for="fname">First Name: </label><br>
                        <input type="text" id="fname" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                                    echo "value='$clientFirstname' ";
                                                                                } ?>>
                    </li>
                    <li>
                        <label for="lname">Last Name: </label><br>
                        <input type="text" id="lname" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                                echo "value='$clientLastname' ";
                                                                            } ?>>
                    </li>
                    <li>
                        <label for="email">E-mail: </label><br>
                        <input type="email" id="email" name="clientEmail" required placeholder="Enter a valid email address" <?php if (isset($clientEmail)) {
                                                                                                                                echo "value= '$clientEmail' ";
                                                                                                                            } ?>>
                    </li>
                    <li>
                        <!-- <label for="password">Password: </label><br>
                        <input type="password" id="password" name="clientPassword"> -->
                        <label for="clientPassword">Password:</label><br>
                        <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=.{8,}$)(?=.*\d((?=.*\W+)(?=.![.\n)(?=.*[A-Z])(?=.*[a-z].*$"><br>
                        <span>Password must be at least 8 characters <br>and contain at least 1 number, 1 capital letter and 1 special character</span>
                        <!-- remembert to change from type="text" to "password" after testing "IMPORTANT" and backward for test-->
                    </li>

                </ul>
                <ul><input type="submit" name="submit" id="regbtn" value="register"></ul>
                <!-- add the action name - value pair -->
                <input type="hidden" name="action" value="register">

                <!-- <button>Register</button> -->
            </form>
            <br>
            <div class="span"><span style="color: red; font-weight: bold;">*</span>All fields are required.</div>
            <br>
            <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
            <hr class="one">

        </main>

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

   
</body>

</html>