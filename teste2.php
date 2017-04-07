<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Titulo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php

	$conecta = mysqli_connect("aposta.mysql.dbaas.com.br", "aposta", "apostas", "aposta") or print (mysqli_error()); 

	include "funcoes.php";

	$categorias = array();
	$participantes = array();

	$texto =  file_get_contents('http://globoesporte.globo.com/placar-ge/16-02-2017');

	// $sql = "SELECT id, nome FROM categoria";
	// $qr = mysqli_query($conecta, $sql) or die(mysqli_error());

	// $i = 0;
	// while ($ln = mysql_fetch_assoc($qr)) {
	// 	$categorias[$i] = $ln;
	// 	$i++;
	// }

	$sql = "SELECT id, nome FROM participante";
	$qr = mysqli_query($conecta, $sql) or die(mysqli_error());

	$i = 0;

	while ($ln = mysqli_fetch_assoc($qr)) {
		$participantes[$i] = $ln;
		$i++;
	}

	$jogo = extrai_array('<section class="secao-campeonato">','</section>', $texto, false);

	$c = 0;
	$campeonato_num = 0;

	$evento_novo = array();
	$evento_novo_i = 0;
	$evento_novo_i_muda = false;

	$participantes_sql = false;


	for($i=0;$i<count($jogo);$i++) {
		$participante_jogo = array();
		$participante_jogo = extrai_array('<span class="nome nome-completo" itemprop="name">','</span>', $jogo[$i], true);

		$categoria_escolhida = extrai_texto('<span itemprop="name">', '</span>', $jogo[$i]);

		$participantes_i = 0;
		$participantes_sql = false;


	// for($c=0;$c<count($categorias);$c++) {
	// 	if(stripos($categorias[$c]["nome"],$categoria_escolhida ) !== false) {
	// 	  $evento_novo[$evento_novo_i]["categoria_id"] = $categorias[$c]["id"];
	// 	  $evento_novo[$evento_novo_i]["categoria_nome"] = $categorias[$c]["nome"];
	// 	  $evento_novo_i_muda = true;
	//  }/* if */
	// } /* for c */

	for($c=0;$c<count($participante_jogo);$c++) {
	   for($c2=0;$c2<count($participantes);$c2++) {
		// if((stripos($participantes[$c2]["nome"], $participante_jogo[$c]) !== false) && (strlen($evento_novo[$evento_novo_i]["categoria_nome"])) > 1) {
		if((stripos($participantes[$c2]["nome"], $participante_jogo[$c]) !== false)) {

		// if ($evento_novo[$evento_novo_i] && $evento_novo[$evento_novo_i]["categoria_id"]) {
		// 	$sql = "SELECT id, nome FROM participante WHERE nome LIKE \"%".$participante_jogo[$c] ."%\"  AND id_categoria = " . $evento_novo[$evento_novo_i]["categoria_id"];
		// 	$qr = mysqli_query($conecta, $sql) or die(mysqli_error());
		// 	if(!mysqli_num_rows($qr)) break;
		// 	while($ln = mysqli_fetch_assoc($qr)) {
		// 		$evento_novo[$evento_novo_i]["participantes"][$participantes_i]["nome"] = $ln["nome"];
		// 		$evento_novo[$evento_novo_i]["participantes"][$participantes_i]["id"] = $ln["id"];
		// 		$participantes_i++;
		// 		$participantes_sql = true;
		// 		$evento_novo_i_muda = true;
		// 	} /* while */			
		// } /* if categoria id */
		if(!$participantes_sql) {
			$evento_novo[$evento_novo_i]["participantes"][$participantes_i]["nome"] = $participantes[$c2]["nome"];
			$evento_novo[$evento_novo_i]["participantes"][$participantes_i]["id"] = $participantes[$c2]["id"];
			$participantes_i++;
			$evento_novo_i_muda = true;
			$participantes_sql = false;
		} /* if participantes sql */
		} /* if  categoria*/
	  } /* for c2 */
	} /* for c */
	

	if($evento_novo_i_muda) { 
		$evento_novo_i++;
		$evento_i_muda = false;
	}

	if ($participante_jogo[0] && $participante_jogo[1]) {
		echo '<b> Data evento coletada : </b>'. 1 . '<br><br>';
		echo '<b> Categoria coletada : </b> ' . $categoria_escolhida . '<br><br>';
		echo '<br><br>';
		echo '<b> Participante coletado 1  : </b> ' . $participante_jogo[0] . '<br><br>';
		echo '<b> Participante coletado 2  : </b> ' . $participante_jogo[1] . '<br><br>';
		echo '<br><br><hr>';
	}


	} /* for i*/



?>
<h2> Eventos a serem criados </h2>
<?php

	echo '<pre>';
	print_r($evento_novo);
	echo '</pre>';
	mysql_close($conecta);
	?>
