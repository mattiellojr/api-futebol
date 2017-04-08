<?php
	require_once('includes/simple_html_dom.php');
	$newDate = str_replace('/', '-', $eventDate);

	$html =  file_get_html('http://globoesporte.globo.com/placar-ge/'.$newDate);
	$allGames = $html->find('section[class="secao-campeonato"]');

	foreach($allGames as $game) {
		$pastGames = $game->parent()->class;
		$homeTeam = $game->find('div.mandante span.nome-completo', 0)->plaintext;
		$guessTeam = $game->find('div.visitante span.nome-completo', 0)->plaintext; 
		$winnerTeam = "";
		$idWinner = "";
		$categoryName = $game->find('h1.titulo span', 0)->plaintext;
		$eventDate = $game->find('time', 0)->datetime;
		$formattedDate = date_create($eventDate);
		$homeScore = $game->find('span.placar-mandante', 0)->plaintext;
		$guessScore = $game->find('span.placar-visitante', 0)->plaintext;
		$idEventManager = "";
		$idHomeTeam = "";
		$idGuessTeam = "";
		$idCategoryTeam = "";


		$keyEventId = array_search(trim("".$categoryName . '- ' . $homeTeam . 'vs ' . $guessTeam.""), array_column($arrayEvents, 'nome'));
		$keyHomeTeam = array_search(trim("".$homeTeam.""), array_column($arrayParticipants, 'nome'));
		$keyGuessTeam = array_search(trim("".$guessTeam.""), array_column($arrayParticipants, 'nome'));
		$keyCategory = array_search(trim("".$categoryName.""), array_column($arrayCategories, 'nome'));

		if ($keyEventId !== false) {
			$idEventManager = $arrayEvents[$keyEventId]['id'];
		}

		if ($keyHomeTeam !== false) {
			$idHomeTeam = $arrayParticipants[$keyHomeTeam]['id'];
		}

		if ($keyGuessTeam !== false) {
			$idGuessTeam = $arrayParticipants[$keyGuessTeam]['id'];
		}

		if ($keyCategory !== false) {
			$idCategoryTeam = $arrayCategories[$keyCategory]['id'];
		}

		if (stripos($pastGames, 'passado')) {
			if ($homeScore > $guessScore) {
				$idWinner = $idHomeTeam;
				$winnerTeam = $homeTeam;
			} else if ($guessScore > $homeScore) {
				$idWinner = $idGuessTeam;
				$winnerTeam = $guessTeam;
			}
		}


		$item["evento"]["evento_id"] = $game->find('article', 0)->id;
		$item["evento"]["evento_nome"] = $categoryName . '- ' . $homeTeam . 'vs ' . $guessTeam; 
		$item["evento"]["evento_id_sistema"] = $idEventManager;
		$item["evento"]["data"] = date_format($formattedDate, 'd/m/Y');
		$item["evento"]["hora"] = date_format($formattedDate, 'H:i:s');
		$item["evento"]["timestamp"] = $eventDate; 
		$item["evento"]["id_participante_vencedor"] = $idWinner; 
		$item["evento"]["nome_participante_vencedor"] = $winnerTeam; 
		$item["categoria"]["categoria_id"] = $idCategoryTeam; 
		$item["categoria"]["categoria_nome"] = $categoryName;
		$item["participante1"]["nome"] = $homeTeam; 
		$item["participante1"]["placar"] = $homeScore; 
		$item["participante1"]["id"] = $idHomeTeam; 
		$item["participante2"]["nome"] = $guessTeam; 
		$item["participante2"]["placar"] = $guessScore; 
		$item["participante2"]["id"] = $idGuessTeam; 

		$arrayGames[] = $item;
	}

	$result = $arrayGames;
?>
