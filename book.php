<?php
include_once "./config/database.php";
// remplir select with authours
$get_authors = "SELECT id,name FROM authour";
$result = mysqli_query($conn, $get_authors);
$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST["submit-form"])) {
    extract($_POST);
    if (empty($title) && empty($description) && empty($authours)) {
        header("Location: book.php?error=title and description and Authors are empty");
        die();
    } else if (empty($title) && empty($description)) {
        header("Location: book.php?error=title and description are empty");
        die();
    } else if (empty($title) && empty($authours)) {
        header("Location: book.php?error=title and Authors are empty");
        die();
    } else  if (empty($description) && empty($authours)) {
        header("Location: book.php?error=Authors and description are empty");
        die();
    } else if (empty($description)) {
        header("Location: book.php?error=description are empty");
        die();
    } else  if (empty($title)) {
        header("Location: book.php?error=title are empty");
        die();
    } else  if (empty($authours)) {
        header("Location: book.php?error=Authors are empty");
        die();
    } else {

        // store image
        //get extension from the file
        $files = $_FILES;
        $filename = "";
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $files["img_file"]["name"]);
        $extension = end($temp);
        if ((($files["img_file"]["type"] == "image/gif") //check image is gif
                || ($files["img_file"]["type"] == "image/jpeg") //check image is jpeg
                || ($files["img_file"]["type"] == "image/jpg")     //check image is jpg
                || ($files["img_file"]["type"] == "image/png")) //check image is png
            && ($files["img_file"]["size"] < 2000000) //check if image size is below 2MB
            && in_array(trim($extension), $allowedExts)
        ) //check the extensions also
        {
            if ($files["img_file"]["error"] > 0) //check if any file error
            {
                echo $files["img_file"]["error"];
            } else {
                //unique file name to avoid overwriting
                $filename = time() . $files["img_file"]["name"];

                //move the uploaded file to folder
                $upload =  move_uploaded_file($files["img_file"]["tmp_name"], "uploads/" . $filename);

                $sql_insertBook = "INSERT INTO book(title,description,image,price) VALUES('$title','$description','$filename',$price)";
                $query = mysqli_query($conn, $sql_insertBook);
                if (!$query) {
                    echo "query error " . mysqli_error($conn);
                } else {
                    // success 
                    $idbook=mysqli_insert_id($conn);
                   
                    foreach ($_POST["authours"] as $key => $value) {
                         $sql_AffectBookToAuthorsSelected = "INSERT INTO bookauthour(idbook,idauthour) VALUES($idbook,$value)";
                        if(!mysqli_query($conn, $sql_AffectBookToAuthorsSelected)){
                            echo "connection error : ".mysqli_error($conn);
                        }


                    }
                }
            }
        } else {
            echo "Please upload only image files and should be less than 2MB";
        }

        //end store

    }
}

/* 


  foreach ($_POST['subject'] as $subject)  
                print "You selected $subject<br/>"; 


      
*/

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
            <li><a href="Gallery.html">Gallery</a></li>
            <li><a href="contact.html">Contact</a></li>

            <li><a href="books.html" class="active">Book</a></li>
            <li><a href="authour.html">Authour</a></li>

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
            <h2>Add Book</h2>
        </div>
        <div class="container">

            <form action="book.php" method="POST" enctype="multipart/form-data">

                <div>
                    <label for="title">Title :</label>
                    <input type="text" id="title" name="title">
                </div>
                <div>
                    <label for="Price">Price :</label>
                    <input type="text" id="Price" name="price" value="0">

                </div>
                <div>
                    <label for="authour">Authour :</label>
                    <br>
                    <select name="authours[]" multiple>
                        <?php foreach ($authors as $author) :  ?>
                            <option value="<?php echo $author["id"]; ?>">
                                <?php echo $author["name"]; ?>
                            </option><?php endforeach; ?>
                    </select>
                    <?php  ?>
                </div>
                <div>
                    <input type="file" name="img_file" id="file">

                </div>

                <div>
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
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