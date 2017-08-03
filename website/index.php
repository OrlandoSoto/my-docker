<html>
	<head>
		<title>Ooo-la-la!</title>
	</head>
	<body>
		<h1>Docker Compose</h1>
		<ul>
			<?php
			$json = file_get_contents('http://product-service');
			$obj = json_decode($json);

			$products = $obj->products;
			foreach ($products as $product) {
				echo "<li>$product</li>";
			}
			?>
		</ul>
		<img src="http://s2.quickmeme.com/img/6d/6d63d092ef1a698433fd38b898451ab0c989df43a7389e5ca1324c9d4af35e42.jpg"> 
	</body>



</html>