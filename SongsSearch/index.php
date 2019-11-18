<html>
  <head>
    <title>Search Songs</title>
    <style>
      table, th, td {
        border: 1px solid black;
      }
    </style>
    <script>
      function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("results");
        switching = true;
        dir = "asc";
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
          } else {
            if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
            }
          }
        }
      }
    </script>
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
                  Contributors.name LIKE CONCAT("%",:search,"%") OR
                  Songs.title LIKE CONCAT("%",:search,"%") ;';
        $sth = $db->prepare($query);
        $sth->bindParam(':search', $_POST['search']);
        $sth->execute();
        $stmt = $sth->fetchAll();
        echo '<table id="results">';
        echo '<tr><th></th><th onclick="sortTable(1)">Title</th><th onclick="sortTable(2)">Version</th></tr>';
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
