	CREATE TABLE `tbl_Shops` (
	`shop_id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`address` varchar(255) NOT NULL,
	PRIMARY KEY (`shop_id`)
);

CREATE TABLE `tbl_ItemPrices` (
	`shop_id` INT NOT NULL,
	`item_id` INT NOT NULL,
	`price` DECIMAL(6,2) NOT NULL DEFAULT '0.00',
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL
);

CREATE TABLE `tbl_Items` (
	`item_id` INT NOT NULL AUTO_INCREMENT,
	`brand` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`upc` INT NOT NULL,
	PRIMARY KEY (`item_id`)
);

CREATE TABLE `tbl_Lists` (
	`list_id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`list_id`)
);

CREATE TABLE `tbl_ListItems` (
	`list_id` INT NOT NULL,
	`item_id` INT NOT NULL,
	`qty` INT NOT NULL DEFAULT '1'
);

ALTER TABLE `tbl_ItemPrices` ADD CONSTRAINT `tbl_ItemPrices_fk0` FOREIGN KEY (`shop_id`) REFERENCES `tbl_Shops`(`shop_id`);

ALTER TABLE `tbl_ItemPrices` ADD CONSTRAINT `tbl_ItemPrices_fk1` FOREIGN KEY (`item_id`) REFERENCES `tbl_Items`(`item_id`);

ALTER TABLE `tbl_ListItems` ADD CONSTRAINT `tbl_ListItems_fk0` FOREIGN KEY (`list_id`) REFERENCES `tbl_Lists`(`list_id`);

ALTER TABLE `tbl_ListItems` ADD CONSTRAINT `tbl_ListItems_fk1` FOREIGN KEY (`item_id`) REFERENCES `tbl_Items`(`item_id`);
