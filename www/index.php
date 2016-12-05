<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	

</head>
<body>
	<div class="container">
		<h1>Formulario de exemplo</h1>
		<form action="h_aula1.php" method="post">
			<input type="hidden" value="c" name="op" />
			<div class="form-group col-md-6">
				<label for ="name">Nr Aluno </label>
				<input type="text" class="form-control" placeholder="Introduza o seu n&uacute;mero" name="nr_aluno" />
			</div>
			  <div class="form-group col-md-6">
				<label for="nome">Nome</label>
				<input type="nome" name="nome" class="form-control" id="exampleInputEmail1" placeholder="Nome">
			  </div>
			  <div class="form-group col-md-6">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>
			  <div class="form-group col-md-6">
				<label for="exampleInputEmail1">Telefone</label>
				<input type="text" name="telefone" class="form-control" id="telefone" placeholder="Contacto">
			  </div>
			<input type="submit" value="Enviar" class="btn btn-primary" style="margin-left: 100px"  />
		</form>
	</div>
	
</body>
</html>
