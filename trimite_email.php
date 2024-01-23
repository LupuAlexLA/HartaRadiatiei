<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    // Adresa la care doriti sa primiti email-ul
    $destinatar = 'alexpaullupu@gmail.com';

    // Subiectul email-ului
    $subiect = 'Formular completat';

    // Continutul email-ului
    $mesaj = "Nume: $nume\nNumăr de telefon: $telefon\nEmail: $email";

    // Setam anteturi pentru a specifica ca email-ul contine text simplu
    $anteturi = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Trimitem email-ul
    if (mail($destinatar, $subiect, $mesaj, $anteturi)) {
        echo '<script>alert("Email trimis cu succes!"); window.location.href = "studii.php";</script>';
        exit;
    } else {
        echo '<script>alert("Ne pare rau, dar mesajul nu a putut fi trimis."); window.location.href = "studii.php";</script>';
        exit;
    }
}
?>
