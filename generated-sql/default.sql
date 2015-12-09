
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Booking
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Booking`;

CREATE TABLE `Booking`
(
    `id` INTEGER NOT NULL,
    `bookingTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `name` VARCHAR(255),
    `description` VARCHAR(2048),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- MakeBooking
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MakeBooking`;

CREATE TABLE `MakeBooking`
(
    `email` VARCHAR(255) DEFAULT '' NOT NULL,
    `id` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`email`,`id`),
    INDEX `id` (`id`),
    CONSTRAINT `MakeBooking_ibfk_1`
        FOREIGN KEY (`email`)
        REFERENCES `Users` (`email`)
        ON DELETE CASCADE,
    CONSTRAINT `MakeBooking_ibfk_2`
        FOREIGN KEY (`id`)
        REFERENCES `Booking` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users`
(
    `email` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
