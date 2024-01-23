<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formular</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/style.css">
    <link href="../dist/output.css" rel="stylesheet">
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
        <form action="trimite_email.php" method="POST">
            <div class="form-group">
                <label for="nume">Nume:</label>
                <input type="text" id="nume" name="nume" required>
            </div>

            <div class="form-group">
                <label for="telefon">Numar de telefon:</label>
                <input type="text" id="telefon" name="telefon" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <button type = "submit" name = "submit">Trimite</button>
        </form>
    </div>
</body>
</html>
