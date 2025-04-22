<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function getEmailContent($filePath, $variables = [])
{
    global $basePath2;

    // Start output buffering to capture the output of included PHP file
    ob_start();
    
    // Extract the variables to be used in the included file
    extract($variables);

    // Include the email body PHP file
    include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . '/views/emails/' . $filePath. ".php");

    // Get the content of the output buffer
    return ob_get_clean();
}

function sendEmail($receiver, $subject, $filePath, $variables = [])
{

    //example email
    // sendEmail('izmeera2000@gmail.com', "Add New", 'booking_success');

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP:: DEBUG_OFF;
        $mail->Host = 'selama.e-veterinar.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['email8_username'];
        $mail->Password = $_ENV['email8_password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // From and To addresses
        $mail->setFrom('info@selama.e-veterinar.com', 'Selama Tourism');
        $mail->addAddress($receiver);

        // Get the email body content from the specified PHP file
        $emailBodyContent = getEmailContent($filePath, $variables);

        // Attach file if present
        if (!empty($variables['attachment'])) {
            $mail->addAttachment($variables['attachment'], $variables['attachment_name']);
        }

        // Set email format and content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $emailBodyContent; // Set the email body from the PHP file content

        // Provide alternative plain text for non-HTML clients
        $mail->AltBody = strip_tags($emailBodyContent);

        // Send the email
        $mail->send();
        // echo 'Message has been sent'; // Optional: Uncomment for debugging
    } catch (Exception $e) {
        // Log or display error message
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

