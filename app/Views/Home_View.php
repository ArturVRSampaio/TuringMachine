<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>

<body>

<ul class="nav nav-tabs md-12 d-flex justify-content-center">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#home">Home</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu1">Turing e sua Máquina</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu2">A Matemática</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu3">menu3</a>
	</li>
</ul>

<div class="container">

  <div class="tab-content">
  <!--TAB 1-->
    <div id="home" class="tab-pane active">
		<div class= "mt-4">
			<?= $this->include('Tabs/Tab_1') ?>
		</div>
    </div>
<!--TAB 2-->
	<div id="menu1" class="tab-pane fade">
		<div class= "mt-4">
			<?= $this->include('Tabs/Tab_2') ?>
		</div>
			
	</div>
<!--TAB 3-->	
	<div id="menu2" class="tab-pane fade">
		<div class= "mt-4">
			<?= $this->include('Tabs/Tab_3') ?>
		</div>
    </div>
<!--TAB 4-->
	<div id="menu3" class="tab-pane fade">
		<div class= "mt-4">
			<?= $this->include('Tabs/Tab_4') ?>
		</div>
    </div>
<!--SEPARACAO-->
	</div>
</div>


<?= $this->include('Footer') ?>

<!-- SCRIPTS -->
<script>


</script>
<!-- -->

</body>
</html>
