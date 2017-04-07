<?php 

function getimg($url) {         
// Auxilia a função download_image

    $headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';              
    $headers[] = 'Connection: Keep-Alive';         
    $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';         
    $user_agent = 'php';         
    $process = curl_init($url);         
    curl_setopt($process, CURLOPT_HTTPHEADER, $headers);         
    curl_setopt($process, CURLOPT_HEADER, 0);         
    curl_setopt($process, CURLOPT_USERAGENT, $useragent);         
    curl_setopt($process, CURLOPT_TIMEOUT, 30);         
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);         
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);         
    $return = curl_exec($process);         
    curl_close($process);         
    return $return;     
} 
function download_imagem($url, $imagename = "") {
//Download de uma imagem para o servidor
	
	if($imagename == "") $imagename = basename($url);
	if(file_exists('./imagens/'.$imagename)){return;} 
	$image = getimg($url); 
	file_put_contents('./imagens/'.$imagename,$image);
 return 0;
}

function hack_image($imagem, $imagem_redimensionada = "", $nova_largura = 100, $nova_altura = 0) {	
	if(!$imagem_redimensionada) $imagem_redimensionada = $imagem;
	list($largura, $altura) = getimagesize($imagem);
	if(!$nova_altura) $nova_altura = ($nova_largura * $altura) / $largura; // calcula a nova altura
	$image_p = imagecreatetruecolor($nova_largura, $nova_altura); $image = imagecreatefromjpeg($imagem);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
	imagejpeg($image_p, $imagem_redimensionada, 80);
	imagedestroy($image_p);
	//unlink($imagem);
}

function curl_file($url, $timeout=0) {
// Retorna o conteudo de um site

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$conteudo = curl_exec($ch);
	curl_close($ch);
	  
	return $conteudo;
  }

function extrai_texto ($busca_inicio, $busca_fim, $texto) {
// Extrai o texto de uma string e retorna em outra string

   $result = strstr($texto, $busca_inicio);

   $result = substr($result, strlen($busca_inicio));

   if ($busca_fim === 0) return $result;

   $result =  substr($result,0,strpos($result, $busca_fim));

   return $result;
}





function extrai_array ($busca_inicio, $busca_fim, $texto, $noRepeat = true) {
// Extrai o texto de um string e retorna em uma array
	$count = -1;
	$repetiu = false;
	$texto_novo = Array();

	do {
		if(!$repetiu) $count++;

		$texto_temp = extrai_texto($busca_inicio, $busca_fim, $texto);
              
		if($noRepeat) if(in_array($texto_temp, $texto_novo)) $repetiu = true; else $repetiu = false;
			    
		$texto_novo[$count] = $texto_temp;
 
 		$texto = substr($texto, strpos($texto, $busca_fim) + strlen($busca_fim));
                

	} while (strlen($texto_novo[$count])>1);

 	 return $texto_novo;
}

function play_audio($file) { 

	echo '<audio id="audio" autoplay><source src="' . $file . '" type="audio/mp3" /></audio>';

}

function formato_moeda($valor) {
  $valor = str_replace(".", "", $valor);
  $valor = str_replace(',', '.', $valor);
  return $valor;
}



//anti injection
function anti_injection($str){
// verifica se o valor da string é somente numérico 
	if (!is_numeric($str)) { 
//verifica se o magic_quotes está habilitado, se sim tira o escape da string, caso não mantem o valor digitado.
	$str = get_magic_quotes_gpc() ? stripslashes(strip_tags($str)) : $str;
// verifica se a função mysql_real_escape_string está habilitada, se sim roda ela, se não usa o mysql_escape_string	
	$str = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($str) : mysql_escape_string($str);
        $str = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$str); // remove palavras que contenham sintaxe sql
}
//retorna o valor
return addslashes($str);
}

function strtolower_es($string)
    {
        $low=array("Á" => "á", "É" => "é", "Í" => "í", "Ó" => "ó", "Ú" => "ú", "Ü" => "ü", "não" => "não","Ç" => "ç");
        return strtolower(strtr($string,$low));
    }

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
	$rand = mt_rand(1, $len);
	$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

function envia_email($emaildestinatario, $assunto, $mensagemHTML) {
$emailsender = 'nao-responder@rafael-oliveira.tempsites.ws';
 $headers .= "From: $emailsender\n";

if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . '\n'; // Se "não for Postfix"
    mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
}


}

if($_SERVER['REQUEST_URI'] == "/" || strpos($_SERVER['REQUEST_URI'] , "direita.php") !== false || strpos($_SERVER['REQUEST_URI'] , "esquerda.php") !== false || strpos($_SERVER['REQUEST_URI'] , "/sys/") !== false || strpos($_SERVER['REQUEST_URI'] , "index.php") !== false)  $_SESSION["ultima_pagina"] = "home.php"; else $_SESSION["pagina_atual"]  = $_SERVER['REQUEST_URI'];



?>
