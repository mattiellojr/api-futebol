<?php
	$conecta = mysqli_connect("aposta.mysql.dbaas.com.br", "aposta", "apostas", "aposta") or print (mysqli_error()); 
	
	$event = $_POST['event'];
	$eventDate = $_POST['eventDate'];

	$sqlCategories = mysqli_query($conecta, "SELECT id, nome FROM categoria");
	while ($rowCategories = mysqli_fetch_array($sqlCategories)) {
		$arrayCategories[] = $rowCategories;
	}

	$sqlEvents = mysqli_query($conecta, "SELECT id, nome FROM evento");
	while ($rowEvents = mysqli_fetch_array($sqlEvents)) {
		$arrayEvents[] = $rowEvents;
	}

	$sqlParticipants = mysqli_query($conecta, "SELECT id, nome FROM participante");
	while ($rowParticipants = mysqli_fetch_array($sqlParticipants)) {
		$arrayParticipants[] = $rowParticipants;
	}


	switch ($event) {
		case '1':
			require_once('dadosUFC.php');
			break;	
		case '2':
			require_once('dadosFutebol.php');
			break;
	}

	$data = array(
		'result' => $result
	);

	echo $_GET['events']."(".json_encode($data).")";

	mysqli_close($conecta);
?>