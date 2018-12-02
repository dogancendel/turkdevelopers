<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>turkdevelopers</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Giris</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Kullanıcı Adı</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Sifre</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Giris</button>
		</div>
		<p>
			Henuz uye degil misiniz? <a href="register.php">Kaydol</a>
		</p>
	</form>


</body>
</html>