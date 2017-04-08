<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Serviço de Consulta de dados do UFC e de Futebol</title>

		<script src="https://code.jquery.com/jquery-1.12.4.min.js" type></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.pt-BR.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jsonview/1.2.3/jquery.jsonview.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jsonview/1.2.3/jquery.jsonview.min.css">

	</head>
	<body>
		<section class="container">
			<article class="row">
				<section class="col-lg-12">
					<h1>API de captura de dados</h1>
					<form action="#" class="form" id="form-api" method="POST">
						<div class="form-group">
							<label for="event">Evento</label>
							<select name="event" id="event" class="form-control">
								<option value="2">Futebol</option>
								<option value="1">UFC</option>
							</select>
						</div>
						<div class="form-group">
							<label for="eventDate">Data</label>
							<input class="form-control" type="text" data-provide="datepicker" name="eventDate" data-date-autoclose="true" data-date-language="pt-BR" data-date-format="dd/mm/yyyy">
						</div>
						<button class="btn btn-primary" type="submit">SUBMETER DADOS</button>
					</form>
				</section>				
				<section class="col-lg-12">
					<h1>JSON</h1>
					<div class="panel panel-default">
						<div class="panel-heading">Resultado JSON</div>
						<div class="panel-body api-result" style="height: 500px; overflow: auto;"></div>
					</div>	
				</section>
			</article>
		</section>

		<script src="api.js" type="text/javascript"></script>
	</body>
</html>
