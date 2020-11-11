<!DOCTYPE html>


<?= $this->include('Base_View') ?>
<?= $this->include('NavBar') ?>

<body>

<ul class="nav nav-tabs md-12 d-flex justify-content-center">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#home">Home</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu1">menu1</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu2">menu2</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu3">menu3</a>
	</li>
</ul>

<div class="container">

  <div class="tab-content">
    <div id="home" class="tab-pane active">
			<div>
			<?= $this->include('Tabs/Home') ?>
			</div>
      	</div>
<!--SEPARACAO-->
	<div id="menu1" class="tab-pane fade">
			<h3>Menu 1</h3>
	      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</div>
<!--SEPARACAO-->	
	<div id="menu2" class="tab-pane fade">
	      <h3>Menu 2</h3>
	      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
<!--SEPARACAO-->
	<div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
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
