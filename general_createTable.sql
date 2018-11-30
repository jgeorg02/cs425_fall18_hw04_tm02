CREATE TABLE `PVdatabase`.`general` (
			 `id` INT NOT NULL AUTO_INCREMENT , 
			 `Name` VARCHAR(100) NULL , 
			 `Operator` VARCHAR(100) NULL , 
			 `ComissionDate` DATE NULL , 
			 `Description` VARCHAR(150) NULL , 
			 `Address` VARCHAR(100) NULL , 
			 `Latitude` DOUBLE NULL , 
			 `Longtitude` DOUBLE NULL , 
			 
			 PRIMARY KEY (`id`)
			 ) ENGINE = InnoDB;