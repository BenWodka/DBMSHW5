#!/bin/bash

mysql <<EOFMYSQL
use bmw032;
SHOW TABLES;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE Team;
DROP TABLE Game;
DROP TABLE Player;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE Team (
 TeamID INT PRIMARY KEY,
 Location CHAR(15) NOT NULL,
 Nickname CHAR(15) NOT NULL,
 Conference ENUM('AFC', 'NFC') NOT NULL,
 Division ENUM('North', 'East', 'South', 'West') NOT NULL
);

CREATE TABLE Game (
 GameID INT PRIMARY KEY,
 TeamID1 INT,
 TeamID2 INT,
 Score1 INT,
 Score2 INT,
 date DATE,
 FOREIGN KEY (TeamID1) REFERENCES Team(TeamID) ON DELETE RESTRICT,
 FOREIGN KEY (TeamID2) REFERENCES Team(TeamID) ON DELETE RESTRICT
);

CREATE TABLE Player (
 playerID INT PRIMARY KEY,
 TeamID INT,
 name CHAR (30) NOT NULL,
 position ENUM('QB', 'RB', 'FB', 'C', 'OG', 'OT', 'TE', 'WR', 'DT', 'DE', 'LB', 'S', 'CB', 'P', 'K', 'PR', 'KR', 'LS'),
 FOREIGN KEY (TeamID) REFERENCES Team(TeamID) ON DELETE RESTRICT

);

INSERT INTO Team (TeamID, Location, Nickname, Conference, Division) VALUES
(0, 'Arizona', 'Cardinals', 'NFC', 'West'),
(1, 'Atlanta', 'Falcons', 'NFC', 'South'),
(2, 'Baltimore', 'Ravens', 'AFC', 'North'),
(3, 'Buffalo', 'Bills', 'AFC', 'East'),
(4, 'Carolina', 'Panthers', 'NFC', 'South'),
(5, 'Chicago', 'Bears', 'NFC', 'North'),
(6, 'Cincinnati', 'Bengals', 'AFC', 'North'),
(7, 'Cleveland', 'Browns', 'AFC', 'North'),
(8, 'Dallas', 'Cowboys', 'NFC', 'East'),
(9, 'Denver', 'Broncos', 'AFC', 'West'),
(10, 'Detroit', 'Lions', 'NFC', 'North'),
(11, 'Green Bay', 'Packers', 'NFC', 'North'),
(12, 'Houston', 'Texans', 'AFC', 'South'),
(13, 'Indianapolis', 'Colts', 'AFC', 'South'),
(14, 'Jacksonville', 'Jaguars', 'AFC', 'South'),
(15, 'Kansas City', 'Chiefs', 'AFC', 'West'),
(16, 'Las Vegas', 'Raiders', 'AFC', 'West'),
(17, 'Los Angeles', 'Chargers', 'AFC', 'West'),
(18, 'Los Angeles', 'Rams', 'NFC', 'West'),
(19, 'Miami', 'Dolphins', 'AFC', 'East'),
(20, 'Minnesota', 'Vikings', 'NFC', 'North'),
(21, 'New England', 'Patriots', 'AFC', 'East'),
(22, 'New Orleans', 'Saints', 'NFC', 'South'),
(23, 'New York', 'Giants', 'NFC', 'East'),
(24, 'New York', 'Jets', 'AFC', 'East'),
(25, 'Philadelphia', 'Eagles', 'NFC', 'East'),
(26, 'Pittsburgh', 'Steelers', 'AFC', 'North'),
(27, 'San Francisco', '49ers', 'NFC', 'West'),
(28, 'Seattle', 'Seahawks', 'NFC', 'West'),
(29, 'Tampa Bay', 'Buccaneers', 'NFC', 'South'),
(30, 'Tennessee', 'Titans', 'AFC', 'South'),
(31, 'Washington', 'Commanders', 'NFC', 'East'
);

INSERT INTO Game (gameID, TeamID1, TeamID2, Score1, Score2, date) VALUES
(0, 8, 15, 28, 17, '2017-11-05'),
(1, 8, 15, 26, 20, '2009-10-11');

INSERT INTO Player (playerID, TeamID, name, position) VALUES
(0, 8, 'Dak Prescott', 'QB'),
(1, 8, 'CeeDee Lamb', 'WR'),
(2, 8, 'Zach Martin', 'OG'),
(3, 8, 'DaRon Bland', 'CB'),
(4, 15, 'Patrick Mahomes', 'QB'),
(5, 15, 'Isaiah Pacheco', 'RB'),
(6, 15, 'Rashee Rice', 'WR'),
(7, 15, 'Chris Jones', 'DT');

EOFMYSQL