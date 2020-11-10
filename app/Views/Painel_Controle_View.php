<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>
<body>

<!-- CONTENT -->



<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<form name="Controle" role="form" id="Controle">

				<div class="form-group">					 
                  <label for="Estados">Estados</label>
                  <input name="Estados" class="form-control" id="Estados" placeholder="Estados">
                </div>

                <div class="form-group">
                  <label for="FitaEntrada">FitaEntrada</label>
                  <input name="FitaEntrada" class="form-control mb-4" id="FitaEntrada" placeholder="FitaEntrada">
                </div>

                <div class="form-group">
                  <label for="TamanhoFita">TamanhoFita</label>
                  <input name="TamanhoFita" class="form-control mb-4" id="TamanhoFita" placeholder="TamanhoFita">
                </div>
                
			</form>
            <button type="button" id="btnEnviar" onclick="Enviar()" class="btn btn-primary  mb-5">Enviar</button>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>


<div class="container-fluid mb-4">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				
				
				<div class="col-md-6">

					<h3>
						Saida de dados
					</h3>
                    <br>
                    <h3>
						Maquina
					</h3>
					<dl>
						<dt>
							Description lists
						</dt>
						<dd>
							A description list is perfect for defining terms.
						</dd>
						<dt>
							Euismod
						</dt>
						<dd>
							Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
						</dd>
						<dd>
							Donec id elit non mi porta gravida at eget metus.
						</dd>
						<dt>
							Malesuada porta
						</dt>
						<dd>
							Etiam porta sem malesuada magna mollis euismod.
						</dd>
						<dt>
							Felis euismod semper eget lacinia
						</dt>
						<dd>
							Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
						</dd>
					</dl>
				</div>



				<div class="col-md-6 mt-5">
                <br>
					<h3>
						Estados
					</h3>
					<dl>
						<dt>
							Description lists
						</dt>
						<dd>
							A description list is perfect for defining terms.
						</dd>
						<dt>
							Euismod
						</dt>
						<dd>
							Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
						</dd>
						<dd>
							Donec id elit non mi porta gravida at eget metus.
						</dd>
						<dt>
							Malesuada porta
						</dt>
						<dd>
							Etiam porta sem malesuada magna mollis euismod.
						</dd>
						<dt>
							Felis euismod semper eget lacinia
						</dt>
						<dd>
							Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
						</dd>
					</dl>
				</div>
			
			
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>



<?= $this->include('Footer') ?>


<!-- SCRIPTS -->
<script type= 'text/javascript'>

function Enviar()
{
    $('#btnEnviar').text('Enviando...'); //change button text
    $('#btnEnviar').attr('disabled',true); //set button disable 
    var url;

   
	url = "<?php echo site_url('Painel_Controle/Controle')?>";
 
 
    $.ajax({
        url : url,
        type: "POST",
        data: $('#Controle').serialize(),
        dataType: "JSON",
        success: function(data)
        {
			if(data.status)
            {
				window.location.href = "<?php echo base_url();?>/saida/";
            }
            else
            {
				// Houve falha na chamada ajax. Exibir mensagem de erro
                $('#crudVeiculo .form-group').removeClass('has-error');
                $('#crudVeiculo .help-block').text('');
				$('#general-error').removeClass('bg-danger');
				$('#general-error').text('');
				if(data.inputerror)
				{
					// se foi um erro de validação de campos
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				if(data.generalerror)
				{
					// se foi um erro generalizado
					$('#general-error').addClass('bg-danger');
					$('#general-error').text(data.generalerror);
				}
            }
 
            $('#btnEnviar').text('Enviar'); //change button text
            $('#btnEnviar').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnEnviar').text('Enviar'); //change button text
            $('#btnEnviar').attr('disabled',false); //set button enable 
 
        }
    });
}





</script>
<!-- -->

</body>
</html>
