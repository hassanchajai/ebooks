<?php 

include_once "./config/database.php";

$get_books = "SELECT * FROM book";
$result = mysqli_query($conn, $get_books);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);




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
        <ul class="nav-links ">
            <li><a href="index.html">Home</a></li>
            <li><a href="Gallery.php" class="active">Gallery</a></li>
            <li><a href="contact.html">Contact</a></li>

            <li><a href="books.php">Book</a></li>
            <li><a href="authour.php">Authour</a></li>

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
    <section id="gallery" class="gallery">

        <div class="container">
            <h2>Gallery > Books > Items</h2>
            <div class="row">
                <!-- filter -->
                <div class="col filter">
                    <form>
                        <h3>Price :</h3>
                        <input placeholder="Min" type="number" name="min" class="price" id="min"> - <input placeholder="Max" type="number" class="price" name="max" id="max">
                        <p class="error-price"></p>
                        <h3>Authors :</h3>
                        <div class="input-recherche">
                            <input placeholder="Write something" type="text" name="search" id="search" style="display: block;">
                            <i class="fas fa-search"></i>
                        </div>

                        <br>

                    </form>
                </div>
                <!-- items -->
                <div class="col items">
                    <!-- begin of item -->
                    <?php foreach($books as $book): ?>
                    <div class="item">
                        <div class="card-gallery">
                            <!-- <div class="offer">
                                <i class="fas fa-ad" style="margin-right: 8px;"></i> special
                            </div> -->
                            <div class="card-gallery-img">
                                <img src="<?php echo "uploads/".$book["image"]; ?>" alt="">
                            </div>
                            <div class="card-gallery-body">
                                <h3 class="item-title"><?php echo $book["title"]; ?></h3>
                                <div class="details">
                                    <p><?php echo $book["description"]; ?></p>
                                    <p class="price"><?php echo $book["price"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of item -->
                    <?php endforeach; ?>
                    
                </div>
            </div>
            <!-- <ul class="pagination">
                <li>1</li>
                <li>2</li>
                <li>3</li>
            </ul> -->
        </div>
    </section>
    <!-- end of main -->
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
<script src="js/gallery.js"></script>

</html>