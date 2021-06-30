CREATE TABLE `test`.`workers` (
  `worker_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `position` VARCHAR(255) NOT NULL,
  `img` VARCHAR(255) NOT NULL,
  `about` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`worker_id`)
);