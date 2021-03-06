<?php 

include_once "./config/database.php";

$get_books = "SELECT * FROM book";
$result = mysqli_query($conn, $get_books);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

// suppression 

function Supp_book($id){
    global $conn;

    $delete_bookintableBOOKandAUTHOR="DELETE FROM bookauthour where idbook=$id";


    if(mysqli_query($conn,$delete_bookintableBOOKandAUTHOR)){

        $sql_deletebook="DELETE FROM book WHERE id=$id";
        if(!mysqli_query($conn,$sql_deletebook)){
            echo "Mysql Error : ".mysqli_error($conn);
            die();
        }
    }





}

if(isset($_POST["submit-delete"])){
    $id=$_POST["id"];
    Supp_book($id);
    header("Location: books.php");
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
            <li><a href="books.php" class="active">Book</a></li>
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
    <section class="books" id="books">
        <div class="title">
            <h2>Books</h2>
        </div>
        <div class="container">
            <div class="btns">
                <div class="filter">
                    <button class="all">
                        All
                    </button>
                    <button class="Recent">
                        Recent
                    </button>

                </div>
                <button class="addbook" onclick='window.location="book.php"'>Add Book</button>
            </div>
            <div class="data">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>price</th>
                        <th>Edit</th>
                    </tr>


<?php foreach($books as $book): ?>

                    <tr>
                        <td><?php echo $book["id"]; ?></td>
                        <td><?php echo $book["title"]; ?></td>
                        <td><?php echo $book["description"]; ?></td>
                        <td><?php echo $book["price"]; ?></td>
                        <td class="edit">
                            <!-- <i class="fas fa-bars"></i> -->

                            <!-- <ul> -->
                                <!-- <li> -->
                                    <a class="edit.php?id=<?php echo $book["id"]; ?>" href="edit.php?id=<?php echo $book["id"]; ?>">Edit</a>

                                <!-- </li> -->
                                <!-- <li> -->
                                <form action="books.php" method="POST" style="margin: 7px 0px;">
                                <input type="hidden" name="id" value="<?php echo  $book["id"]; ?>" />
                                <button name="submit-delete" type="submit" href="#">Delete</button>
                                </form>
                                    
                                <!-- </li> -->
                            <!-- </ul> -->

                        </td>

                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>
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