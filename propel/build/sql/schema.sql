
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- ingredients
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingredients`;

CREATE TABLE `ingredients`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(120) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- pizzas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pizzas`;

CREATE TABLE `pizzas`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(120) NOT NULL,
    `price` FLOAT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- pizza_ingredients
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pizza_ingredients`;

CREATE TABLE `pizza_ingredients`
(
    `ingredients_id` INTEGER NOT NULL,
    `pizzas_id` INTEGER NOT NULL,
    PRIMARY KEY (`ingredients_id`,`pizzas_id`),
    INDEX `pizza_ingredients_FI_2` (`pizzas_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- order_pizzas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_pizzas`;

CREATE TABLE `order_pizzas`
(
    `orders_id` INTEGER NOT NULL,
    `pizzas_id` INTEGER NOT NULL,
    `amount` FLOAT NOT NULL,
    PRIMARY KEY (`orders_id`,`pizzas_id`),
    INDEX `order_pizzas_FI_2` (`pizzas_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- orders
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `customers_id` INTEGER NOT NULL,
    `total` FLOAT NOT NULL,
    `created_at` DATE NOT NULL,
    `completed_at` TIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `orders_FI_1` (`customers_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- customers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `zip` INTEGER NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
