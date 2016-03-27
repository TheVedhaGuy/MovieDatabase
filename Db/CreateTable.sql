set search_path="GroupAssign";

--Movies can have multiple roles
--Roles(Characters) can belong to multiple movies

--Regarding requirement number 3, what we should have are users that have the ability to
--administrate the system, and actual users of the system
--There we'll have two tables for users, one that's an admin and one that's a customer
--Maybe profile will determine whether the user is admin or not...

CREATE TABLE Users
(
UserID VARCHAR(20) PRIMARY KEY,
password VARCHAR(20),
lastname VARCHAR(20),
firstname VARCHAR(20),
email VARCHAR(20),
city VARCHAR(20),
province VARCHAR(20),
country VARCHAR(20)
);

--?
--Should we set up specific age ranges?
CREATE TABLE AgeRange
(
AgeCategory VARCHAR(15) PRIMARY KEY,
LowerLimit INTEGER UNIQUE,
UpperLimit INTEGER UNIQUE,
CHECK(UpperLimit > LowerLimit OR (LowerLimit=null AND UpperLimit<>NULL) OR (LowerLimit<>null AND UpperLimit=NULL))
);

--not sure about the device-used attribute and whether we really need it or not
CREATE TABLE Profile
(
UserID VARCHAR(20) PRIMARY KEY,
AgeCategory VARCHAR(15),
Birthyear INTEGER,
Gender CHAR(6),
Occupation VARCHAR(20),
FOREIGN KEY (UserID) REFERENCES Users,
FOREIGN KEY (AgeCategory) REFERENCES AgeRange,
CHECK (Gender IN('Male','Female'))
);



CREATE TABLE Topics
(
TopicID INTEGER PRIMARY KEY,
Descirption TEXT
--TEXT is supposed to be text of variable unlimited length
--http://www.postgresql.org/docs/9.5/static/datatype-character.html
);

CREATE TABLE Movie
(
MovieID VARCHAR(20) PRIMARY KEY UNIQUE,
Name VARCHAR(20),
Releasedate DATE,
--the lower limit for what ages should watch this movie
MPAARating INTEGER
);

--relation between user and a movie
CREATE TABLE Watches
(
UserID VARCHAR(20),
MovieID VARCHAR(20),
WatchDate DATE,
Rating INTEGER,
PRIMARY KEY(UserID, MovieID),
FOREIGN KEY(UserID) REFERENCES Users,
FOREIGN KEY(MovieID) REFERENCES Movie,
CHECK (RATING < 0 AND RATING < 6)
);

--relation between movie and topic
CREATE TABLE MovieTopics
(
TopicID INTEGER,
MovieID VARCHAR(20),
Language VARCHAR(20),
Subtitles CHAR(1),
Country VARCHAR(20),
PRIMARY KEY (TopicID, MovieID),
FOREIGN KEY (TopicID) REFERENCES Topics,
FOREIGN KEY (MovieID) REFERENCES Movie,
CHECK (Subtitles IN('y','n'))
);

CREATE TABLE Actor
(
ActorID VARCHAR(10) PRIMARY KEY UNIQUE,
Lastname VARCHAR(20),
Firstname VARCHAR(20),
BirthDate DATE,
Country VARCHAR(20)
);

--The character that they play
CREATE TABLE Role
(
RoleID VARCHAR(10) PRIMARY KEY UNIQUE,
Name VARCHAR(20),
ActorID VARCHAR(10),
FOREIGN KEY (ActorID) REFERENCES Actor
);

CREATE TABLE ActorStars
(
MovieID VARCHAR(20),
ActorID VARCHAR(10),
PRIMARY KEY(MovieID, ActorID),
FOREIGN KEY (ActorID) REFERENCES Actor,
FOREIGN KEY (MovieID) REFERENCES Movie
);

CREATE TABLE Director
(
DirectorID VARCHAR(10) PRIMARY KEY UNIQUE,
Lastname VARCHAR(20),
Firstname VARCHAR(20),
Country VARCHAR(20)
);

CREATE TABLE Directs
(
MovieID VARCHAR(20),
DirectorID VARCHAR(10),
PRIMARY KEY(MovieID, DirectorID),
FOREIGN KEY (MovieID) REFERENCES Movie,
FOREIGN KEY (DirectorID) REFERENCES Director
);

CREATE TABLE Studio
(
StudioID VARCHAR(10) PRIMARY KEY UNIQUE,
Name VARCHAR(20),
Country VARCHAR(20)
);

CREATE TABLE Sponsors
(
StudioID VARCHAR(10),
MovieID VARCHAR(20),
PRIMARY KEY(MovieID, StudioID),
FOREIGN KEY (StudioID) REFERENCES Studio,
FOREIGN KEY (MovieID) REFERENCES Movie
);
























