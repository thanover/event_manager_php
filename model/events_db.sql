CREATE TABLE events (
    eventID     MEDIUMINT       NOT NULL AUTO_INCREMENT,
    eventDate   DATE            NOT NULL,
    eventTitle  VARCHAR(255)    NOT NULL,
    eventDesc   TEXT            NOT NULL,
    PRIMARY KEY (eventID)
);

INSERT INTO events VALUES
(1, '2019-5-01','First Annual BBQ','BBQ that will be hosted by the Smiths. Address is: 5 Main St, Boston, MA'),
(2, '2019-4-03','South Shore Country Club Golf Tournament','Annual Golf tournament at the South Shore Country Club'),
(3, '2019-6-23','A Fun Event','This event will be a whole lot of fun'),
(4, '2019-10-15','Festival of Fun','A festival celebrating having fun'),
(5, '2019-4-14','Beer Fest','Craft Brews and good food'),
(6, '2019-1-03','Annual Ski Trip','Ski Trip to Okemo Mountain'),
(7, '2019-08-16','Another Event','This event will occur and will be fin'),
(8, '2019-9-05','Pub Crawl','A pub crawl through Boston'),
(9, '2019-8-21','Hawaii Trip','A trip to the islands in the Pacific');



CREATE TABLE users (
    userID          MEDIUMINT       NOT NULL AUTO_INCREMENT,
    userFirstName   VARCHAR(255)    NOT NULL,
    userLastName    VARCHAR(255)    NOT NULL,
    userEmail       VARCHAR(255)    NOT NULL,
    PRIMARY KEY (userID)
);

INSERT INTO users VALUES
(1, 'Admin','Admin','Admin@admin.com'),
(2, 'Jack','Doe','JDoe@aol.com'),
(3, 'Susan','Clancy','Susan.Clancy@gmail.com'),
(4, 'Liz','Young','Young1255@hotmail.com'),
(5, 'Robert','Fitzpatrick','R.Fitz@gmail.com'),
(6, 'Sarah','Roberts','SarahRoberts@aol.com'),
(7, 'Rachel','Evens','RachelEvens@yahoo.com'),
(8, 'John','Smith','JohnSmith@gmail.com');

CREATE TABLE invites (
    eventID     MEDIUMINT       NOT NULL,
    userID      MEDIUMINT       NOT NULL,
    status      VARCHAR(255)    NOT NULL,
    PRIMARY KEY (userID, eventID)
);

INSERT INTO invites VALUES
(5, 2, 'accepted'),
(5, 3, 'accepted'),
(5, 4, 'accepted'),
(5, 5, 'accepted'),
(5, 6, 'accepted'),
(5, 7, 'accepted'),
(5, 8, 'accepted'),
(4, 2, 'accepted'),
(4, 3, 'accepted'),
(4, 7, 'accepted'),
(4, 8, 'accepted'),
(6, 2, 'accepted'),
(6, 3, 'accepted'),
(6, 4, 'accepted'),
(6, 5, 'accepted'),
(6, 6, 'accepted'),
(6, 7, 'accepted'),
(6, 8, 'accepted'),
(2, 2, 'invited'),
(2, 3, 'invited'),
(2, 4, 'invited'),
(2, 5, 'invited'),
(2, 6, 'invited'),
(2, 7, 'invited'),
(2, 8, 'invited'),
(3, 2, 'invited'),
(3, 3, 'invited'),
(3, 4, 'invited'),
(3, 5, 'invited'),
(3, 6, 'invited'),
(3, 7, 'invited'),
(3, 8, 'invited'),
(4, 4, 'invited'),
(4, 5, 'invited'),
(4, 6, 'invited'),
(9, 2, 'declined'),
(9, 3, 'declined'),
(9, 4, 'declined'),
(9, 5, 'declined'),
(9, 6, 'declined'),
(9, 7, 'declined'),
(9, 8, 'declined');
