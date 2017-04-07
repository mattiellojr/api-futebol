<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JSON API</title>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" type></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>


<?php 
        #CURL UFC

        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, "http://ufc-data-api.ufc.com/api/v1/us/events"); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        $output = curl_exec($ch); 

        curl_close($ch);  
?>

	<section class="container">
		<article class="row">
			<div class="col-lg-12">
				<h2>JSON UFC</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Arena</th>
							<th>Título</th>
							<th>Data</th>
							<th>Local</th>
							<th>Luta Principal</th>
						</tr>
					</thead>
					<tbody id="body-ufc">
						
					</tbody>
				</table>			
			</div>
			<div class="col-lg-12">
				<h2>JSON Futebol</h2>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Time 1</th>
							<th>Time 2</th>
							<th>Data</th>
						</tr>
					</thead>
					<tbody id="body-foot">
						
					</tbody>
				</table>
			</div>
		</article>
	</section>

	<script>
		var ufcData = <?php echo $output; ?>;

	</script>
	<script src="script.js"></script>
</body>
</html>

