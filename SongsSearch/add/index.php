<html>
  <head>
    <title>All Songs</title>
    <style>
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
        <h1>Karaoke Group Project - Add Song</h1>
      </div>
      <div>
        <a class="nav" href="../../DJ/">DJ Page</a><br/>
        <a class="nav" href="../../SearchSongs/">Search Songs</a>
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
    </div>
  </body>
</html>
