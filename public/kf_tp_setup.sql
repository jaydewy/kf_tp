CREATE TABLE People (
  people_id INT NOT NULL AUTO_INCREMENT,
  last_name VARCHAR(255) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  address VARCHAR(255),
  city VARCHAR(255),
  prov VARCHAR(2),
  postal_code VARCHAR(6),
  telephone VARCHAR(10),
  cell_phone VARCHAR(10),
  email VARCHAR(255),
  friend BOOLEAN,
  PRIMARY KEY (people_id)
);

CREATE INDEX idx_last_name ON People(last_name);

CREATE TABLE Lots (
  lot_id INT NOT NULL AUTO_INCREMENT,
  lot_name VARCHAR(255),
  lot_size NUMERIC,
  lot_type VARCHAR(255),
  lot_value NUMERIC,
  lot_reservable BOOLEAN,
  people_id INT,
  notes TEXT(65535),
  PRIMARY KEY (lot_id),
  FOREIGN KEY (people_id) REFERENCES People(people_id)
);

CREATE TABLE Admissions (
  admit_id INT NOT NULL AUTO_INCREMENT,
  lot_id INT,
  admit_date DATE NOT NULL DEFAULT CURRENT_DATE(),
  admit_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  licence_plate VARCHAR(255),
  adult_admissions INT NOT NULL,
  child_admissions INT NOT NULL,
  additional_vehicles INT NOT NULL,
  PRIMARY KEY (admit_id),
  FOREIGN KEY (lot_id) REFERENCES Lots(lot_id)
);

CREATE TABLE Payments (
  payment_id INT NOT NULL AUTO_INCREMENT,
  lot_id INT,
  payment_date DATE NOT NULL DEFAULT CURRENT_DATE(),
  payment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  payment_amount NUMERIC NOT NULL,
  payment_type VARCHAR(255),
  year_paid INT,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (lot_id) REFERENCES Lots(lot_id)
);

CREATE TABLE Waitlist (
  people_id INT NOT NULL,
  date_added DATE NOT NULL DEFAULT CURRENT_DATE(),
  trailer_size INT,
  lot_preference VARCHAR(255),
  notes TEXT(65535),
  PRIMARY KEY (people_id),
  FOREIGN KEY (people_id) REFERENCES People(people_id)
);

CREATE TABLE CheckIns (
  check_in_id INT NOT NULL AUTO_INCREMENT,
  date_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  lot_id INT NOT NULL,
  PRIMARY KEY (check_in_id),
  FOREIGN KEY (lot_id) REFERENCES Lots(lot_id)
);

CREATE TABLE Incidents (
  incident_id INT NOT NULL AUTO_INCREMENT,
  incident_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  lot_id INT,
  incident_type VARCHAR(255),
  incident_description TEXT(65535),
  security_called BOOLEAN,
  police_called BOOLEAN,
  incident_resolved BOOLEAN,
  notes TEXT(65535),
  PRIMARY KEY (incident_id),
  FOREIGN KEY (lot_id) REFERENCES Lots(lot_id)
);
