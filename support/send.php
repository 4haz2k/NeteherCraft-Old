<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/support/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';

// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$mail->Host = 'ssl://server251.hosting.reg.ru';
$mail->Port = 465;
$mail->Username = 'support@nethercraft.fun';
$mail->Password = '4Y1t2Y6r';

// От кого
$mail->setFrom('support@nethercraft.fun', 'NetherCraft Technical Support');

// Кому
$mail->addAddress('zytia@mail.ru', 'Alex Pavlov');

// Тема письма
$mail->Subject = "Тест записи";

// Тело письма
$body = '<p><strong>«Тест»</strong></p>';
$mail->msgHTML($body);

$mail->send();