<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>

<body class="clearfix">

	<!-- CONTENT -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<div class=mt-4>
					<?= $this->include('Tabs/Tab_4') ?>
				</div>
				<form name="Controle" role="form" id="Controle">

					<div class="form-group">
						<label for="Estados">Estados</label>
						<textarea name="Estados" class="form-control" id="Estados" placeholder="Estados"></textarea>
						<span class="help-block"></span>
					</div>

					<div class="row">
						<div class="col md-5 col-xs-12">
							<label for="FitaEntrada">FitaEntrada</label>
							<input name="FitaEntrada" class="form-control" id="FitaEntrada" placeholder="FitaEntrada">
							<span class="help-block"></span>
						</div>

						<div class="col-md-5 col-xs-12">
							<label for="TamanhoFita">TamanhoFita</label>
							<input name="TamanhoFita" class="form-control" type="number" min="20" max="10000" step="10" value="30" id="TamanhoFita" placeholder="TamanhoFita">
							<span class="help-block"></span>
						</div>
					</div>

				</form>
				<button type="button" id="btnEnviar" onclick="Enviar()" class="btn btn-primary  mb-5 mt-4">Enviar</button>
			</div>
			<div class="col-md-1">
			</div>
		</div>
	</div>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="col-md-12 mt-5">

						<div class="float-center">
							<h3>Saida de dados</h3>
						</div>
						<div class="float-right">
							<!-- <input  type="checkbox" checked data-toggle="toggle" data-on="aceita" data-off="Nao Aceita" data-onstyle="success" data-offstyle="danger"> -->
							<div class="information-container">
								<span id="SaidaAceita" class="saida-text"></span>
							</div>

						</div>
						<textarea name="SaidaDados" class="form-control" id="SaidaDados" placeholder="SaidaDados" disabled></textarea>

					</div>

				</div>
			</div>
			<div class="col-md-1">
			</div>
		</div>
	</div>

	<?= $this->include('Footer') ?>


	<!-- SCRIPTS -->
	<script type='text/javascript'>
		function Enviar() {
			$('#btnEnviar').text('Enviando...'); //change button text
			$('#btnEnviar').attr('disabled', true); //set button disable 
			var url;


			url = "<?php echo site_url('Painel_Controle/Controle') ?>";


			$.ajax({
				url: url,
				type: "POST",
				data: $('#Controle').serialize(),
				dataType: "JSON",
				success: function(data) {
					if (data.status) {
						fita = "";
						for (var x in data[0][0]) {
							fita += data[0][0][x]
							fita += '\n'
						}

						$('[name="SaidaDados"]').val(fita);

						document.getElementById("SaidaAceita").innerHTML = data[0][1] ? 'Aceita' : "Não aceita";
						$('#SaidaAceita').addClass(data[0][1] ? 'aceita' : "nao-aceita")
						$('.information-container').fadeIn("slow");
						//document.getElementById("SaidaAceita").disabled = true ;
					} else {
						// Houve falha na chamada ajax. Exibir mensagem de erro
						$('#crudVeiculo .form-group').removeClass('has-error');
						$('#crudVeiculo .help-block').text('');
						$('#general-error').removeClass('bg-danger');
						$('#general-error').text('');
						if (data.inputerror) {
							// se foi um erro de validação de campos
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
								$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
							}
						}
						if (data.generalerror) {
							// se foi um erro generalizado
							$('#general-error').addClass('bg-danger');
							$('#general-error').text(data.generalerror);
						}
					}

					$('#btnEnviar').text('Enviar'); //change button text
					$('#btnEnviar').attr('disabled', false); //set button enable 


				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error adding / update data');
					$('#btnEnviar').text('Enviar'); //change button text
					$('#btnEnviar').attr('disabled', false); //set button enable 

				}
			});
		}
	</script>
	<!-- -->

	<style type="text/css">
		.saida-text {
			font-size: 16px;
			transition: all 1s;
		}

		.information-container {
			padding: 8px 16px;
			background-color: rgba(222, 222, 222, 0.5);
			border-radius: 16px;
			margin-bottom: 16px;
			display: none;
		}
	</style>

</body>

</html>