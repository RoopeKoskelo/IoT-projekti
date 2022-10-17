<!DOCTYPE html>
<?php
      $databaseHost = "[hostname]";
      $databaseUsername = "[username]";
      $databasePassword = "[password]";
      $databaseName = "[databasename]";
      
      $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
      if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT id, aika, lampo, kosteus FROM DHT11 ORDER BY id DESC LIMIT 10";
      $output = $conn->query($sql);
      $conn->close();
      
      $tabledata = "";
      
      $chartTemp = "";
      $chartHumid = "";
      
      while($row = $output->fetch_assoc())
              {
                $tabledata.=
                  "<tr>".
                    "<td>". $row[aika]."</td>".
                    "<td>". $row[lampo]."</td>".
                    "<td>". $row[kosteus]."</td>".
                  "</tr>";
                if (strlen($chartTemp) > 0){
                }
                  else{
                $chartTemp = $row[lampo];
                $chartHumid = $row[kosteus];
                }
              }
?>
<html>
  <head>    
    <title>
      Lämpö ja Kosteus
    </title>
    <style>
      body{
        font-family:Arial;
        }
      table, th, td{
        border:1px solid black;
        border-collapse:collapse;
        padding:5px;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Lämpö', <?php echo $chartTemp ?>],
            ['Kosteus', <?php echo $chartHumid ?>],
          ]);

        var options = {
          width: 400, height: 120,
          redFrom: 75, redTo: 100,
          yellowFrom:45, yellowTo: 75,
          greenFrom:20, greenTo:45,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

//        setInterval(function() {
//          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
//          chart.draw(data, options);
//        }, 13000);
//        setInterval(function() {
//          data.setValue(1, 1,);
//          chart.draw(data, options);
//       }, 5000);
//        setInterval(function() {
//          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
//          chart.draw(data, options);
//        }, 26000);
      }
    </script>
  </head>
    <body>
      <div style="border:2px double black; text-align:center;">
        <h1>Lämpö- ja kosteusanturi:</h1>
        <p>Powered by 100% pure memes</p>
      </div>
      <br>
      <div style="text-align:center">
        <img src="kuvat/kekw" width=200px>
          <div>
            <div id="chart_div" style="width: 400px; height: 120px;"></div>
            <table>          
              <tr>
                <th>pvm/aika</th>
                <th>lämpö</th>
                <th>kosteus</th>
              </tr>          
              <?php
                echo $tabledata;
              ?>
            </table>
          </div>
      </div>
    </body>
</html>
