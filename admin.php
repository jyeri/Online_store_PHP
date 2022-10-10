<?php
	session_start();
	function admin_manage_sku($pokemon_list){
	foreach ($pokemon_list as $pokemon => $value){
			echo '
			<ul>
				<li class="product"><img class="product_image" src="image/'.$value['Image'].'">
				<h2>'.$value['Name'].'</h2>
				<p>Type: '.$value['Type'].'</p><p>Stock: '.$value['Stock'].'pc</p>
				<p>Price: '.$value['Price'].'€</p>
				<form action="" method = "POST">
				<input type="text" name="fieldtoprice"/>
				<input type="submit" value="Price Update" name="newprice" />
				<input type="hidden" name="price_sku" value="'.$value['SKU'].'" />
				<input type="hidden" name="changed" value="'.$_POST['fieldtoprice'].'" />
				<br />
				<br />
				<input type="submit" name="pokemon_delete" value="DELETE" />
				<input type="hidden" name="delete_pokemon_sku" value="'.$value['SKU'].'" />
				</form>
			</ul>
			</form>';
	}
	if ($_POST['pokemon_delete'] && $_POST['pokemon_delete'] == "DELETE"){
		unset($_SESSION['pokemon'][$_POST['delete_pokemon_sku']]);
		foreach ($_SESSION['pokemon'] as $pokemon => $value)
			$line = $line.implode(',', $value)."\n";
	}
	if ($_POST['newprice'] && $_POST['newprice'] == "Price Update"){
		$_SESSION['pokemon'][$_POST['price_sku']]['Price'] = $_POST['fieldtoprice'];
		foreach ($_SESSION['pokemon'] as $pokemon => $value)
		$line = $line.implode(',', $value)."\n";
	}
	if ($line)
		file_put_contents("data/pokemon.csv", $line);
}
?>

<!DOCTYPE html><html>
	<head>
		<meta charset="utf-8">
		<title>Pokemon shop</title>
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
				<li class="item"><a href="http://localhost:4000/admin.php">Manage Pokemon</a>
				</li>
				<li class="item"><a href="http://localhost:4000/order.php">Order</a>
				</li>
			</ul>
		</nav>
		<h2>Hello Admin!</h2>
		<?php
			echo'
			Do you want to log out?
			<form action="" method="POST">
				<input type="submit" name="logout" value="logout" />
			</form>';
			if ($_POST['logout'])
			{
				$_SESSION['login'] = "";
				$_SESSION['passwd'] = "";
				header("location:login.php");
			}
		?>
		<div class="product_list">
			<?php admin_manage_sku($_SESSION['pokemon']);?>
		</div>
	</body>
</html>
