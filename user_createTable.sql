CREATE TABLE `PVdatabase`.`user` ( 
             `idUser` INT NOT NULL AUTO_INCREMENT , 
             `Username` VARCHAR(20) NOT NULL , 
			 `Password` VARCHAR(8) NOT NULL , 
			 
			 PRIMARY KEY (`idUser`), 
			 UNIQUE (`Username`)
			 ) ENGINE = InnoDB;