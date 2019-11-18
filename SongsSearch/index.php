<html>
  <head>
    <title>Search Songs</title>
    <style>
      table, th, td {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <div>
      <h1>Karaoke Group Project - Search Songs</h1>
    </div>
    <div>
      <a href="../DJ/">DJ Page</a><br/>
      <a href="../SearchSongs/">Search Songs</a>
    </div>
    <div>
      <form action="./index.php" method="POST">
        Search: <input type=text name="search"><br/>
        <input type="submit" value="search">
      </form>
    </div>
    <div>
      <?php
        $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
        $query = 'SELECT Songs.title, Versions.File FROM Songs
                  INNER JOIN SongsBy ON Songs.ID = SongsBy.SongID
                  INNER JOIN Contributors ON Contributors.ID = SongsBy.ContributorID
                  INNER JOIN Versions ON Versions.SongID = Songs.ID
                  WHERE
                  Contributors.name = :search OR
                  Songs.title = :search ;';
        $sth = $db->prepare($query);
        $sth->bindParam(':search', $_POST['search']);
        $sth->execute();
        $stmt = $sth->fetchAll();
        echo '<table>';
        echo '<tr><th></th><th>Title</th><th>Version</th></tr>';
        foreach($stmt as $sid){
          echo '<tr>';
          echo '<td><a href="./add/index.php?version='.$sid['File'].'">Add to Queue</a></td>';
          echo '<td>' . $sid['title'] . '</td> <td> ' . $sid['File'] . '</td>';
          echo '</tr>';
        }
        echo '</table>';
      ?>
    </div>
  </body>
</html>
