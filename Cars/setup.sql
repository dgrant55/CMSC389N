CREATE DATABASE cars;

CREATE TABLE cars.specifications (
	year 			INT,
	manufacturer 	VARCHAR(50),
	model 			VARCHAR(50),
	category 		ENUM('convertible', 'coupe', 'sedan', 'hatchback', 'suv', 'pickup', 'van'),
	size 			ENUM('compact', 'midsize', 'fullsize'),
	msrp 			INT,
	mpg 			INT,
	stars 			INT,
	fuel 			ENUM('gas', 'diesel', 'hybrid', 'electric'),
	image 			LONGBLOB,
	imgpath			VARCHAR(50)
);

INSERT INTO Cars.specifications
VALUES ('2015', 'Ford', 'F-150', 'pickup', 'fullsize', '30000', '20', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/1.jpg'), 'images/1.jpg');

INSERT INTO Cars.specifications
VALUES ('2014', 'Chevrolet', 'Silverado', 'pickup', 'fullsize', '29000', '19', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/2.jpg'), 'images/2.jpg');

INSERT INTO Cars.specifications
VALUES ('2013', 'Toyota', 'Camry', 'sedan', 'midsize', '22000', '28', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/3.jpg'), 'images/3.jpg');

INSERT INTO Cars.specifications
VALUES ('2012', 'Ram', '1500', 'pickup', 'fullsize', '26000', '16', '3', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/4.jpg'), 'images/4.jpg');

INSERT INTO Cars.specifications
VALUES ('2015', 'Toyota', 'Corolla', 'sedan', 'midsize', '17000', '32', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/5.jpg'), 'images/5.jpg');

INSERT INTO Cars.specifications
VALUES ('2014', 'Nissan', 'Altima', 'sedan', 'midsize', '22000', '31', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/6.jpg'), 'images/6.jpg');

INSERT INTO Cars.specifications
VALUES ('2013', 'Honda', 'Civic', 'sedan', 'compact', '18000', '32', '4', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/7.jpg'), 'images/7.jpg');

INSERT INTO Cars.specifications
VALUES ('2012', 'Honda', 'CR-V', 'suv', 'midsize', '22000', '26', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/8.jpg'), 'images/8.jpg');

INSERT INTO Cars.specifications
VALUES ('2015', 'Honda', 'Accord', 'sedan', 'midsize', '22000', '31', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/9.jpg'), 'images/9.jpg');

INSERT INTO Cars.specifications
VALUES ('2014', 'Hyundai', 'Elantra', 'sedan', 'compact', '17000', '32', '5', 'gas', LOAD_FILE('C:/xampp/htdocs/projects/group/images/10.jpg'), 'images/10.jpg');
