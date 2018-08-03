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
    $bus = json_decode($bus, true);

    $train = file_get_contents('http://train-service');
    $train = json_decode($train, true);
			
    $incidents = file_get_contents('http://incidents-service');
    $incidents = json_decode($incidents, true);

    $stop_1 = $bus['bus_1']['StopName'];
    $stop_2 = $bus['bus_2']['StopName'];

    $route_1 = $bus['bus_1']['Predictions'][0]['RouteID'];
    $route_2 = $bus['bus_2']['Predictions'][0]['RouteID'];

    $direction_1 = $bus['bus_1']['Predictions'][0]['DirectionText'];
    $direction_2 = $bus['bus_2']['Predictions'][0]['DirectionText'];

    $minutes_1 = $bus['bus_1']['Predictions'][0]['Minutes'];
    $minutes_2 = $bus['bus_2']['Predictions'][0]['Minutes'];

    echo "<li><b>Bus : $route_1 at $stop_1 </b></li>";
    echo "<li><b>To: $direction_1 </b></li>";
    echo "<li><b>Next bus: $minutes_1 minutes</li></b><BR>";

    echo "<li><b>Bus : $route_2 at $stop_2 </b></li>";
    echo "<li><b>To: $direction_2 </b></li>";  
    echo "<li><b>Next bus: $minutes_2 minutes</li></b><BR>";		
    echo "<hr align='left' width='50%'>";

    # Show PM Trains
    if(isset($train['pm_train']['Trains'])){
        for ($i=0; $i<count($train['pm_train']['Trains']); $i++) {
            echo "<li><b>Train Departing: " . $train['pm_train']['Trains'][$i]["LocationName"] . "</b></li>";
	          echo "<li><b>To: " . $train['pm_train']['Trains'][$i]["DestinationName"] . "</b></li>";
	          echo "<li><b>Next Train: "  . $train['pm_train']['Trains'][$i]["Min"] . "</b></li>";
	          echo "<BR>";
        }
        echo "<hr align='left' width='50%'>";
    }
    # Show AM Trains
    else{
        for ($i=0; $i<count($train); $i++){
            for ($k=0; $k<count($train[(string)$i]['Trains']); $k++){
                # Don't show trains travelling to Shady Grove in the AM
                if(strcmp($train[(string)$i]['Trains'][(string)$k]["DestinationName"],'Shady Grove')!==0){
                    echo "<li><b>Train Departing: " . $train[(string)$i]['Trains'][(string)$k]["LocationName"] . "</b></li>";
                    echo "<li><b>To: " . $train[(string)$i]['Trains'][(string)$k]["DestinationName"] . "</b></li>";
                    echo "<li><b>Next Train: " . $train[(string)$i]['Trains'][(string)$k]["Min"] . "</b></li>";
                    echo "<BR>";
                }
            }

            echo "<hr align='left' width='50%'>";
        }
    }

    for ($i=0; $i<count($incidents['Incidents']); $i++){

        if(strcmp($incidents['Incidents'][$i]['LinesAffected'], 'RD;' )==0){
            echo "<li><b>Incidents: " . $incidents['Incidents'][$i]['Description'] . "</b></li>";
        }
    }

    ?>
  </ul>
</body>
</html>
