<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Login | Mesa de Ayuda DTIC</title>

	<?php include('./header.php'); ?>
	<?php
	//if(isset($_SESSION['login_id']))
	//header("location:index.php?page=home");

	?>

</head>
<style>
	body {
		width: 100%;
		height: calc(100%);
		position: fixed;
		top: 0;
		left: 0;
		/* The background image will be set dynamically with JavaScript */
		background-size: cover;
	}

	main#main {
		width: 100%;
		height: calc(100%);
		display: flex;
	}
</style>

<body>

	<main id="main">

		<div class="align-self-center w-100">
			<h4 class="text-white text-center"><b>Mesa de Ayuda DTIC</b></h4>
			<center>
				<div id="login-center">
					<div class="card col-md-4">
						<div class="card-body">
							<form id="login-form">
								<div class="form-group">
									<label for="username" class="control-label text-dark">Usuario</label>
									<input type="text" id="username" name="username" class="form-control form-control-sm">
								</div>
								<div class="form-group">
									<label for="password" class="control-label text-dark">Contraseña</label>
									<input type="password" id="password" name="password" class="form-control form-control-sm">
								</div>

								<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Aceptar</button></center>
							</form>
						</div>
					</div>
				</div>
			</center>
		</div>
	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var images = [
				'./images/1.jpg',
				'./images/2.jpg',
				'./images/3.jpg',
				'./images/4.jpg',
				'./images/5.jpg'
			];
			var randomImage = images[Math.floor(Math.random() * images.length)];
			document.body.style.backgroundImage = 'url(' + randomImage + ')';
		});

		$('#login-form').submit(function(e) {
			e.preventDefault()
			$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
			if ($(this).find('.alert-danger').length > 0)
				$(this).find('.alert-danger').remove();
			$.ajax({
				url: 'ajax.php?action=login',
				method: 'POST',
				data: $(this).serialize(),
				error: err => {
					console.log(err)
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

				},
				success: function(resp) {
					if (resp == 1) {
						location.href = 'index.php?page=home';
					} else {
						$('#login-form').prepend('<div class="alert alert-danger">Usuario  o Contraseña Incorrecta.</div>')
						$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
					}
				}
			})
		})
		$('.number').on('input', function() {
			var val = $(this).val()
			val = val.replace(/[^0-9 \,]/, '');
			$(this).val(val)
		})
	</script>
</body>

</html>