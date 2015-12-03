DROP DATABASE `TheGameHawk`;

CREATE DATABASE `TheGameHawk`;

CREATE TABLE `TheGameHawk`.`Users`
(
	`userID` INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`loginName` VARCHAR( 25 ) NOT NULL,
	`displayName` VARCHAR( 25 ) NOT NULL,
	`passwordHash` CHAR( 32 ) NOT NULL, -- md5 hashes are always 32 characters
	`emailAddress` VARCHAR( 35 ) NOT NULL,
	`SMaccount` VARCHAR( 50 ), -- will work out later
	`friendList` VARCHAR( 100 ),
	`gameList` VARCHAR( 100 ),
	`platformList` INT( 5 ),
	`location` VARCHAR( 50 ),
	`outgoingFriendRequests` VARCHAR( 100 ),
	`incomingFriendRequests` VARCHAR( 100 ),
	`posts` VARCHAR( 200 ),
	`pendingMessages` VARCHAR( 200 ),
	UNIQUE (`email`),
	UNIQUE (`loginName`)
) ENGINE = MYISAM;

CREATE TABLE `TheGameHawk`.`Games`
(
	`gameID` INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR( 50 ) NOT NULL,
	`platform` INT( 5 ) NOT NULL,
	`genre` VARCHAR( 50 ) NOT NULL
) ENGINE = MYISAM;