console.log(ufcData);


$.ajax({
	url: 'http://api.football-data.org/v1/competitions',
	dataType: 'json',
	type: 'GET',
}).done(function(response) {
	console.log(response);
});

$.ajax({
  headers: { 'X-Auth-Token': 'a48fda37e7f64616a1b61b61b3b66cfc' },
  url: 'http://api.football-data.org/v1/competitions',
  dataType: 'json',
  type: 'GET',
}).done(function(response) {
	console.log(response);
}); 
