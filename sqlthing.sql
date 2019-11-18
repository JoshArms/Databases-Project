CREATE TABLE Users(
  email varchar(100) NOT NULL PRIMARY KEY
);

CREATE TABLE Songs(
  ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(100)
);

CREATE TABLE Contributors(
  ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(100)
);

CREATE TABLE Versions(
  file varchar(100) NOT NULL PRIMARY KEY,
  SongID INT NOT NULL,
  FOREIGN KEY (SongID) REFERENCES Songs(ID)
);

CREATE TABLE SongsBy(
  ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SongID INT NOT NULL,
  ContributorID INT NOT NULL,
  role varchar(100),
  FOREIGN KEY (SongID) REFERENCES Songs(ID),
  FOREIGN KEY (ContributorID) REFERENCES Contributors(ID)
);

CREATE TABLE Queues(
  position INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  User varchar(100) NOT NULL,
  File varchar(100) NOT NULL,
  date_queued DATETIME,
  amount_paid INT,
  played BOOLEAN,
  FOREIGN KEY (User) REFERENCES Users(email),
  FOREIGN KEY (File) REFERENCES Versions(file)
);
