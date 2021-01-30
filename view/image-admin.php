<?php
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


    <title>Image Management | PHPMotors</title>
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
            <h1 class="title">Image Management</h1>
        </div>

        <p class="choose">Choose an option below:</p>

        <div class="h2-1">
            <h2>Add New Vehicle Image</h2>
        </div>
        <?php
        if (isset($message)) {
            echo $message;
        } ?>


        <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="invItem">Vehicle</label><br>
                    <?php echo $prodSelect; ?>
                </li><br>
                <li class="fieldset1">
                    <fieldset>
                        <legend>Is this the main image for the vehicle?</legend><br>
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                        <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </fieldset><br>
                </li>

                <li>
                    <label>Upload Image: </label><br>
                    <input type="file" name="file1">
                    <input type="submit" class="regbtn" value="Upload">
                    <input type="hidden" name="action" value="upload">
                </li>
            </ul>
        </form>

        <!-- After the form closing tag add a <hr> element to create a visual separator on the page. -->
        <hr>
        <!-- Beneath the horizontal rule add the following code: -->
        <div class="h2-1">
            <h2>Existing Images</h2>
        </div>
        <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>

        <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
        } ?>


        <!--the hr is the line to divide the footer from the main,
            keep it at the end of content always -->
        <hr class="one">

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>

</html>
<?php unset($_SESSION['massage']); ?>