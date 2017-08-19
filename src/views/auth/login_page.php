<!DOCTYPE html>
<html>
<head>
	<title>Mutasi Online</title>
	<style type="text/css">
		.fcg {
			margin-top: 10%;
		}
		.iicg {
			margin-top: 1%;
		}
		.icg {
			margin-top: 2%;
		}
	</style>
</head>
<body>
<center>
	<div class="fcg">
	<form action="" method="post">
		<div class="iicg">
			<div>
				<label>Username</label>
			</div>
			<div>
				<input type="text" name="username">
			</div>
		</div>
		<div class="iicg">
			<div>
				<label>Password</label>
			</div>
			<div>
				<input type="password" name="password">
			</div>
		</div>
		<div class="icg">
			<input type="hidden" name="compare" value="<?php print $compare; ?>">
			<input type="hidden" name="ckey" value="<?php print $ckey; ?>">
			<input type="submit" name="login" value="Login">
		</div>
	</form>
	</div>
</center>
</body>
</html>