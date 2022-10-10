<?php
session_start();
function login_status(){
	if ($_SESSION['login'] && $_SESSION['passwd'])
	{
		if ($_SESSION['login'] == "admin")
			header("location:admin.php");
		echo '
				<h2>Your login info:</h2>
				Username '.$_SESSION['login'].'
				<br />
				<form action="" method="POST">
					<input type="submit" name="logout" value="logout" />
					<input type="submit" name="delete_account" value="Delete Account" />
				</form>';
		if (isset($_POST['delete_account']) && isset($_POST['delete_account']) == "Delete Account"){
			$logins = unserialize(file_get_contents('data/passwd.csv'));
			foreach($logins as $key => $value)
			{
				if ($value['login'] == $_SESSION['login']){
					unset($logins[$key]);
					header("location:login.php");
				}
			}
			file_put_contents('data/passwd.csv', serialize($logins));
			$_SESSION['login'] = "";
			$_SESSION['passwd'] = "";
		}
		if (isset($_POST['logout']))
		{
			$_SESSION['login'] = "";
			$_SESSION['passwd'] = "";
			header("location:login.php");
		}
		return TRUE;
	}
	return FALSE;
}

function login(){
	if (isset($_POST['submit']) == "OK" && isset($_POST['login']) && isset($_POST['passwd']) != "")
	{
		$logins = unserialize(file_get_contents('data/passwd.csv'));
		foreach($logins as $key => $value)
		{
			if ($value['login'] == $_POST['login'] && $value['passwd'] == hash('whirlpool', $_POST['login']))
			{
				$logins[$key]['passwd'] = hash('whirlpool', $_POST['passwd']);
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['passwd'] = $logins[$key]['passwd'];
				if ($_SESSION['login'] == "admin")
					header("location:admin.php");
				else
					header("location:index.php");
				echo "login successful!\n";
			}
		}
		echo "INCORRECT PASSWORD OR USERNAME!\n";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title>Login page</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
	<img class="shop_logo" src="image/pokemon-logo.png">
	<nav class="menu">
		<ul>
			<li class="item"><a href="http://localhost:4000/">Showcase</a>
			</li>
			<li class="item"><a href="http://localhost:4000/login.php">Login</a>
			</li>
			<li class="item"><a href="http://localhost:4000/basket.php">Basket</a>
			</li>
		</ul>
	</nav>
	<?php
		$status = login_status();
		if ($status == 0){
			echo '
				<h2>Please fill your account credentials:</h2>
				<form action="login.php" method="post">
				Username: <input class="form" type="text" name="login" value="">
				<br />
				Password: <input class="form" type="password" name="passwd" value="">
				<br />
				<input type="submit" name="submit" value="OK">';
				login();
				echo '
				<br />
				<a href="http://localhost:4000/createaccount.php">Dont have account yet? click here to create account.</a>
				</form>';
		}
	?>
</body>
</html>
