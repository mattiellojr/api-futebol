console.log(ufcData);


$.ajax({
	url: 'http://api.football-data.org/v1/competitions',
	dataType: 'json',
	type: 'GET',
}).done(function(response) {
	console.log(response);
});