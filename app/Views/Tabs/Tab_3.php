<div>
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
