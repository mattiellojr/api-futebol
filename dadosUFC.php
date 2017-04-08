<?php
 	$url = 'http://ufc-data-api.ufc.com/api/v1/us/events';
	
	$rows = file_get_contents($url);

	foreach (json_decode($rows) as $key => $fight) {
		$eventDate = $fight -> event_date;
		$formattedDate = date_create($eventDate);
		$idEventManager = '';

		$keyEventId = array_search(trim("". $fight -> base_title . '- ' . $fight -> title_tag_line .""), array_column($arrayEvents, 'nome'));

		if ($keyEventId !== false) {
			$idEventManager = $arrayEvents[$keyEventId]['id'];
		}

		$item["evento"]["evento_id"] = $fight -> id;
		$item["evento"]["evento_nome"] =  $fight -> base_title. ' - ' . $fight -> title_tag_line; 
		$item["evento"]["evento_id_sistema"] = $idEventManager;
		$item["evento"]["data"] = date_format($formattedDate, 'd/m/Y');
		$item["evento"]["hora"] = date_format($formattedDate, 'H:i:s');
		$item["evento"]["timestamp"] = $eventDate; 
		$item["evento"]["id_participante_vencedor"] = ''; 
		$item["evento"]["nome_participante_vencedor"] = ''; 
		$item["categoria"]["categoria_id"] = '1'; 
		$item["categoria"]["categoria_nome"] = 'UFC';
		$item["participante1"]["nome"] = ''; 
		$item["participante1"]["placar"] = ''; 
		$item["participante1"]["id"] = ''; 
		$item["participante2"]["nome"] = ''; 
		$item["participante2"]["placar"] = ''; 
		$item["participante2"]["id"] = ''; 

		$arrayFights[] = $item;
	}


	$result = $arrayFights;
?>