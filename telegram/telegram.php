<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$token = "2043511126:AAGFMs4cEYOvf0573IK43oCjKbL4yA3q5j8";
$chat_id = "-503602609";
$man_id = "681260687";
$arr = array(
  'Имя пользователя: ' => $name,
  'Телефон: ' => $phone,
  'Email' => $email,
  'Сообщение:' => $msg
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram2 = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$man_id}&parse_mode=html&text={$txt}","r");
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");


if ($sendToTelegram && $sendToTelegram2) {
  header('Location: thanks.html');
} else {
  echo "Error";
}
?>
