<html>
  <head>
    <title>DJ Page</title>
    <style>
      table, th, td {
        border: 1px solid black;
		    color: #FFFFFF;
      }
      body {
    		background-image: url('https://i.pinimg.com/originals/84/fb/da/84fbdac0f75c9293a5b1cf58361d88f6.jpg');
    		background-repeat: no-repeat;
    		background-attachment: fixed;
    		background-size: cover;
        color: #FFFFFF;
  	  }
      .container{
        text-align: center;
      }
      .nav{
        color: white;
        background: gray;
      }
      .nav:hover{
        color: gray;
        background: white;
      }
      a{
        color: white;
      }
      a:hover{
        color: gray;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div>
        <h1>Karaoke Group Project - DJ Page</h1>
      </div>
      <div>
        <a class="nav" href="../DJ/">DJ Page</a><br/>
        <a class="nav" href="../SearchSongs/">Search Songs</a>
      </div>
      <div>
        <?php
          echo '<br/>Free Queue';
          $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
          $query = 'SELECT Queues.position, Queues.File, Queues.User, Queues.amount_paid FROM Queues
                    WHERE amount_paid = 0 AND played = false;';
          $sth = $db->prepare($query);
          $sth->execute();
          $stmt = $sth->fetchAll();
          echo '<table align="center">';
          echo '<tr><th></th><th>Position</th><th>Version</th><th>User</th><th>Price Paid</th></tr>';
          foreach($stmt as $sid){
            echo '<tr>';
            echo '<td><a href="./index.php?played='.$sid['position'].'">Mark As Played</a></td>';
            echo '<td>'.$sid['position'] . '</td><td>' . $sid['File'] . '</td><td>'. $sid['User'] . '</td><td>$'. $sid['amount_paid'].'</td>';
            echo '</tr>';
          }
          echo '</table>';

          $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
          $query = 'SELECT Queues.position, Queues.File, Queues.User, Queues.amount_paid FROM Queues
                    WHERE amount_paid > 0 AND played = false;';
          $sth = $db->prepare($query);
          $sth->execute();
          $stmt = $sth->fetchAll();

          echo '<br/><br/> Paid Queue ';
          echo '<table align="center">';
          echo '<tr><th></th><th>Position</th><th>Version</th><th>User</th><th>Price Paid</th></tr>';
          foreach($stmt as $sid){
            echo '<tr>';
            echo '<td><a href="./index.php?played='.$sid['position'].'">Mark As Played</a></td>';
            echo '<td>'.$sid['position'] . '</td><td>' . $sid['File'] . '</td><td>'. $sid['User'] . '</td><td>$'. $sid['amount_paid'].'</td>';
            echo '</tr>';
          }
          echo '</table>';

          $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
          $query = 'UPDATE Queues SET played = true WHERE position=:id ;';
          $sth = $db->prepare($query);
          $sth->bindParam(':id',$_GET['played']);
          $sth->execute();
        ?>
      </div>
    </div>
  </body>
</html>
