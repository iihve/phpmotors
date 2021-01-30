<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">


    <title>Error | PHPMotors</title>
</head>

<body>
   

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

        <nav>

            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?>

        </nav>

        <main>
            <div class="items">
                <h1 class="title">Server Error </h1>

                <div class="ip">
                    <p>Sorry the server seems to be experincing some technical difficulties. Please check back later.</p>
                </div>
            </div>

            <!-- always keep the hr here -->
            <hr>


        </main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

   
</body>

</html>