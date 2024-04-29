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
(0, 0, 'Kyler Murray', 'QB'),
(1, 0, 'James Conner', 'RB'),
(2, 0, 'Greg Dortch', 'WR'),
(3, 1, 'Kirk Cousins', 'QB'),
(4, 1, 'Bijan Robinson', 'RB'),
(5, 1, 'Drake London', 'WR'),
(6, 2, 'Lamar Jackson', 'QB'),
(7, 2, 'Keaton Mitchell', 'RB'),
(8, 2, 'Derrick Henry', 'RB'),
(9, 3, 'Josh Allen', 'QB'),
(10, 3, 'Khalil Shakir', 'WR'),
(11, 3, 'James Cook', 'RB'),
(12, 4, 'Bryce Young', 'QB'),
(13, 4, 'Chuba Hubbard', 'RB'),
(14, 4, 'Diontae Johnson', 'WR'),
(15, 5, 'Caleb Williams', 'QB'),
(16, 5, 'Rome Odunze', 'WR'),
(17, 5, 'Khalil Herbert', 'RB'),
(18, 6, 'Joe Burrow', 'QB'),
(19, 6, 'Zack Moss', 'RB'),
(20, 6, 'Jamarr Chase', 'WR'),
(21, 7, 'Deshaun Watson', 'QB'),
(22, 7, 'Nick Chubb', 'RB'),
(23, 7, 'Amari Cooper', 'WR'),
(24, 8, 'Dak Prescott', 'QB'),
(25, 8, 'CeeDee Lamb', 'WR'),
(26, 8, 'Trevon Diggs', 'CB'),
(27, 9, 'Zach Wilson', 'QB'),
(28, 9, 'Courtland Sutton', 'WR'),
(29, 9, 'Jerry Jeudy', 'WR'),
(30, 10, 'Jarred Goff', 'QB'),
(31, 10, 'AmonRa St Brown', 'WR'),
(32, 10, 'Aiden Hutchinson', 'DE'),
(33, 11, 'Jordan Love', 'QB'),
(34, 11, 'Josh Jacobs', 'RB'),
(35, 11, 'Christian Watson', 'WR'),
(36, 12, 'CJ Stroud', 'QB'),
(37, 12, 'Joe Mixon', 'RB'),
(38, 12, 'Stefon Diggs', 'WR'),
(39, 13, 'Anthony Richardson', 'QB'),
(40, 13, 'Michael Pittman', 'WR'),
(41, 13, 'Gardner Minshew', 'QB'),
(42, 14, 'Trevor Lawrence', 'QB'),
(43, 14, 'Travis Etienne', 'RB'),
(44, 14, 'Christian Kirk', 'WR'),
(45, 15, 'Patrick Mahomes', 'QB'),
(46, 15, 'Isaiah Pacheco', 'RB'),
(47, 15, 'Rashee Rice', 'WR'),
(48, 16, 'Aiden OConnell', 'QB'),
(49, 16, 'Davante Adams', 'WR'),
(50, 16, 'Maxx Crosby', 'DE'),
(51, 17, 'Justin Herbert', 'QB'),
(52, 17, 'Gus Edwards', 'RB'),
(53, 17, 'Joshua Palmer', 'WR'),
(54, 18, 'Matthew Stafford', 'QB'),
(55, 18, 'Cooper Kupp', 'WR'),
(56, 18, 'Tyler Higbee', 'TE'),
(57, 19, 'Tua Tagovaioloa', 'QB'),
(58, 19, 'Devon Achane', 'RB'),
(59, 19, 'Tyreek Hill', 'WR'),
(60, 20, 'JJ McCarthy', 'QB'),
(61, 20, 'Aaron Jones', 'RB'),
(62, 20, 'Justin Jefferson', 'WR'),
(63, 21, 'Drake Maye', 'QB'),
(64, 21, 'Rhamondre Stevenson', 'RB'),
(65, 21, 'Kendrick Bourne', 'WR'),
(66, 22, 'Derek Carr', 'QB'),
(67, 22, 'Alvin Kamara', 'RB'),
(68, 22, 'Chris Olave', 'WR'),
(69, 23, 'Daniel Jones', 'QB'),
(70, 23, 'Devin Singletary', 'RB'),
(71, 23, 'Malik Nabers', 'WR'),
(72, 24, 'Aaron Rodgers', 'QB'),
(73, 24, 'Breece Hall', 'RB'),
(74, 24, 'Garrett Wilson', 'WR'),
(75, 25, 'Jalen Hurts', 'QB'),
(76, 25, 'Saquon Barkley', 'RB'),
(77, 25, 'AJ Brown', 'WR'),
(78, 26, 'Russell Wilson', 'QB'),
(79, 26, 'Jaylen Warren', 'RB'),
(80, 26, 'Pat Freiermuth', 'TE'),
(81, 27, 'Brock Purdy', 'QB'),
(82, 27, 'George Kittle', 'TE'),
(83, 27, 'Brandon Aiyuk', 'WR'),
(84, 28, 'Geno Smith', 'QB'),
(85, 28, 'Kenneth Walker III', 'RB'),
(86, 28, 'DK Metcalf', 'WR'),
(87, 29, 'Baker Mayfield', 'QB'),
(88, 29, 'Rachaad White', 'RB'),
(89, 29, 'Mike Evans', 'WR'),
(90, 30, 'Will Levis', 'QB'),
(91, 30, 'Deandre Hopkins', 'WR'),
(92, 30, 'Tony Pollard', 'RB'),
(93, 31, 'Jayden Daniels', 'QB'),
(94, 31, 'Brian Robinson', 'RB'),
(95, 31, 'Terry McLaurin', 'WR');

EOFMYSQL