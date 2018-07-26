<html>
<head>
  <title>Orlando Soto-Pastor</title>
  <!-- This next line is to make the text responsive in mobile devices -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
  <ul>
    <?php
    $bus = file_get_contents('http://bus-service');
    $obj = json_decode($bus, true);
			
    $stop_1 = $obj['bus_1']['StopName'];
    $stop_2 = $obj['bus_2']['StopName'];

    $route_1 = $obj['bus_1']['Predictions'][0]['RouteID'];
    $route_2 = $obj['bus_2']['Predictions'][0]['RouteID'];

    $direction_1 = $obj['bus_1']['Predictions'][0]['DirectionText'];
    $direction_2 = $obj['bus_2']['Predictions'][0]['DirectionText'];

    $minutes_1 = $obj['bus_1']['Predictions'][0]['Minutes'];
    $minutes_2 = $obj['bus_2']['Predictions'][0]['Minutes'];

    echo "<li><b>Bus : $route_1 at $stop_1 </b></li>";
    echo "<li><b>To: $direction_1 </b></li>";
    echo "<li><b>Next bus: $minutes_1 minutes</li></b><BR>";

    echo "<li><b>Bus : $route_2 at $stop_2 </b></li>";
    echo "<li><b>To: $direction_2 </b></li>";  
    echo "<li><b>Next bus: $minutes_2 minutes</li></b><BR>";		

    #echo "<hr><BR>";	

    $train = file_get_contents('http://train-service');
    $obj = json_decode($train, true);


    if(isset($obj['pm_train']['Trains'])){
        for ($i=0; $i<count($obj['pm_train']['Trains']); $i++) {
            echo "<li><b>Train Departing: </b>" . $obj['pm_train']['Trains'][$i]["LocationName"];
	          echo "<BR><b>To: </b>" . $obj['pm_train']['Trains'][$i]["DestinationName"];
	          echo "<BR><b>Next Train: </b> "  . $obj['pm_train']['Trains'][$i]["Min"];
	          echo "<BR><BR>";
        }
    }
    else{
        for ($i=0; $i<count($obj); $i++){
            for ($k=0; $k<count($obj[(string)$i]['Trains']); $k++){
                echo "<li><b>Train Departing: " . $obj[(string)$i]['Trains'][(string)$k]["LocationName"] . "</b></li>";
                echo "<li><b>To: " . $obj[(string)$i]['Trains'][(string)$k]["DestinationName"] . "</b></li>";
                echo "<li><b>Next Train: " . $obj[(string)$i]['Trains'][(string)$k]["Min"] . "</b></li>";
                echo "<BR>";
            }

            echo "<hr>";
        }
    }
    ?>
  </ul>
</body>
</html>
