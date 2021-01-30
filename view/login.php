<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">

    <title>Login | PHPMotors</title>
</head>

<body>

   

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>


        <main>
            <div>
                <h1 class="title">Sign in</h1>
            </div>
            <!-- <div id="feedback"></div> -->
            <!-- <form action="/my-handling-form-page" method="post"> -->
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
               // unset($_SESSION['message']);
            }
            ?>

            <form method="POST" action="/phpmotors/accounts/index.php">
                <ul>
                    <li>
                        <label>Email: </label> <br> 
                      <!--  <label for="email">Email: </label> -->
                        <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($clientEmail)) {
                                                                        echo "value= '$clientEmail' ";
                                                                    } ?> required>
                    </li>
                    <li>
                        <!-- <label for="password">Password: </label><br>
                        <input type="password" id="password" name="password"> -->
                        <label for="clientPassword">Password:</label><br>
                        <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=.{8,}$)(?=.*\d((?=.*\W+)(?=.![.\n)(?=.*[A-Z])(?=.*[a-z].*$"><br>
                        <span>Password must be at least 8 characters <br>and contain at least 1 number, 1 capital letter and 1 special character</span>
                        <!-- remembert to change from type="text" to "password" after testing "IMPORTANT" and backward for test-->
                    </li>
                </ul>
                <input type="submit" value="Sign-in">
                <br>
                <a class="star" href="/phpmotors/accounts/?action=registration" id="toreg">Not a Member Yet?</a>
                <!-- <button>Sign-in</button> -->
                <!-- add the action name - value pair -->
                <input type="hidden" name="action" value="Login">
            </form>
        </main>
        <br>
        <div class="span"><span style="color: red; font-weight: bold;">*</span>All fields are required.</div>
        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <hr class="one">


        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</body>

</html>