<?php
	include('install.php');
	session_start();
?>
<!DOCTYPE html><html>
	<head>
		<meta charset="utf-8">
		<title>Pokemon shop</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php $_SESSION['pokemon'] = product_read();?>
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
		<div class="filter">
				<a>Sorted by 
				<label>
				<form action="" method = "POST">
						<select name="filter">
							<option selected>All</option>
							<option value="Grass">Grass</option>
							<option value="Fire">Fire</option>
							<option value="Water">Water</option>
							<option value="Bug">Bug</option>
							<option value="Normal">Normal</option>
							<option value="Poison">Poison</option>
							<option value="Electric">Electric</option>
							<option value="Ground">Ground</option>
							<option value="Fairy">Fairy</option>
							<option value="Fightinh">Fighting</option>
							<option value="Psychic">Psychic</option>
							<option value="Rock">Rock</option>
							<option value="Ghost">Ghost</option>
							<option value="Ice">Ice</option>
							<option value="Dragon">Dragon</option>
						</select>
						<input type="submit" value="select">
						</form>
				</label></a>
		</div>
		<div class="product_list">
			<?php show_product($_SESSION['pokemon']);?>
		</div>
		</div>
	</body>
</html>
