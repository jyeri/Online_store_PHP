<?php
function create_newaccount(){
	session_start();
	if (isset($_POST['submit']) == "OK" && isset($_POST['login']) && isset($_POST['passwd']) != "" && $_POST['submit'])
	{
		if(file_exists("data/passwd.csv") == false)
			file_put_contents('data/passwd.csv', NULL);
		$logins = unserialize(file_get_contents('data/passwd.csv'));
		if ($logins)
		{
			$alreadysetup = 0;
			foreach($logins as $key => $value)
			{
				if ($_POST['login'] === $value['login'])
				$alreadysetup = 1;
			}
		}
		if (!$alreadysetup)
		{
			$temp["login"] = $_POST["login"];
			$temp["passwd"] = hash('whirlpool', $_POST["passwd"]);
			$logins[] = $temp;
			file_put_contents('data/passwd.csv', serialize($logins));
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['passwd'] = $_POST['passwd'];
			header("location:index.php");
		}
		else 
			echo "this account name is taken. \n";
	}
}
?>

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
				<li class="item"><a href="#">Basket</a>
				</li>
			</ul>
		</nav>
	<h2>Create a new account</h2>
	<form action="createaccount.php" method="post">
        Username: <input class="form" type="text" name="login" value="<?php echo isset($_SESSION['login']) ?>">
        <br />
        Password: <input class="form" type="password" name="passwd" value="<?php echo isset($_SESSION['passwd']) ?>">
		<br />
        <input type="submit" name="submit" value="OK" >
		<br />
		<?php create_newaccount();?>
		<br />
		<a href="http://localhost:4000/login.php">Already done? Click to proceed to login!</a>
    </form>
</body>
</html>
