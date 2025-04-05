<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function send_mail($result_text, $img_tag, $file_name){

    require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = "smtp.mail.ru";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->Username = "iliin2.pa@edu.spbstu.ru";
    $mail->Password = "password";
    $mail->From = "iliin2.pa@edu.spbstu.ru";
    $mail->FromName = "hryak228pizza";

    $mail->addAddress($_SESSION["email"]);
    $mail->isHTML(true);
    $mail->Subject = "Заказ принят!";
    $mail->AltBody = "This is the plain text version of the email content";
    
    $mail->AddAttachment($_SERVER["DOCUMENT_ROOT"] . '/pages/'.$file_name, $file_name);
    $mail->AddEmbeddedImage( $_SERVER["DOCUMENT_ROOT"].'/pages/img/'.$img_tag, 'image-src');
    $mail->Body = $result_text."<br>"."<img style='width: 200px; height: 200px;', src='cid:image-src'>";
    try {
        $mail->send();
        echo "Письмо отправлено";
    } catch (Exception $e) {
        echo "Письмо отправить не вышло, но мы старались: " . $mail->ErrorInfo;
    }
}
?>