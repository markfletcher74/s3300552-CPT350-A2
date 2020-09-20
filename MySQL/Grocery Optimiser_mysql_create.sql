CREATE TABLE tbl_Shops (
	shop_id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	address varchar(255) NOT NULL,
	PRIMARY KEY (shop_id)
);

CREATE TABLE tbl_ItemPrices (
	item_price INT NOT NULL,
	shop_id INT NOT NULL,
	price DECIMAL NOT NULL,
	item_id INT NOT NULL,
	created DATETIME NOT NULL,
	modified DATETIME NOT NULL
);

CREATE TABLE tbl_Items (
	item_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	brand varchar(255) NOT NULL,
	name varchar(255) NOT NULL,
	upc INT NOT NULL
);

CREATE TABLE tbl_List (
	list_id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY (list_id)
);

CREATE TABLE tbl_ListItems (
	list_id INT NOT NULL,
	item_id INT NOT NULL
);

ALTER TABLE tbl_ItemPrices ADD CONSTRAINT tbl_ItemPrices_fk0 FOREIGN KEY (shop_id) REFERENCES tbl_Shops(shop_id);

ALTER TABLE tbl_ItemPrices ADD CONSTRAINT tbl_ItemPrices_fk1 FOREIGN KEY (item_id) REFERENCES tbl_Items(item_id);

ALTER TABLE tbl_ListItems ADD CONSTRAINT tbl_ListItems_fk0 FOREIGN KEY (list_id) REFERENCES tbl_List(list_id);

ALTER TABLE tbl_ListItems ADD CONSTRAINT tbl_ListItems_fk1 FOREIGN KEY (item_id) REFERENCES tbl_Items(item_id);

