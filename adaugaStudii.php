<?php
session_start();

// Verificați dacă utilizatorul este autentificat. Dacă nu, redirecționați-l către pagina de login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Dacă utilizatorul a făcut logout (a accesat logout.php), distrugem sesiunea și îl redirecționăm către pagina de login
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit;
}
?>

<?php
require 'connection.php';
if(isset($_POST["submit"])){
    $titlu = $_POST["titlu"];
    $text = $_POST["text"];
    $link = $_POST["link"];
    if($_FILES["poza"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
    }
    else{
        $fileName = $_FILES["poza"]["name"];
        $fileSize = $_FILES["poza"]["size"];
        $tmpName = $_FILES["poza"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if ( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
        }
        else if($fileSize > 1000000){
            echo
            "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
        }
        else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'studii/' . $newImageName);
            $query = "INSERT INTO studii VALUES('', '$titlu', '$newImageName', '$text', '$link')";
            mysqli_query($conn, $query);
            echo
            "
      <script>
        alert('Successfully Added');
        document.location.href = 'studii.php';
      </script>
      ";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/dist/style.css">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Upload Image File</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <div class="flex font-sans">
            <!-- SIDEBAR -->
            <div class="topnav" id="myTopnav">
                <a href="/index.php">Harta</a>
                <a href="/adaugaMasuratoare.php">Adauga Masuratoare</a>
                <a href="/studii.php">Studii</a>
                <a href="/adaugaStudii.php">Adauga Studii</a>
                <?php
            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                // Show the "Login" button when the user is not logged in
                echo '<a href="/formular.php">Devino Membru</a>';
                echo '<a href="/login.php" style="float:right;">Login</a>';
            } else {
                // Show the "Logout" button when the user is logged in
                echo '<a href="logout.php" style="float:right;">Logout</a>';
            }
        ?>
            </div>
    </div>
    <div class="form-container">
        <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <label for="titlu">Titlu</label>
            <input type="text" name="titlu" id = "titlu" required value=""> <br>
            <label for="text">Text</label>
            <textarea name="text" id="text" rows="4" cols="50" required></textarea><br>
            <label for="link">Link</label>
            <input type="text" name="link" id = "link" required value=""> <br>
            <label for="poza">Imagine</label>
            <input type="file" name="poza" id = "poza" accept=".jpg, .jpeg, .png" value=""> <br> <br>
            <button type = "submit" name = "submit">Trimite</button>
        </form>
    </div>
</body>
</html>