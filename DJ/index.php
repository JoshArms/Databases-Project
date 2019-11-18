<html>
  <head>
    <title>DJ Page</title>
    <style>
      table, th, td {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <div>
      <h1>Karaoke Group Project - DJ Page</h1>
    </div>
    <div>
      <a href="../DJ/">DJ Page</a><br/>
      <a href="../SearchSongs/">Search Songs</a>
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
        echo '<table>';
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
        echo '<table>';
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
  </body>
</html>
