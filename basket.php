<?php
	session_start();
	function basket(){
		isset($_SESSION['basket']);
		echo '<h2>Your basket:'.count($_SESSION['basket']).'pc</h2>
		<div class="product_list">';
		$total = 0;
		foreach ($_SESSION['basket'] as $pokemon => $value){
			echo '
			<ul>
				<li class="product"><img class="product_image" src="image/'.$value['Image'].'">
				<h2>'.$value['Name'].'</h2>
				<p>Type: '.$value['Type'].'</p>
				<p>Price: '.$value['Price'].'€</p>
				<form action="" method = "POST">
					<input type="submit" name="basket_delete" value="DELETE" />
					<input type="hidden" name="delete_bsku" value="'.$value['SKU'].'" />
				</form>
			</ul>
			</form>';
			$total += intval($value['Price']);
		}
		echo '</div>';
		echo '<h2>Total: '.$total.'€</h2>';
		if (isset($_POST['basket_delete']) && isset($_POST['basket_delete']) == "DELETE")
		{
			unset($_SESSION['basket'][$_POST['delete_bsku']]);
			header("location:basket.php");
		}
		if ($_SESSION['login'])
		{
			echo '
					<form action="" method = "POST">
						<input type="submit" name="buy" value="Buy" />
				</form>';
			if (isset($_POST['buy']) && isset($_POST['buy']) == "Buy"){
				$count = count($_SESSION['order']);
				$_SESSION['order'][$count]['User'] = $_SESSION['login'];
				$_SESSION['order'][$count]['Amount'] = count($_SESSION['basket']);
				$_SESSION['order'][$count]['Total'] = $total;
				foreach ($_SESSION['order'] as $user => $value){
					$line = $line.implode(',', $value)."\n";
				}
				if ($line)
					file_put_contents("data/order.csv", $line);
					header("location:complete.php");
			}
		}
		else
			echo '<a href="http://localhost:4000/login.php">Please log in to buy!</a>';
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
			</ul>
		</nav>
			<?php basket();?>
		</div>
	</body>
</html>
