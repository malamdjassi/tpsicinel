<?php
	session_start();
//	if (!isset($_SESSION['user']))
//		header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  <style type="text/css" media="screen">

    #editor {
/*        margin: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
*/
	height: 100px;
    }
  </style>

    <title>Question&aacute;rio de boas-vindas</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	
	<!-- Font: GrandHotel -->
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/grand-hotel" type="text/css"/> 

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container">
	<h1>Teste Diagn&oacute;stico</h1>
	<small>O objectivo das presentes perguntas &eacute; t&atilde;o somente de conhecer um pouco sobre si -- <strong>sem avalia&ccedil;&atilde; formal</strong></small>
	<form action="handler/handle_diag.php" method="post">
		<div class="form-group col-md-12">
			<label for ="name">Nome </label>
			<input type="text" placeholder="Introduza o seu nome" name="nome" />
		</div>
		<div class="form-group col-md-6">
			<label for="morada">Qual da seguinte destoa das demais?</label>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="java">Java
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1"  type="radio" value="c">C</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1"  type="radio" value="javascript">Javascript</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="python">Python</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="javascript">C++</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="pascal">Pascal</input>
					</label>
				</div>
			</div>
		<div class="form-group">
		    <label for="quest3">Numa linguagem de programação a seu gosto, elabore uma função/método que receba um parâmetro e devolva o factorial desse número.</label>
<p>
Factorial de:<br />
 4! = 4 x 3 x 2 x 1 = 24<br />
 6! = 6 x 5 x 4 x 3 x 2 x 1 = 720<br />
</p>
<div id="editor">function foo(items) {
    var x = "All this is syntax highlighted";
    return x;
}
</div>
		</div>
		<div class="form-group col-md-6">
			<label for="morada">Qual da seguinte figuras mais contribuiu para o desenvolvimento da inform&aacute;tica?</label>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="dennies">Dennies Ritchie
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1"  type="radio" value="bill_gates">Bill Gates</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1"  type="radio" value="mark_zuckerberg">Mark Zuckerberg</input>
					</label>
				</div>
				<div class="radio">
					<label>
					<input name="quest1" type="radio" value="steve_jobs">Stebe Jobs</input>
					</label>
				</div>
			</div>
		  </div>
		<div class="form-group">
		    <label for="quest3">Qual a função do DHCP numa rede de computadores?</label>
<textarea style="form-control" rows="3" name="quest3"></textarea>
</div>
		<div class="form-group">
		    <label for="quest4">Na sua opinião, que razões levam uma pessoa a optar por utilizar o MS Office, em detrimento de outras soluções?
</label>
<textarea style="form-control" rows="3" name="quest4"></textarea>
</div>
		<div class="form-group">
		    <label for="quest6">Em média quantas horas por semana investe a jogar no seu PC?
</label>
<input type="number" name="quest6" />
</div>

		<input type="submit" value="Enviar" class="btn btn-primary"  />
	</form>
	</div>
<script src="components/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
	var xtrabuttons = '';
	var coltab = "quest";

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/java");
    editor.setAutoScrollEditorIntoView(true);
    editor.setOption("maxLines", 30);

	onclickextra = function (e, value, row, index) {

	}
</script>
	<script src="js/jquery.form.min.js"></script> 
	<script src="js/godata.js"></script>
</body>
