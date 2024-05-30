SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `astr_db`;
CREATE DATABASE astronomydb;

USE astr_db;

CREATE TABLE NaturalObjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255),
    galaxy VARCHAR(255),
    accuracy DECIMAL(10, 2),
    lightFlow DECIMAL(10, 2),
    relatedObjects TEXT,
    notes TEXT
);

USE astr_db;

-- Добавляем данные в таблицу NaturalObjects
INSERT INTO NaturalObjects (type, galaxy, accuracy, lightFlow, relatedObjects, notes) VALUES
('Звезда', 'Галактика X', 0.65, 1000.0, 'Информация...', 'Заметка...'),
('Планета', 'Галактика Y', 0.25, 400.0, 'Информация...', 'Заметка...'),
('Комета', 'Галактика X', 0.62, 100.0, 'Информация...', 'Заметка...'),
('Звезда', 'Галактика X', 0.22, 1400.0, 'Информация...', 'Заметка...'),
('Планета', 'Галактика Z', 0.88, 300.0, 'Информация...', 'Заметка...'),
('Астероид', 'Галактика Z', 0.63, 2500.0, 'Информация...', 'Заметка...'),



COMMIT;

DELIMITER //

CREATE TRIGGER after_update_astroobject
AFTER UPDATE ON astroobject
FOR EACH ROW
BEGIN
    UPDATE astroobject
    SET date_update = CURRENT_TIMESTAMP
    WHERE id = NEW.id;
END//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE MergeTables(IN table1_name VARCHAR(255), IN table2_name VARCHAR(255))
BEGIN
    SET @sql = CONCAT('SELECT * FROM ', table1_name, ' JOIN ', table2_name, ' ON ', table1_name, '.id = ', table2_name, '.id');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END//

DELIMITER ;


CREATE PROCEDURE `UpdateNaturalObjects`(IN textId INT, IN type VARCHAR(255), IN galaxy VARCHAR(255), IN accuracy DECIMAL(10, 2), IN lightFlow DECIMAL(10, 2), IN relatedObjects TEXT, IN notes TEXT)
BEGIN
   UPDATE NaturalObjects
   SET type = type,
       galaxy = galaxy,
       accuracy = accuracy,
       lightFlow = lightFlow,
       relatedObjects = relatedObjects,
       notes = notes
   WHERE id = textId;
END