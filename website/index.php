<html>
	<head>
		<title>Orlando Soto-Pastor</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
		<ul>
			<?php
			$bus = file_get_contents('http://product-service');
			$obj = json_decode($bus, true);
			
			$stop = $obj['StopName'];
			$route = $obj['Predictions'][0][RouteID];
			$direction = $obj['Predictions'][0][DirectionText];
			$minutes = $obj['Predictions'][0][Minutes];

			echo "<li><b>Stop:</b> $stop <b>Direction:</b> $direction</li>";
			echo "<li><b>Route:</b> $route <b>Next bus:</b> $minutes minutes</li>";
			
			$train = file_get_contents('http://train-service');
                        $obj = json_decode($train, true);
			
			for($i=0; $i<count($obj['Trains']); $i++) {
				if(strcmp($obj['Trains'][$i]["Destination"],'Glenmont')==0 || strcmp($obj['Trains'][$i]["Destination"],'SilvrSpg')==0 ){
				echo "From: " . $obj['Trains'][$i]["LocationName"];
				echo " To: "  . $obj['Trains'][$i]["Destination"];
				}
			}

			?>
		</ul>
		<img src="http://s2.quickmeme.com/img/6d/6d63d092ef1a698433fd38b898451ab0c989df43a7389e5ca1324c9d4af35e42.jpg" width="400" height="400"> 
	</body>



</html>
