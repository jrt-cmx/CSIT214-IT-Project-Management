CREATE TABLE staff (
    stfID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    superuser CHAR (1) NOT NULL
);

CREATE TABLE student (
    stdID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL
);

CREATE TABLE room (
    roomID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (20) NOT NULL UNIQUE,
    price DECIMAL(5,2) DEFAULT '0.0',
    capacity int(5) NOT NULL,
    availability VARCHAR(5) NOT NULL,
    approved VARCHAR(5) NOT NULL
    
);

CREATE TABLE promo (
    promoID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(10) NOT NULL UNIQUE,
    discount_amount DECIMAL(5,2),
    discount_percentage int(3)

);

CREATE TABLE booking (
    bookingID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roomID int NOT NULL,
    bookingDate DATE NOT NULL,
    bookingTime TIME NOT NULL,
    CONSTRAINT fk_roomID FOREIGN KEY (roomID) REFERENCES room (roomID)
    ON DELETE CASCADE ON UPDATE CASCADE,
    stdID int NOT NULL,
    CONSTRAINT fk_userID FOREIGN KEY (stdID) REFERENCES student (stdID)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE unavailable (
    unavailID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roomID int NOT NULL,
    unavail_date DATE NOT NULL,
    unavail_time TIME,
    CONSTRAINT fk_unavail_roomID FOREIGN KEY (roomID) REFERENCES room (roomID)
    ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO staff(username,password, superuser) VALUES ("staff", "password" ,"0");
INSERT INTO staff(username,password, superuser) VALUES ("superuser", "password" ,"1");
INSERT INTO student(username,password) VALUES ("student", "password");