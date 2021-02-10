$(function () {	 
	// Carregar formulário modal
	$('.open-popup').on('click', function () {
		var btn = $(this);
		var url = btn.data('target');
		var modalTarget = btn.data('modal-target');
		$('#results').removeClass().addClass().html('');
		
		$.ajax({
			url: url,
			type: 'POST',
			success: function (html) {
				$('body').append(html);
				$(modalTarget).modal('show');
				$('.form')[0].reset();
			}
		});

		return false;
	});

	// Adicionar e Atualizar
	$(document).on('click', '.submit-btn', function (event) {

		event.preventDefault();

		var btn = $(this);
		var form = btn.parents('.form');
		var url = form.attr('action');
		var data = new FormData(form[0]);

		var formResults = form.find('#results');

		$.ajax({
			url: url,
			type: 'POST',
			data: data,
			dataType: 'json',
			beforeSend: function () {
				formResults.removeClass().addClass('alert alert-info').html('Aguarde processando...');
			},
			success: function (results) {
				if (results.errors) {
					formResults.removeClass().addClass('alert alert-danger').html(results.errors);
				} else if (results.success) {
					formResults.removeClass().addClass('alert alert-success').html(results.success);
				}

				if (results.redirectTo) {
					window.location.href = results.redirectTo;
				}

			},
			cache: false,
			processData: false,
			contentType: false,
		});
	});

	// Excluir 
	$('.delete').on('click', function (event) {
		event.preventDefault();

		button = $(this);
		swal({
			title: 'Você tem certeza?',
			text: "Será realizada a exclusão do sistema!",
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Confirmar',
			cancelButtonText: 'Cancelar',
			confirmButtonClass: 'btn btn-success margin-5',
			cancelButtonClass: 'btn btn-danger margin-5',
			buttonsStyling: false
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: button.data('target'),
					type: 'POST',
					dataType: 'json',
					beforeSend: function () {
						// $('#del-results').removeClass().addClass('alert alert-info').html('Aguarde Processando...');
					},
					success: function (results) {
						if (results.success) {
							$('#del-results').removeClass().addClass().html('');

							toastr.success(results.success);

							tr = button.parents('tr');

							tr.fadeOut(function () {
								tr.remove();
							});
						}
					}
				});
			} else {
				toastr.info("Informação: operação cancelada");
			}
		});


	});
});
