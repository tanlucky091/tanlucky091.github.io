<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Include autoload.php file
require 'vendor/autoload.php';
// Create object of PHPMailer class
$mail = new PHPMailer(true);

$date=date("Y-m-d h:i:s");
$price=$_SESSION['price'];
$email=$_SESSION['email'];
$shipment_id = $_SESSION['shipment_id'];
$transaction_id = md5(shipment_id);

    try {
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        // Gmail ID which you want to use as SMTP server
        $mail->Username = 'xytan41@gmail.com';
        // Gmail Password
        $mail->Password = 'Tanxinyun0608';
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        // Email ID from which you want to send the email
        $mail->setFrom('xytan41@gmail.com');
        // Recipient Email ID where you want to receive emails
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Payment Receipt';
        $mail->Body = "Dear Customer,<br>Thank you for payment.<br>We are pleased to inform you that the following online payment is successful:<br><br><table>
        <tr>
			<td>Transaction id</td>
			<td>: $transaction_id</td>
		</tr>
		<tr>
			<td>Date & Time</td>
			<td>: $date</td>
		</tr>
		<tr>
			<td>Seller Name</td>
			<td>: YTG Logistic</td>
		</tr>
		<tr>
			<td>Shipment id</td>
			<td>: $shipment_id</td>
		</tr>
		<tr>
			<td>Transaction Amount (RM)</td>
			<td>: $price</td>
		</tr>
	</table>";

        $mail->send();
    } catch (Exception $e) {
        
    }

?>

