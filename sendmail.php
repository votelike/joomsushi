<?
/***************************
 * Settings
 ***************************/
$ADMIN_EMAIL = "z_evgen@mail.ru";



$mail = $_POST["order"];
$subject = htmlentities($_GET["subj"]) . "/ Заказ (".date("d.m.Y h:i").")";

$mail = strip_tags($mail, "<b><div><table><tbody><tr><td><html><body><style><h1><th><br>");
$mail = str_replace("<td></td>", "",$mail);
$mail = preg_replace('/<div[^>]+class="basket_num_buttons"[^>]*>.*?<\/div>/i', '', $mail);
$mail = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $mail);

$template = "<html>
<style>
*
{ font-family: Arial;}
table
{ border-collapse: collapse; }
td
{ padding: 5px; border: 1px solid #000;}
th
{
background: #999; padding: 5px;
}

</style>
<body>
<h1>".$subject."</h1>
".$mail."</body></html>";

$template .= '<hr>' . $_SERVER['HTTP_REFERER'];

// Clear form


$head = "<tr><th>ID</th><th>Название</th><th>Цена</th><th>Кол-во</th><th>Всего</th></tr>";

$template = str_replace ( "<tbody>" ,"<tbody>".$head, $template);

/*******************************************
 * Send copy of letter to client mail				
 ******************************************/
if ( preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $template, $email) )
	{
	$client_mail = $email[0];  // @ $client_mail - email from form //
	$emails = $client_mail . ", " . $ADMIN_EMAIL; 
	}
	else
	{
	$emails = $ADMIN_EMAIL;	
	}


$domain = "webinside.ru";

$from = "no-reply@". $domain;
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$success = mail($emails, $subject, $template, $headers);
echo ($success) ? 'true' : 'false';
?>