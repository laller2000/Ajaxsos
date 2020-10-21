<?php
//jelezzük a létrehozandó fájl karakterkódolását
header('Content-Type: text/html; charset=utf-8');
//oldalak közötti adatátvitel a globális változóval
session_start();
require_once 'connect.php';
require_once 'allamformaszures.php';
$conn->set_charset("utf8");
$allamformak=[];
$sql = "SELECT DISTINCT `allamforma` FROM `orszagok` ORDER BY 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      array_push($allamformak,$row['allamforma']);
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="hu"/>
        <title>Ajaxsos demo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="ajaxsos.css"/>
    </head>
    <body>
        <div class="container">
            <nav><nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
  <session>
      <form>
        <div class="form-group">
    <label for="allamformak">Államforma</label>
    <select class="form-control" id="allamformak">
        <?php
        foreach ($allamformak as $value) {
            echo '<option>'.$value.'</option>';
        }
        ?>
    </select>
  </div>  
      </form>
     <!--szűrés-->
     
     <!--adattábla-->
     <table class="table">
  <thead class="thead-dark">
        <tr>
          <th scope="col">Országnév</th>
          <th scope="col">Fölrdrajzihely</th>
          <th scope="col">Államforma</th>
        </tr>
      </thead>
      <tbody>
          <?php
            $sql="SELECT `orszag`,`foldr_hely`,`allamforma` FROM `orszagok` WHERE 1";
            $index=0;
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    echo '<tr><td>'.$index++.'</td>';
                    echo '<td>'.$row["orszag"].'</td>';
                    echo '<td>'.$row["foldr_hely"].'</td>';
                    echo '<td>'.$row["allamforma"].'</td>';
                    echo '</tr>';
                }
            }
            ?>
      </tbody>
    </table>
      </session>  
    </div>
        <script>
           $("select").change(function()
            {
                var kivalasztott=this.value;
                console.log(kivalasztott);
                    $.ajax({
                           url:"allamformaszures.php",
                            data:{allamforma:"allamforma"},
                            succes:function(data){
                                $("tbody").html(data);
                            }
                        }).done(function() {
                $( this ).addClass( "done" );;
            })
        });
        </script>
    </body>
</html>