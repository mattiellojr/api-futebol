var api = (function() {
	var init = function () {
		$('#form-api').off().on({
			'submit' : function () {
				var data = $(this).serialize();

				api.submitForm(data);
				return false;
			}
		});
	};

	var submitForm = function (data) {
		$.ajax({
			type : 'POST',
			url : 'consultaEventos.php',
			json : true,
			cache : false,
			dataType : 'jsonp',
			data : data,
			jsonp : 'events'
		}).done(function (response) {
			$('.api-result').JSONView(response);
		});
	};

	return {
		init : function () {
			init();
		},
		submitForm : function (data) {
			submitForm(data);
		}
	}
}());

api.init();
