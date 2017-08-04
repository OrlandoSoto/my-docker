<html>
	<head>
		<title>Orlando Soto-Pastor</title>
	</head>
	<body>
		<h1>Docker Compose - PHP with Microservices</h1>
		<ul>
			<?php
			$json = file_get_contents('http://product-service');
			$obj = json_decode($json, true);
			
			$stop = $obj['StopName'];
			$route = $obj['Predictions'][0][RouteID];
			$direction = $obj['Predictions'][0][DirectionText];
			$minutes = $obj['Predictions'][0][Minutes];

			echo "<li>Stop: $stop</li>";
			echo "<li>Route: $route</li>";
			echo "<li>Direction: $direction</li>";
			echo "<li>Next bus: $minutes minutes</li>";

			?>
		</ul>
		<img src="http://s2.quickmeme.com/img/6d/6d63d092ef1a698433fd38b898451ab0c989df43a7389e5ca1324c9d4af35e42.jpg" width="400" height="400"> 
	</body>



</html>