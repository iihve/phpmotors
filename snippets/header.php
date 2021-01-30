 <?php if (isset($_COOKIE['firstname'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    } ?>
 <header>
     <!-- ths is the header module for the web page -->
     <div class="header">
         <!-- <div class="logo-image"> -->
             <img src="/phpmotors/images/site/logo.png" alt="Image of logo" id="logo">
         <!-- </div> -->
         <?php
            if (isset($cookieFirstname)) {
                echo "<p><span id='cookie'>Welcome, $cookieFirstname</span></p>";
            }
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                echo '<a id="logOut" href="/phpmotors/accounts?action=logout" title="Log out">Log out</a>';
            } else {
                echo '<a id="logIn" href="/phpmotors/accounts?action=login" title="Login or Register with PHP Motors">My Acount</a>';
            }
            ?>
         <!-- <li>My Account</li> -->
     </div>
 </header>