<?php

include_once "./config/database.php";


if (isset($_GET["id"])) {


    $id = $_GET["id"];
    $sql = "SELECT * FROM book WHERE id=$id LIMIT 0,1";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);

    $sql_retrieveAuthors = "SELECT a.* FROM bookauthour b JOIN authour a ON  a.id = b.idAuthour where b.idBook=$id ";
    $result_author = mysqli_query($conn, $sql_retrieveAuthors);
    $authors = mysqli_fetch_all($result_author, MYSQLI_ASSOC);


    function hasAuthor($authors,$id)
    {
       

        foreach ($authors as $key => $value) {
           if($value["id"]==$id){
              return true;
           }
        }
        
    }

    $sql_allAuthors = "SELECT a.* FROM  authour a";
    $result_authorAll = mysqli_query($conn, $sql_allAuthors);
    $authorsAll = mysqli_fetch_all($result_authorAll, MYSQLI_ASSOC);
}

if (isset($_POST["submit-form"])) {

    extract($_POST);

    $filepath="";
    $filename="" ;
    $files=$_FILES;
    $sql = "SELECT * FROM book WHERE id=$id LIMIT 0,1";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
    if(empty($_POST["img_file"])){
        $filepath = "./uploads/" . $book["image"];
        unlink($filepath);
        $filename = time() . $files["img_file"]["name"];
        $upload =  move_uploaded_file($files["img_file"]["tmp_name"], "uploads/" . $filename);
    }
    else{
        $filename= "./uploads/" . $book["image"];
    }
 

    // delete all authors
    $sql_DeleteBooksAuthours = "DELETE FROM bookauthour WHERE idbook=$id";
    if(!mysqli_query($conn, $sql_DeleteBooksAuthours)){
        echo "connection error : " . mysqli_error($conn);
    };

    //    Update the authors
    foreach ($authours as $key => $value) {
        $sql_AffectBookToAuthorsSelected = "INSERT INTO bookauthour(idbook,idauthour) VALUES($id,$value)";
        if (!mysqli_query($conn, $sql_AffectBookToAuthorsSelected)) {
            echo "connection error : " . mysqli_error($conn);
        }
    }

    $sql_updateBook = "UPDATE book SET title='$title' , description='$description' , image='$filename',price=$price WHERE id=$id";
    if (!mysqli_query($conn, $sql_updateBook)) {
        echo "connection error : " . mysqli_error($conn);
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

            <li><a href="books.php" class="">Book</a></li>
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
    <section class="add-book" id="add-book">
        <div class="add-book-title">
            <h2>Edit Book</h2>
        </div>
        <div class="container">

            <form action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $book["id"]; ?>">
                <div>
                    <label for="title">Title :</label>
                    <input type="text" id="title" name="title" value="<?php echo $book["title"]; ?>">

                </div>
                <div>
                    <label for="Price">Price :</label>
                    <input type="text" id="Price" name="price" value="<?php echo $book["price"]; ?>">

                </div>
                <div>
                    <label for="title">Authour :</label>
                    <br>
                    <select name="authours[]" multiple>
                        <?php foreach ($authorsAll as $author) : ?>
                            <?php if (hasAuthor($authors,$author["id"])) : ?>
                                <option value="<?php echo $author["id"]; ?>" selected>
                                    <?php echo $author["name"]; ?>
                                </option>
                            <?php else : ?>
                                <option value="<?php echo $author["id"]; ?>">
                                    <?php echo $author["name"]; ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <input type="file" name="img_file" id="file">
                    <img src=" <?php echo 'uploads/' . $book["image"]; ?>" alt="" width="440" height="320">
                </div>

                <div>
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" cols="30" rows="10"><?php echo $book["description"]; ?></textarea>
                </div>
                <button name="submit-form" type="submit">Submit</button>
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