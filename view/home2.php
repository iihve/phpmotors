<!DOCTYPE html>
<html lang="en">
<!-- this view was created to fix the responcive problems of the site on 6/24-25/2020 of week 10 kep for reference -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/phpmotors/css/styles2.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Orbitron&display=swap" rel="stylesheet">

    <title>Home | PHPMotors</title>
</head>

<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <nav>
        <?php echo $navList; ?>
    </nav>

    <main>

        <div>
            <h1 class="title">Welcome to PHP Motors!</h1>
        </div>

        <section class="home-image">
            <div class="anuncio">
                <h2>DMC Delorean</h2>
                <ul>
                    <li>3Cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
                <button>Own Today</button>
            </div>
            <!-- <img src="/phpmotors/images/delorean.jpg" alt="Image of a Delorean car"> -->
            <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Image of a Delorean car">
        </section>

        <div class="container">

            <section class="upgrades">
                <h2 class="delorian">Delorean Upgrades</h2>
                <div class="left-grid">

                    <div class="up">
                        <ul>
                            <li class="a">
                                <img class="i1" src="/phpmotors/images/upgrades/flux-cap.png" alt="image of a flux capacitor">
                            </li>
                        </ul>
                        <p>Flux Capasitor</p>
                        <ul>
                            <li class="c">
                                <img class="i3" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="image of a bumper sticker">
                            </li>
                        </ul>
                        <p>Bumper Stickers</p>
                    </div>
                    <div class="down">
                        <ul>
                            <li class="b">
                                <img class="i2" src="/phpmotors/images/upgrades/flame.jpg" alt="image of a flame decals">
                            </li>
                        </ul>
                        <p>Flame Decals</p>
                        <ul>
                            <li class="d">
                                <img class="i4" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="image of a hub caps">
                            </li>
                        </ul>
                        <p>Hub Caps</p>

                    </div>
                </div>
            </section>

            <section class="reviews">
                <h2 class="reviews1">DMC Deloream Reviews</h2>
                <div class="right-grid">
                    <ul>
                        <li>"So fast its almost like traveling i time" (4/5)</li>
                        <li>"Coolest ride on the road" (4/5)</li>
                        <li>"I'm feeling Marty McFly" (5/5)</li>
                        <li> "80's living and I love it!" (5/5)</li>
                    </ul>
                </div>
            </section>

        </div>
        <hr>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</body>

</html>