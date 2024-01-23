<?php
session_start();

require 'connection.php';


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/dist/style.css">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Data</title>
    <style>
        /* Stilurile tabelului și celulelor */
       
        th, td {
            padding: 10px;
            border: none; /* Va elimina bordura celulelor */
        }

        /* Stil pentru linkul "Data" */
        a {
            display: inline-block;
        }

        /* Stil pentru imaginea mărită */
        .enlarged-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
        }
        .enlarged-image img {
            max-width: 90%;
            max-height: 90%;
        }
        
        table {
            border-collapse: collapse;
            margin: 20px auto; /* Adauga margini si va centra tabelul pe mijlocul paginii */
        }

        

        /* Stilurile pentru tabel */
        table {
            width: 80%; /* Seteaza latimea tabelului */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

       

    </style>
    
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
    <table>
        <?php
        
        
        $rows = mysqli_query($conn, "SELECT * FROM studii ORDER BY id DESC");
        foreach ($rows as $row) : ?>
            <tr>
                <th rowspan="3" style="width:30%">
                    <img src="studii/<?php echo $row["poza"]; ?>" width="200" onclick="showEnlargedImage(this)">
                </th>
                <th colspan="2" style="width:70%"> <?php echo $row["titlu"]; ?> </th>
            </tr>
            <tr>
                <td> <?php echo $row["text"] ?> </td>
            </tr>
            <tr>
                <td colspan="3"> Sursa: <a href="<?php echo $row["link"] ?>"><?php echo $row["link"] ?></a> </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Div pentru afișarea imaginii mărite -->
    <div class="enlarged-image" onclick="hideEnlargedImage()">
        <img id="enlarged-img" src="" alt="Enlarged Image">
    </div>

    <script>
        function showEnlargedImage(img) {
            var enlargedImg = document.getElementById("enlarged-img");
            enlargedImg.src = img.src;
            document.querySelector(".enlarged-image").style.display = "flex";
        }

        function hideEnlargedImage() {
            document.querySelector(".enlarged-image").style.display = "none";
        }
    </script>
</body>
</html>
