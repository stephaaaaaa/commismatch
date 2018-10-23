-- CREATE database commismatch;
USE commismatch;

CREATE TABLE SiteUser (
	userID INT PRIMARY KEY AUTO_INCREMENT,
	firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(25) NOT NULL,
    handle VARCHAR(25) NOT NULL,
    quoteOrBio varchar(250),
    birthday DATE NOT NULL,
    gender VARCHAR(25) NOT NULL,
    acceptingCommissions BOOL NOT NULL,
    city VARCHAR(30),
    country VARCHAR(30),
    stateOrProvince VARCHAR(30),
    neighborhood VARCHAR(30),
	email VARCHAR(256) NOT NULL,
	password VARCHAR(64) NOT NULL
);

select * from SiteUser;

CREATE TABLE Post (
	postID INT PRIMARY KEY AUTO_INCREMENT,
	datePosted DATETIME NOT NULL,
    caption VARCHAR(250),
    commissionable BOOL NOT NULL,
    priceIfCommissioned DOUBLE(10, 2),
    postImage BLOB NOT NULL, -- blob was a datatype I found, recommended for images
    author VARCHAR(25) NOT NULL,
    foreign key (author) references SiteUser(userID)
);

Select * from Post;

CREATE TABLE Message (
	messageID INT PRIMARY KEY AUTO_INCREMENT,
    sentStamp DATETIME NOT NULL,
    sender VARCHAR(250) NOT NULL,
    receiver VARCHAR(250) NOT NULL,
    foreign key (sender) references SiteUser(userID),
    foreign key (receiver) references SiteUser(userID),
    subject TINYTEXT NOT NULL,
    messageContent TEXT NOT NULL
);

Select * from Message;

CREATE TABLE Commission (
	commissionID INT PRIMARY KEY AUTO_INCREMENT,
	commissionedBy VARCHAR(250) NOT NULL, -- client
    commissionedTo VARCHAR(250) NOT NULL, -- artist
    foreign key (commissionedBy) references SiteUser(userID),
    foreign key (commissionedTo) references SiteUser(userID),
    details VARCHAR(500), -- special details, will appear as a message box, if time
    expectedCompletionDate DATE,
    isCompleted BOOL
);

Select * from Commission;

CREATE TABLE CommissionInProgress ( -- the one users deliver
	commissionInProgID INT PRIMARY KEY AUTO_INCREMENT,
    commissionDetailsID INT,
    foreign key (commissionDetailsID) references Commission(commissionID)
    
);

Select * From CommissionInProgress;

CREATE TABLE CommissionInTracking ( -- the one users wait on
	commissionInTrackID INT PRIMARY KEY AUTO_INCREMENT,
	commissionDetailsID INT,
    foreign key (commissionDetailsID) references Commission(commissionID));
    
Select * from CommissionsInTracking;

CREATE TABLE CompletedCommissions (
	completedID INT PRIMARY KEY AUTO_INCREMENT,
	commissionDetailsID INT,
    foreign key (commissionDetailsID) references Commission(commissionID));
    
Select * from CompletedCommissions;
