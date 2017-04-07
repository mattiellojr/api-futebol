var contentUfc = [];

_.map(ufcData, function (obj, key) {
	contentUfc.push(
		'<tr>',
		'<td>' + obj.arena + '</td>',
		'<td>' + obj.base_title + '</td>',
		'<td>' + obj.event_date + '</td>',
		'<td>' + obj.location + '</td>',
		'<td>' + obj.title_tag_line + '</td>',
		'</tr>'
	);
});

$('#body-ufc').html(contentUfc.join(''));

$.ajax({
  headers: { 'X-Auth-Token': 'a48fda37e7f64616a1b61b61b3b66cfc' },
  url: 'http://api.football-data.org/v1/fixtures',
  dataType: 'json',
  type: 'GET',
}).done(function(response) {
	var contentFoot = [],
		result = response.fixtures;


	_.map(result, function (obj, key) {
		console.log(obj);
		contentFoot.push(
			'<tr>',
				'<td>' + obj.homeTeamName + '</td>',
				'<td>' + obj.awayTeamName + '</td>',
				'<td>' + obj.date + '</td>',
			'<tr>'
		);
	});

	$('#body-foot').html(contentFoot.join(''));
}); 
