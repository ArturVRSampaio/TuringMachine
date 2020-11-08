<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>
<body>

<!-- CONTENT -->
<div class="container-fluid mt-4 mb-4">
	<a  type="button" class="btn btn-primary" 
	href="<?php echo base_url();?>/controle">
	Ir para o painel de entrada</a>
</div>

<!--  -->
<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3 class= "mb-4">
				Máquina de Turing
			</h3>
			<div class="mb-5">
				<p>
					A Máquina de Turing é um dispositivo teórico conhecido como máquina universal, que foi concebido pelo matemático britânico Alan Turing (1912-1954), muitos anos antes de existirem os modernos computadores digitais (o artigo de referência foi publicado em 1936). Num sentido preciso, é um modelo abstrato de um computador, que se restringe apenas aos aspectos lógicos do seu funcionamento (memória, estados e transições), e não a sua implementação física. Numa máquina de Turing pode-se modelar qualquer computador digital.
				</p>
				<p>
					Turing também se envolveu na construção de máquinas físicas para quebrar os códigos secretos das comunicações alemãs durante a Segunda Guerra Mundial, tendo utilizado alguns dos conceitos teóricos desenvolvidos para o seu modelo de computador universal.
				</p>
			</div>

			<h5>
				Descrição informal
			</h5>
			<div>
				<p>
					Uma máquina de Turing consiste em:
					<ul class="list-inline">
						<li class="ml-4">1. Uma fita que é dividida em células, uma adjacente à outra. Cada célula contém um símbolo de algum alfabeto finito. O alfabeto contém um símbolo especial branco (aqui escrito como ¬) e um ou mais símbolos adicionais. Assume-se que a fita é arbitrariamente extensível para a esquerda e para a direita, isto é, a máquina de Turing possui tanta fita quanto é necessário para a computação. Assume-se também que células que ainda não foram escritas estão preenchidas com o símbolo branco.</li>
						<br>
						<li class="ml-4">2. Um cabeçote, que pode ler e escrever símbolos na fita e mover-se para a esquerda ou para a direita.</li>
						<br>
						<li class="ml-4">3. Um registrador de estados, que armazena o estado da máquina de Turing. O número de estados diferentes é sempre finito e há um estado especial denominado estado inicial com o qual o registrador de estado é inicializado.</li>
						<br>
						<li class="ml-4">4. Uma tabela de ação (ou função de transição) que diz à máquina que símbolo escrever, como mover o cabeçote (para esquerda e para a direita) e qual será seu novo estado, dados o símbolo que ele acabou de ler na fita e o estado em que se encontra. Se não houver entrada alguma na tabela para a combinação atual de símbolo e estado então a máquina para.</li>
					</ul>
					<p>
						Note que cada parte da máquina é finita e sua quantidade de fita potencialmente ilimitada dá uma quantidade ilimitada de espaço de memória.
					</p>
				</div>
				<a class="btn" target="_blank" href="https://pt.wikipedia.org/wiki/M%C3%A1quina_de_Turing">Link de Referência »</a>
			</p>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>
<!--  -->


<!--  -->
<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3>
				h3. Lorem ipsum dolor sit amet.
			</h3>
			<h2>
				Heading
			</h2>
			<p>
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
			<blockquote class="blockquote">
				<p class="mb-0">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
				</p>
				<footer class="blockquote-footer">
					Someone famous in <cite>Source Title</cite>
				</footer>
			</blockquote>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>
<!--  -->


<!--  -->
<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3>
				h3. Lorem ipsum dolor sit amet.
			</h3>
			<h2>
				Heading
			</h2>
			<p>
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
			<blockquote class="blockquote">
				<p class="mb-0">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
				</p>
				<footer class="blockquote-footer">
					Someone famous in <cite>Source Title</cite>
				</footer>
			</blockquote>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>
<!--  -->


<?= $this->include('Footer') ?>

<!-- SCRIPTS -->
<script>


</script>
<!-- -->

</body>
</html>
