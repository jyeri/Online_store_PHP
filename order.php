<?php
session_start();
function order_list(){
	foreach($_SESSION['order'] as $order => $value){
		$number = $order + 1;
		echo '<ul><li class="product">
			<h2>Order: '.$number.'</h1>
			<p>User:'.$value['User'].'</p>
			<p>Amount:'.$value['Amount'].'</p>
			<p>Total:'.$value['Total'].'</p>
			</li>
			</ul>';
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
				<li class="item"><a href="http://localhost:4000/admin.php">Manage Pokemon</a>
				</li>
				<li class="item"><a href="http://localhost:4000/order.php">Order</a>
				</li>
			</ul>
	</nav>
	<h2>Order History</h2>
	<div class="product_list">
	<?php order_list(); ?>
	</div>
</body>
</html>
