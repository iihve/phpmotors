<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">


    <title>Template | PHPMotors</title>
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
                <h1 class="title">Content Title Here</h1>
            </div>


            <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
            <hr class="one">

        </main>
        
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

    
</body>

</html>