<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        require 'PHPMailer/Exception.php';

       
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'your@example.com'; 
        $mail->Password = 'yourpassword'; 
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

      
        $mail->setFrom($_POST['email'], $_POST['firstName'] . ' ' . $_POST['lastName']);
        $mail->addAddress('plumber@gmail.com'); 

      
        $mail->isHTML(true);
        $mail->Subject = 'Nový kontakt z formuláře';
        $mail->Body = 'Jméno: ' . $_POST['firstName'] . ' ' . $_POST['lastName'] . '<br>Email: ' . $_POST['email'] . '<br>Telefon: ' . $_POST['phone'];

     
        if ($mail->send()) {
            echo '<script>alert("Email byl úspěšně odeslán.");</script>';
        } else {
            echo '<script>alert("Nastala chyba při odesílání emailu. Zkuste to prosím znovu později.");</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body class="body1">
    <?php include 'navbar.php'; ?>

    <main>
        <p class="contact">CONTACT US</p>

        <div class="transparent-input">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="firstName"></label>
                <input type="text" id="firstName" name="firstName" placeholder="FIRST NAME" required>
                <br>
                <label for="lastName"></label>
                <input type="text" id="lastName" name="lastName" placeholder="LAST NAME" required>
                <br>
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="EMAIL" required>
                <br>
                <label for="phone"></label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="PHONE NUMBER" required>
                <br>
                <button type="submit" class="submit__button">SEND</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
