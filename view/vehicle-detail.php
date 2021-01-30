<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">


    <title>vehicle-detail | PHPMotors</title>
</head>

<body>


    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <!-- tis nav is part of the modules is excluded to make the nav dinamic MVC -->
    <!-- php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
    <nav>
        <?php echo $navList; ?>
    </nav>

    <main>

        <?php if (isset($message)) {
            echo $message;
        }
        if (isset($vehicleDisplayDetails)) {
            echo $vehicleDisplayDetails;
        ?>
        <hr>
            <h2 class="h2-2">Vehicle Details</h2>

            <form method="POST" action="/phpmotors/reviews/index.php">
                <input type="hidden" name="action" value="createReviews">
                <div class="textarea2"><textarea id="review_text_area" name="reviewText" required></textarea></div><br>

                <!-- <div class="textarea2"><textarea rows="8" cols="49" placeholder=" Please type a review for this vehicle. " id="review_text_area" name="reviewText" required></textarea></div><br> -->

                <input class="bt3" type="submit" value="Add Review">

                <input type="hidden" name="invId" value="<?php echo $invId; ?>">

            </form>
            <br>
        <?php

            echo $reviews;
        }
        ?>

        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <hr class="one">

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>

</html>