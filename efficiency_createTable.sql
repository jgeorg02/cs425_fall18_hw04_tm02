CREATE TABLE `PVdatabase`.`efficiency` (
             `id` INT NOT NULL , 
			 `SystemPower` DOUBLE NOT NULL , 
			 `AnnualProduction` DOUBLE NOT NULL , 
			 `CO2` DOUBLE NOT NULL , 
			 `Reimbursement` DOUBLE NOT NULL , 
			 
			 UNIQUE (`id`)
			 ) ENGINE = InnoDB;