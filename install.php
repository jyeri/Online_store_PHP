<?php
$pokemon_list = array(
	array(
			'SKU',
			'Name',
			'Type',
			'Price',
			'Image',
			'Stock'
		)
);

function product_read(){
	if (($contents = fopen("data/pokemon.csv", "r")) !== FALSE){
		while (($data = fgetcsv($contents, 1000, ",")) !== FALSE){
			$pokemon_list[$data[0]]['SKU'] = $data[0];
			$pokemon_list[$data[0]]['Name'] = $data[1];
			$pokemon_list[$data[0]]['Type'] = $data[2];
			$pokemon_list[$data[0]]['Price'] = $data[3];
			$pokemon_list[$data[0]]['Image'] = $data[4];
			$pokemon_list[$data[0]]['Stock'] = 5;
		}
		fclose($contents);
	}
	$i = 0;
	if (($contents = fopen("data/order.csv", "r")) !== FALSE){
		while (($data = fgetcsv($contents, 1000, ",")) !== FALSE){
			$_SESSION['order'][$i]['User'] = $data[0];
			$_SESSION['order'][$i]['Amount'] = $data[1];
			$_SESSION['order'][$i]['Total'] = $data[2];
			$i++;
		}
		fclose($contents);
	}
	return ($pokemon_list);
}

function show_product($pokemon_list){
	isset($_POST["filter"]);
	$filter = $_POST["filter"];
	foreach ($pokemon_list as $pokemon => $value){
		if ($filter == $value['Type'] || $filter == 0 || $filter == "All"){
			echo '
			<ul>
				<li class="product"><img class="product_image" src="image/'.$value['Image'].'">
				<h2>'.$value['Name'].'</h2>
				<p>Type: '.$value['Type'].'</p><p>Stock: '.$value['Stock'].'pc</p>
				<p>Price: '.$value['Price'].'€</p>
				<form action="" method = "POST">
				<input type="submit" name="basket" value="ADD TO BASKET" />
				<input type="hidden" name="added" value="'.$value['SKU'].'" />
				</form>
			</ul>
			</form>';
		}
	}
		if (isset($_POST['basket']) && isset($_POST['basket']) == "ADD TO BASKET")
		{
			foreach ($pokemon_list as $pokemon => $value){
				if ($value['SKU'] == $_POST['added']){
					$_SESSION['basket'][$value['SKU']] = $value;
				}
			}
		}
}
?>
