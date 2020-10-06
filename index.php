<?php

$authname = isset($_POST['authname']) ? $_POST['authname'] : 'AuthName';
$accounts = [];
$accounts[] = ['name'=>($_POST['name'] ?? 'test'), 'password'=>($_POST['password'] ?? 'test')];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>.htpasswd generator</title>
	<meta name="description" content="Generate .htpasswd accounts with username and password.">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div>

		<div class="container">

			<h1 class="mb-4">.htpasswd generator</h1>


			<form method="post" action="" class="mb-4">
				<?php foreach ($accounts as $account) { ?>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="basic_name">Basic Auth Name</label>
							<input type="text" name="name" value="<?= $account['name'] ?>" class="form-control" id="basic_name" placeholder="Name ...">
						</div>
						<div class="form-group col-md-6">
							<label for="basic_password">Basic Auth Password</label>
							<input type="password" name="password" value="<?= $account['password'] ?>" class="form-control" id="basic_password" placeholder="Password ...">
						</div>
					</div>
				<?php } ?>
				<div class="text-center">
					<input type="submit" class="btn btn-primary">
				</div>
			</form>


			<div class="row">
				<div class="col">

					<h4>.htaccess</h4>
					<div class="border border-primary mb-4 p-2">
						AuthName "<?= $authname ?>"<br>
						AuthType Basic<br />
						AuthUserFile /document/root/to/.htpasswd<br>
						require valid-user
					</div>

				</div>
				<div class="col">

					<h4>.htpasswd</h4>
					<div class="border border-primary mb-4 p-2">
						<?php
						$accs = [];
						foreach ($accounts as $account) {
							$accs[] = $account['name'].':'.crypt($account['password'], base64_encode($account['password']));
						}
						echo implode("<br>", $accs).'<br>';
						?>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col">
					<h4>Find out path ...</h4>
					<span class="border border-primary bg-primary text-white p-1 d-inline-block" style="font-size: 9px;">PHP</span>
					<div class="border border-primary mb-4 p-2" style="font-size: 11px;">
						&lt;?= __DIR__ ?&gt;
					</div>
				</div>
			</div>

		</div>

	</div>
	
	
</body>
</html>