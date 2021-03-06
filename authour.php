<?php
include_once "./config/database.php";
if (isset($_POST["submit-form"])) {
    
    $name2 = $_POST["name"];
    $birthday = $_POST["birthday"];

    if (empty($name2) && empty($birthday)) {
        header("Location: authour.php?error=name and birthday empty");
        die();
    }
    else if(empty($name2)){
        header("Location: authour.php?error=name empty");
        die();
    }
    else if(empty($birthday)){
        header("Location: authour.php?error=name empty");
        die();
    }
    else{
    $sql="INSERT INTO authour(name,birthday) VALUES('$name2','$birthday')";
    if(!mysqli_query($conn,$sql)){
        echo "query error ".mysqli_error($conn); 
        header("Location: authour.php?error=sql error");
    }
    else{
        header("Location: authour.php?message= success");

    }
   
      
    }
}




?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="sass/style.css">
    <!-- SEO HERE -->
    <title>BookStore</title>
</head>

<body>
    <header>
        <img src="imgs/logo.png" alt="logo image">
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="Gallery.php">Gallery</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="books.php">Book</a></li>
            <li><a href="authour.php" class="active">Authour</a></li>
        </ul>
        <ul class="nav-icons-sc">
            <li>
                <a href="#">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fab fa-google-plus"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggle">
            <i class="fas fa-bars fa-2x"></i>
        </button>
    </header>
    <!-- main -->
    <section class="add-book" id="add-book">
        <div class="title">
            <h2>Add Authour</h2>
        </div>
        <div class="container">

            <form action="authour.php" method="POST">

                <div>
                    <label for="title">Name :</label>
                    <input type="text" name="name" id="name">
                </div>
                <div>
                    <label for="title">Birthday :</label>
                    <input type="text" name="birthday" id="date">
                </div>

                <button type="submit" name="submit-form">Submit</button>
            </form>
        </div>
    </section>
    <!--end of main -->
    <footer>

        <div class="company">
            <h3 class="titles">Ebook<span>s</span></h3>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur, saepe possimus dolores cupiditate neque ad.

            </p>
        </div>
        <div class="contact">
            <h3 class="titles">Contact</h3>
            <ul>
                <li><i class="fab fa-facebook"></i> hassan chajaii</li>
                <li><i class="fab fa-whatsapp"></i> +212607560340</li>
                <li><i class="fab fa-google-plus"></i> hassanchajaii@gmail.com</li>
            </ul>
        </div>
        <div class="follow">
            <h3 class="titles">Folow Us <span>.</span></h3>
            <div class="grp-icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-google-plus"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>

    </footer>
</body>
<!-- js here -->
<script src="js/sandbox.js"></script>
<script src="js/navbar.js"></script>

</html>