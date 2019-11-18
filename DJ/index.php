<html>
  <head>
    <title>DJ Page</title>
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
        foreach($stmt as $sid){
          echo '<br/><a href="./index.php?played='.$sid['position'].'">Mark As Played</a> - ';
          echo $sid['position'] . ') ' . $sid['File'] . ' --- '. $sid['User'] . ' --- $'. $sid['amount_paid'];
        }
        echo '<br/><br/> Paid Queue ';
        $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
        $query = 'SELECT Queues.position, Queues.File, Queues.User, Queues.amount_paid FROM Queues
                  WHERE amount_paid > 0 AND played = false;';
        $sth = $db->prepare($query);
        $sth->execute();
        $stmt = $sth->fetchAll();
        foreach($stmt as $sid){
          echo '<br/><a href="./index.php?played='.$sid['position'].'">Mark As Played</a> - ';
          echo $sid['position'] . ') ' . $sid['File'] . ' --- '. $sid['User'] . ' --- $'. $sid['amount_paid'];
        }

        $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
        $query = 'UPDATE Queues SET played = true WHERE position=:id ;';
        $sth = $db->prepare($query);
        $sth->bindParam(':id',$_GET['played']);
        $sth->execute();
      ?>
    </div>
  </body>
</html>
