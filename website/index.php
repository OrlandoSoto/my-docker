<html>
	<head>
		<title>Orlando Soto-Pastor</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
		<ul>
			<?php
			$bus = file_get_contents('http://bus-service');
			$obj = json_decode($bus, true);
			
			$stop = $obj['StopName'];
			$route = $obj['Predictions'][0][RouteID];
			$direction = $obj['Predictions'][0][DirectionText];
			$minutes = $obj['Predictions'][0][Minutes];

			echo "<li><b>From:</b> $stop";
			echo "<BR><b>To:</b> $direction";
			echo "<BR><b>Route:</b> $route <b> - Next bus:</b> $minutes minutes</li><BR>";
			
			$train = file_get_contents('http://train-service');
                        $obj = json_decode($train, true);
			
			for($i=0; $i<count($obj['Trains']); $i++) {
				# If starting at Glenmont all trains head towards DC
				if(strcmp($obj['Trains'][$i]["LocationCode"],'B11')==0){
					echo "<li><b>From: </b>" . $obj['Trains'][$i]["LocationName"];
					echo "<BR><b>To: </b>" . $obj['Trains'][$i]["DestinationName"];
					echo "<BR><b>Arriving in: </b> "  . $obj['Trains'][$i]["Min"];
					echo "<BR>";
				}
				# If starting at Noma we need to pick trains with Destination Glenmont OR Silver Spring
				if(strcmp($obj['Trains'][$i]["DestinationCode"],'B11')==0 || strcmp($obj['Trains'][$i]["DestinationCode"],'B08')==0 ){
					echo "<li><b>From: </b>" . $obj['Trains'][$i]["LocationName"];
					echo "<BR><b>To: </b>"  . $obj['Trains'][$i]["DestinationName"];
					echo "<BR><b>Arriving in: </b> "  . $obj['Trains'][$i]["Min"];
					echo "<BR>";
				}
			}

			?>
		</ul>
		<img src="http://s2.quickmeme.com/img/6d/6d63d092ef1a698433fd38b898451ab0c989df43a7389e5ca1324c9d4af35e42.jpg" width="400" height="400" max-width: 100%"> 
	</body>



</html>
