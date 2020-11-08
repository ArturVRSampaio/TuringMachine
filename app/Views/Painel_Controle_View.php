<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<body>

<!-- CONTENT -->



<form id="Controle">
  <div class="form-group">
    <label for="Script">Script</label>
    <input class="form-control" id="Script" placeholder="Script">
  </div>
  <div class="form-group">
    <label for="Entrada">Entrada</label>
    <input class="form-control" id="Entrada" placeholder="Entrada">
  </div>
</form>
<button type="button" id="btnEnviar" onclick="Enviar()" class="btn btn-primary">Enviar</button>

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
