<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>
<body>

<!--  -->
<div class="row mb-4 ml-2">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3 class= "mb-4">
				Máquina de Turing
			</h3>
			<div class="mb-2">
				<p>
					A Máquina de Turing é um dispositivo teórico conhecido como máquina universal, que foi concebido pelo matemático britânico Alan Turing (1912-1954), muitos anos antes de existirem os modernos computadores digitais (o artigo de referência foi publicado em 1936). Num sentido preciso, é um modelo abstrato de um computador, que se restringe apenas aos aspectos lógicos do seu funcionamento (memória, estados e transições), e não a sua implementação física. Numa máquina de Turing pode-se modelar qualquer computador digital.
				</p>
				<p>
					Turing também se envolveu na construção de máquinas físicas para quebrar os códigos secretos das comunicações alemãs durante a Segunda Guerra Mundial, tendo utilizado alguns dos conceitos teóricos desenvolvidos para o seu modelo de computador universal.
				</p>
			</div>
			<img src="https://i.imgur.com/TCmiUP7.jpg" class="w-50 rounded mb-4" alt="Responsive image">
			
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
<div class="row ml-2 mb-4">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3 class= "mb-4">
				Alan Turing
			</h3>
			<img src="https://i.imgur.com/HTGuASO.png" class="w-25 rounded float-left mr-4" alt="Responsive image">
			<p>
			Alan Mathison Turing, o criador da Máquina de Turing foi um matemático, cientista da computação, lógico , criptoanalista, filósofo, e biólogo teórico inglês. Foi influente no desenvolvimento da ciência da computação e na formalização do conceito de algoritmo e computação com a máquina de Turing, desempenhando um papel importante na criação do computador moderno. Foi também pioneiro na inteligência artificial e na ciência da computação. É conhecido como o pai da computação.
			</p>
			<p>
			Aos 24 anos, consagrou-se com a projeção de uma máquina que, de acordo com um sistema formal, pudesse fazer operações computacionais. Mostrou como um simples sistema automático poderia manipular símbolos de um sistema de regras próprias. A máquina teórica de Turing pode indicar que sistemas poderosos poderiam ser construídos. Tornou possível o processamento de símbolos, ligando a abstração de sistemas cognitivos e a realidade concreta dos números. Isto é buscado até hoje por pesquisadores de sistemas com Inteligência Artificial (IA).
			</p>
			<p>
				<a class="btn" target="_blank" href="https://pt.wikipedia.org/wiki/Alan_Turing">Mais sobre »</a>
			</p>
			<blockquote class="blockquote">
				<p class="mb-2">
				“Sometimes it is the people no one can imagine anything of who do the things no one can imagine.”
				<br>
				<br>
				“Às vezes são as pessoas que ninguém imaginam que fazem as coisas que ninguém pode imaginar.”
				</p>
				<footer class="blockquote-footer">
					Alan Turing
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
		<div class="col-md-8 mb-4">
			<h3 class= "mb-4">
				Descrição técnica
			</h3>
			
			<p>
				<p class="font-weight-bold mb-0">
					Máquina de Turing com uma fita
				</p>
				<br>
				Mais formalmente, uma máquina de Turing (com uma fita) é perfeitamente definida como uma 7-upla <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/0f9db39ae7767d38935b8286de48b8ba6fa0373b">, onde:
					<ul class="list-group ml-5">
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/8752c7023b4b3286800fe3238271bbca681219ed"> É um conjunto finito de estados</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/9e1f558f53cda207614abdf90162266c70bc5c1e"> É um alfabeto finito de símbolos</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/4cfde86a3f7ec967af9955d0988592f0693d2b19"> É o alfabeto da fita (conjunto finito de símbolos)</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/baa662d061d25282ee121464d38bc961522e7219"> É o estado inicial</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/a94b130b695e9ebf9cee136d1f97070bc9ec9079"> É o símbolo branco (o único símbolo que se permite ocorrer na fita infinitamente em qualquer passo durante a computação)</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/9ada8f098adcf02f7a674d2a5f2dda5e4917881e"> É o conjunto dos estados finais</li>
						<li><img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/faa82ec3b8033978be41eaa3027d8a8c0dbd0d0c"> --> <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/d2ce6d14aa7a376847c7eff486f398d34ecff4f7"> É uma função parcial chamada função de transição, onde <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/3c0fb4bce772117bbaf55b7ca1539ceff9ae218c">  é o movimento para a esquerda e <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/53e574cc3aa5b4bf5f3f5906caf121a378eef08b">  é o movimento para a direita.</li>
					</ul>
					<br>
					Definições na literatura às vezes diferem um pouco, para tornar argumentos ou provas mais fáceis ou mais claras, mas isto é sempre feito de maneira que a máquina resultante tem o mesmo poder computacional. Por exemplo, mudar o conjunto <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/e79e640083498f25c054489067b6deb5a1278d8b"> para <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/8d391723e68afd5ea0074ac7eda41a0a2b30f387">, onde P permite ao cabeçote permanecer na mesma célula da fita em vez de mover-se para a esquerda ou direita, não aumenta o poder computacional da máquina, pois é possível simular o movimento P com o movimento sequenciado de <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/3c0fb4bce772117bbaf55b7ca1539ceff9ae218c">  e <img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/53e574cc3aa5b4bf5f3f5906caf121a378eef08b">  o que mantém o cabeçote no mesmo lugar.
			</p>
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
