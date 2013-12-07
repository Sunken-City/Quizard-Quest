#Creates the database that will be used for the Quizard-Quest website/app
#File created by cd msc/

DROP DATABASE IF EXISTS quizardQuest;

CREATE DATABASE quizardQuest;
USE quizardQuest;


#Creates the table players. Primary key is the userID, which SQL automatically generates
#The username and email are both independently unique so as to avoid duplicates of either 
CREATE TABLE players (
   userID int NOT NULL AUTO_INCREMENT,
   username varchar(50),
   password varchar(256) NOT NULL,
   salt varchar(256) NOT NULL,
   email varchar(50) NOT NULL,
   fName varchar(50) NOT NULL,
   lName varchar(50) NOT NULL,
   grade varchar(50),
   gender varchar(1),
   permissions int default 0,
   PRIMARY KEY(userID),
   UNIQUE KEY(username),
   UNIQUE KEY(email)
) engine = InnoDB;

#Creates the decks table with another auto-incremented primary key, and a unique tuple of userID and
#the name of the deck.
CREATE TABLE decks (
   deckID int NOT NULL AUTO_INCREMENT,
   userID int NOT NULL,
   name varchar(50) NOT NULL,
   PRIMARY KEY(deckID),
   UNIQUE KEY(userID, name),
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;

#Creates the cards table with yet another auto-incremented primary key of cardID. Every card MUST have
# a category, but does not need a subCategory.
CREATE TABLE cards (
   cardID int NOT NULL AUTO_INCREMENT,
   userID int NOT NULL,
   question varchar(512) NOT NULL,
   answer varchar(512) NOT NULL,
   category int NOT NULL,
   subCategory varchar(32),
   difficulty int NOT NULL,
   rating int default 0,
   PRIMARY KEY(cardID),
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;

#Creates a reference table between decks and cards so as to relate the two in a coherent manner.
CREATE TABLE deckCards (
   deckCardID int NOT NULL AUTO_INCREMENT,
   deckID int NOT NULL,
   cardID int NOT NULL,
   PRIMARY KEY(deckCardID),
   UNIQUE KEY(deckID, cardID),
   FOREIGN KEY(deckID) REFERENCES decks(deckID)
      on delete cascade on update cascade,
   FOREIGN KEY(cardID) REFERENCES cards(cardID)
      on delete cascade on update cascade
) engine = InnoDB;

#A table that holds the options for each player, which can be editable.
CREATE TABLE options (
   avatar varchar(100) default '../Resources/Avatars/Greg.png',
   cardBorder varchar(100),
   bgColor varchar(10),
   userID int NOT NULL,
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;

#Creates the table that holds the statistics for each player, which will be updated after the 
#completion of a game mode.
CREATE TABLE stats (
   userID int NOT NULL,
   mathExp int default 0,
   sciExp int default 0,
   ssExp int default 0,
   engExp int default 0,
   langExp int default 0,
   totExp int default 0,
   gold int default 100,
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;

#Creates the table that will keep track of a users achievments, which will be edited by the PHP if
#they achieve the achievements.
CREATE TABLE achievements (
   userID int NOT NULL,
   perfectGame int default 0,
   closeCall int default 0,
   mathQuizzard int default 0,
   sciQuizzard int default 0,
   ssQuizzard int default 0,
   engQuizzard int default 0,
   langQuizzard int default 0,
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;

#Creates a table that will hold a users security question
CREATE TABLE securityQuestions (
   userID int NOT NULL,
   questionID int NOT NULL,
   answer varchar(32) NOT NULL,
   FOREIGN KEY(userID) REFERENCES players(userID)
      on delete cascade on update cascade
) engine = InnoDB;
