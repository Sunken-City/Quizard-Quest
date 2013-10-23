#Creates the database that will be used for the Quizard-Quest website/app
#File created by cd msc/

DROP DATABASE IF EXISTS quizardQuest;

CREATE DATABASE quizardQuest;
USE quizardQuest;

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

CREATE TABLE decks (
   deckID int NOT NULL AUTO_INCREMENT,
   userID int NOT NULL,
   name varchar(50) NOT NULL,
   PRIMARY KEY(deckID),
   UNIQUE KEY(userID, name),
   FOREIGN KEY(userID) REFERENCES players(userID)
) engine = InnoDB;

CREATE TABLE cards (
   cardID int NOT NULL AUTO_INCREMENT,
   userID int NOT NULL,
   question varchar(512) NOT NULL,
   answer varchar(64) NOT NULL,
   category int NOT NULL,
   subCategory varchar(32),
   difficulty int NOT NULL,
   rating int default 0,
   PRIMARY KEY(cardID),
   FOREIGN KEY(userID) REFERENCES players(userID)
) engine = InnoDB;

CREATE TABLE deckCards (
   deckID int NOT NULL,
   cardID int NOT NULL,
   FOREIGN KEY(deckID) REFERENCES decks(deckID),
   FOREIGN KEY(cardID) REFERENCES cards(cardID)
) engine = InnoDB;

CREATE TABLE options (
   avatar varchar(100),
   carBorder varchar(100),
   bgColor varchar(10),
   userID int NOT NULL,
   FOREIGN KEY(userID) REFERENCES players(userID)
) engine = InnoDB;

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
) engine = InnoDB;

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
) engine = InnoDB;
