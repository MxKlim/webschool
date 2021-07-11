<?php

$name = $_POST['name'];
$phone = $_POST['phone']; 

function TranslitURL ($text, $translit = 'ru_en') { 
	$RU['ru'] = array( 
		'Ё', 'Ж', 'Ц', 'Ч', 'Щ', 'Ш', 'Ы',  
		'Э', 'Ю', 'Я', 'ё', 'ж', 'ц', 'ч',  
		'ш', 'щ', 'ы', 'э', 'ю', 'я', 'А',  
		'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И',  
		'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',  
		'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ъ',  
		'Ь', 'а', 'б', 'в', 'г', 'д', 'е',  
		'з', 'и', 'й', 'к', 'л', 'м', 'н',  
		'о', 'п', 'р', 'с', 'т', 'у', 'ф',  
		'х', 'ъ', 'ь', '/'
		); 

	$EN['en'] = array( 
		"Yo", "Zh",  "Cz", "Ch", "Shh","Sh", "Y'",  
		"E'", "Yu",  "Ya", "yo", "zh", "cz", "ch",  
		"sh", "shh", "y'", "e'", "yu", "ya", "A",  
		"B" , "V" ,  "G",  "D",  "E",  "Z",  "I",  
		"J",  "K",   "L",  "M",  "N",  "O",  "P",  
		"R",  "S",   "T",  "U",  "F",  "Kh",  "''", 
		"'",  "a",   "b",  "v",  "g",  "d",  "e",  
		"z",  "i",   "j",  "k",  "l",  "m",  "n",   
		"o",  "p",   "r",  "s",  "t",  "u",  "f",   
		"h",  "''",  "'",  "-"
		); 
	if($translit == 'en_ru') { 
		$t = str_replace($EN['en'], $RU['ru'], $text);         
		$t = preg_replace('/(?<=[а-яё])Ь/u', 'ь', $t); 
		$t = preg_replace('/(?<=[а-яё])Ъ/u', 'ъ', $t); 
		} 
	else {
		$t = str_replace($RU['ru'], $EN['en'], $text);
		$t = preg_replace("/[\s]+/u", "_", $t); 
		$t = preg_replace("/[^a-z0-9_\-]/iu", "", $t); 
		$t = strtolower($t);
		}
	return $t; 
}	

    $title = $name;
    $url = TranslitURL($title); //, 'en_ru'


$token = "1220181511:AAGXbI-eDNtH7jsqNsdlkvf01aMa8DtmPCU";
$chat_id = "-404010974";
$arr = array(
  'Пользователь: ' => $url,
  'Телефон: ' => $phone
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  header('Location: Thanks.html');
} else {
  echo "Error";
}
?>