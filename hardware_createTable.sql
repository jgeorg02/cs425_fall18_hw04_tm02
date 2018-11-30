CREATE TABLE `PVdatabase`.`hardware` ( 
			 `id` INT NOT NULL , 
			 `Modules` VARCHAR(50) NOT NULL , 
			 `AzimuthAngle` DOUBLE NOT NULL , 
			 `InclinationAngle` DOUBLE NOT NULL , 
			 `Communication` VARCHAR(50) NOT NULL , 
			 `Inverter` VARCHAR(50) NOT NULL , 
			 `Sensors` VARCHAR(50) NOT NULL , 
			 
			 UNIQUE (`id`)
			 ) ENGINE = InnoDB;