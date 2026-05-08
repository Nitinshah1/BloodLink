<?php
include 'config.php';

// PHPMailer Files Include
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $b_group = $_POST['b_group'];
    $hospital = mysqli_real_escape_string($conn, $_POST['hospital']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    // 1. Database mein Request Save karo
    $sql = "INSERT INTO blood_requests (patient_name, blood_group, hospital_name, city, contact_no, message) 
            VALUES ('$p_name', '$b_group', '$hospital', '$city', '$contact', '$msg')";
    
    if(mysqli_query($conn, $sql)){
        
        // 2. Matching Donors dhoondo (Same Blood Group + Same City)
       $donor_query = "SELECT email FROM donors WHERE blood_group = '$b_group' AND LOWER(TRIM(city)) = LOWER(TRIM('$city'))";
        $donor_result = mysqli_query($conn, $donor_query);

// Ye query case-insensitive hai (Capital/Small ka farq nahi padega)



        if(mysqli_num_rows($donor_result) > 0) {
            $mail = new PHPMailer(true);
            try {
                // SMTP Setup
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'wa411349@gmail.com'; // APNI EMAIL ID
                $mail->Password   = 'rtnj zkeq espz nurr';    // APNA APP PASSWORD
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('wa411349@gmail.com', 'BloodLink Emergency');

              
                
                // Add all donors in BCC for security and speed
                while($donor = mysqli_fetch_assoc($donor_result)) {
                    $mail->addBCC($donor['email']);
                }

                // Professional Responsive HTML Content
                $mail->isHTML(true);
                $mail->Subject = "🚨 EMERGENCY: $b_group Blood Required in $city";
                $mail->Body    = "
                    <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; border: 1px solid #eee; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>
                        <div style='text-align: center; border-bottom: 3px solid #c41e3a; padding-bottom: 15px;'>
                            <h2 style='color: #c41e3a; margin: 0; text-transform: uppercase;'>Emergency Alert</h2>
                            <p style='font-size: 0.85rem; color: #666; margin-top: 5px;'>BloodLink: Connecting Life Savers</p>
                        </div>
                        
                        <div style='padding: 20px 0;'>
                            <p style='font-size: 1.1rem;'>Hello <b>Lifesaver</b>,</p>
                            <p>An urgent blood request has been posted that matches your profile. Your immediate response could save a life.</p>
                            
                            <div style='background: #fff5f5; border-radius: 10px; padding: 20px; margin: 20px 0; border-left: 5px solid #c41e3a;'>
                                <p style='margin: 5px 0;'><b>Patient:</b> $p_name</p>
                                <p style='margin: 5px 0;'><b>Blood Group:</b> <span style='color: #c41e3a; font-weight: bold; font-size: 1.2rem;'>$b_group</span></p>
                                <p style='margin: 5px 0;'><b>Hospital:</b> $hospital, $city</p>
                                <p style='margin: 5px 0;'><b>Note:</b> $msg</p>
                            </div>

                            <div style='text-align: center; margin-top: 30px;'>
                                <a href='tel:$contact' style='display: block; background: #c41e3a; color: white; text-decoration: none; padding: 18px; border-radius: 8px; font-weight: bold; font-size: 1.1rem; box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);'>
                                    📞 Call Attendant: $contact
                                </a>
                                <p style='font-size: 0.8rem; color: #888; margin-top: 10px;'>Tap the button to call directly from your phone.</p>
                            </div>
                        </div>

                        <div style='font-size: 0.8rem; color: #999; border-top: 1px solid #eee; padding-top: 20px; text-align: center;'>
                            <p>This is an automated emergency notification from BloodLink. Please do not reply to this email.</p>
                            <p style='color: #c41e3a; font-weight: bold;'>Thank you for being a part of this mission.</p>
                        </div>
                    </div>
                ";

                $mail->send();
                $alert_msg = "Request Posted & Matching Donors Notified via Email!";
            } catch (Exception $e) {
                $alert_msg = "Request Posted but Email Alert failed. Error: {$mail->ErrorInfo}";
            }
        } else {
            $alert_msg = "Request Posted! (Note: No matching donors found in $city)";
        }

        echo "<script>alert('$alert_msg'); window.location='index.html';</script>";
    }
}
?>