<html>
  <head>
    <title>All Songs</title>
  </head>
  <body>
    <div>
      <h1>Karaoke Group Project - Add Song</h1>
    </div>
    <div>
      <a href="../../DJ/">DJ Page</a><br/>
      <a href="../../SearchSongs/">Search Songs</a>
    </div>
    <div>
      Paying for a song is not necessary but will prioritize you in the queue<br/>
      <?php
        echo '<form action="./index.php?version='.$_GET['version'].'" method="POST">';
      ?>
        Cost: <input type=text name="amt"><br/>
        User: <input type=text name="user"><br/>
        <input type="submit" value="Add">
      </form>

    </div>
    <div>
      <?php
        $db = new PDO('mysql:host=courses; dbname=z1841083', 'z1841083', '2000Jul06');
        $query = 'INSERT INTO Queues (User, File, date_queued, amount_paid, played) VALUES
                  (:user, :file, DATE_FORMAT(NOW(), "%Y-%m-%d %T"), :paid, false);';
        $sth = $db->prepare($query);
        $sth->bindParam(':user', $_POST['user']);
        $sth->bindParam(':file', $_GET['version']);
        $sth->bindParam(':paid', $_POST['amt']);
        $sth->execute();
      ?>
    </div>
  </body>
</html>
