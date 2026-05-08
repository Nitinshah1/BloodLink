<?php
// Autoload ki jagah manually 3 main files load kar rahe hain
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form se data uthaya
    $name  = isset($_POST['name']) ? $_POST['name'] : 'No Name';
    $email = isset($_POST['email']) ? $_POST['email'] : 'No Email';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : 'No Phone';
    $msg   = isset($_POST['msg']) ? $_POST['msg'] : 'No Message';

    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'helpbloodlink@gmail.com'; // Aapka Gmail
        $mail->Password   = 'edyw qfxt yzqt xehb';   // Aapka App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email Details
        $mail->setFrom('helpbloodlink@gmail.com', 'BloodLink System'); // Kahan se ja rahi hai
        $mail->addAddress('wa411349@gmail.com');             // Aapko yahan milega

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Inquiry from $name";
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; border-radius: 10px;'>
                <h2 style='color: #c41e3a;'>New Inquiry - BloodLink</h2>
                <hr>
                <p><b>Name:</b> $name</p>
                <p><b>Email:</b> $email</p>
                <p><b>Phone:</b> $phone</p>
                <p><b>Message:</b></p>
                <p style='background: #f9f9f9; padding: 10px; border-radius: 5px;'>$msg</p>
                <hr>
                <small>Sent from BloodLink Website Contact Form</small>
            </div>
        ";

        $mail->send();
        echo "<script>alert('Message Sent Successfully!'); window.location.href='contact.php';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Agar koi direct file access kare toh wapas bhej do
    header("Location: contact.php");
}
?>