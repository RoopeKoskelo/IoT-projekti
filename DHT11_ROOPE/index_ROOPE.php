<!DOCTYPE html>
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
  </head>
    <body>
      
      <?php
      $databaseHost = "localhost";
      $databaseUsername = "root";
      $databasePassword = "kissa123";
      $databaseName = "ROOPE_DHT11";
      
      $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
      if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT id, aika, lampo, kosteus FROM DHT11 ORDER BY id DESC LIMIT 10";
      $output = $conn->query($sql);
      //while($row = $output->fetch_assoc()){
      //  echo $row["aika"]." Lämpö: ".$row["lampo"]." Kosteus: ".$row["kosteus"]."<br>";
      //  }
      $conn->close();
      ?>
      
      <div style="border:2px double black; text-align:center;">
        <h1>Lämpö- ja kosteusanturi:</h1>
        <p>Powered by 100% pure memes</p>
      </div>
      <br>
      <div style="text-align:center">
        <img src="kuvat/kekw" width=200px>
          <div>
            <table>          
              <tr>
                <th>pvm/aika</th>
                <th>lämpö</th>
                <th>kosteus</th>
              </tr>          
              <?php
              while($row = $output->fetch_assoc())
              {
                echo  "<tr>";
                echo    "<td>". $row[aika]."</td>";
                echo    "<td>". $row[lampo]."</td>";
                echo    "<td>". $row[kosteus]."</td>";
                echo  "</tr>";
              }
              ?>
            </table>
          </div>
      </div>
    </body>
</html>
