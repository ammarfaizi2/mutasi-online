<!DOCTYPE html>
<html manifest="cache_manifest.php">
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<title>Login</title>
	<style type="text/css">
		.qw{
			display: inline-block;
		}
		.za{
			margin-left:10%;
			padding-right: -10%;
		}
		.ui{
			margin-left: -14%;
			margin-right: -10%;
		}
		.uius {
			vertical-align: middle;
		}
		input[type=text], input[type=password]{
			margin-right: -10%;
		}
	</style>
</head>
<body>
<center>
	<div class="login-page">
		<div class="form">
			<div>
				<img src="assets/logo.jpg" width="170" height="150">
			</div>
			<div>
				<h2 style="font-family:Helvetica;">SELAMAT DATANG DI APLIKASI MUTASI ONLINE</h2>
			</div>
			<form class="login-form" method="post" action="">
			<p>
				<div class="qw ui"><label for="username"><img class="uius" src="assets/user.png" width="30" height="30"></label></div>
				<div class="qw za"><input type="text" name="username" placeholder="Username" size="34" required></div>
			</p>
			<p>
				<div class="qw ui"><label for="username"><img class="uius" src="assets/password.png" width="30" height="30"></label></div>
				<div class="qw za"><input type="password" name="password" placeholder="Password" size="34" required></div>
			</p>
				<button name="login">Login</button>
			</form>
		</div>
	</div>
</center>
</body>
</html>