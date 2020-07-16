<?php

	use \CMS\Includes\Connection;

	require '../../vendor/autoload.php';

	session_start();

	$dbConnection = new Connection;
	$pdo = $dbConnection->getConnection();

	if (!isset($_SESSION['logged_in'])) {
		if (isset($_POST['username'] , $_POST['password'])) {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);

			if (empty($username) || empty($password)) {
				$error = 'All fields are required!';
			} else {
				// check credentials
				$statement = $pdo->prepare("
					SELECT username, password
					FROM users
					WHERE username = :username
				");

				$statement->execute([
					'username' => $username
				]);

				$result = $statement->fetch(PDO::FETCH_ASSOC);

				// hashed password

				$storedHash = $result['password'];

				if (password_verify($password, $storedHash)) {
					// authentication successful
					$_SESSION['logged_in'] = true;
					header('Location: index.php');
					exit();
				} else {
					$error = 'Invalid credentials!';
				}
			}
		}
		?>

		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>CMS Mockup</title>
				<link rel="stylesheet" type="text/css" href="../Assets/style.css">
			</head>
			<body>
				<div class="container">
					<a href="../../index.php" id="logo"> CMS </a>

					<br><br>
					<?php  if(isset($error)) {?>
						<small style="color: #aa0000;">
							<?php echo $error;?>
						</small>
						<br><br>
					<?php }?>


					<form action="index.php" method="post" autocomplete="off">
						<input type="text" name="username" placeholder="Username">
						<input type="text" name="password" placeholder="Password">
						<input type="submit" value="Log in">
					</form>
				</div>
			</body>
		</html>

	<?php

	} else {?>

	<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>CMS Mockup</title>
				<link rel="stylesheet" type="text/css" href="../Assets/style.css">
			</head>
			<body>
				<div class="container">
					<a href="../../index.php" id="logo"> CMS </a>

					<br>
					<ol>
						<li><a href="add.php">Add Article</a></li>
						<li><a href="delete.php">Delete Article</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ol>
				</div>
			</body>
		</html>

	<?php }?>
