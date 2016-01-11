CREATE TABLE `phpTest`.`customer` (
  `idcustomer` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `address` VARCHAR(255) NULL,
  `city` VARCHAR(50) NULL,
  `state` VARCHAR(50) NULL,
  `zipcode` VARCHAR(10) NULL,
  PRIMARY KEY (`idcustomer`));
