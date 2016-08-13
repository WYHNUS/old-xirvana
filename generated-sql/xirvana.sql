
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users`
(
    `email` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Debt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Debt`;

CREATE TABLE `Debt`
(
    `creditor` VARCHAR(255) NOT NULL,
    `debtor` VARCHAR(255) NOT NULL,
    `amount` DECIMAL NOT NULL,
    PRIMARY KEY (`creditor`,`debtor`),
    INDEX `fi_tor_user` (`debtor`),
    CONSTRAINT `creditor_user`
        FOREIGN KEY (`creditor`)
        REFERENCES `Users` (`email`),
    CONSTRAINT `debtor_user`
        FOREIGN KEY (`debtor`)
        REFERENCES `Users` (`email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Transaction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Transaction`;

CREATE TABLE `Transaction`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `creditor` VARCHAR(255) NOT NULL,
    `debtor` VARCHAR(255) NOT NULL,
    `amount` DECIMAL NOT NULL,
    `time` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `fi_ditor` (`creditor`),
    INDEX `fi_tor` (`debtor`),
    CONSTRAINT `creditor`
        FOREIGN KEY (`creditor`)
        REFERENCES `Users` (`email`),
    CONSTRAINT `debtor`
        FOREIGN KEY (`debtor`)
        REFERENCES `Users` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
