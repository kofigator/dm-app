DROP DATABASE IF EXISTS debt;
CREATE DATABASE IF NOT EXISTS debt;

USE debt;


CREATE TABLE users(
    phone_number VARCHAR(20) PRIMARY KEY NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    full_name VARCHAR(100) GENERATED ALWAYS AS (CONCAT(first_name, ' ', last_name)) STORED,
    gender CHAR(1) NOT NULL,
    email VARCHAR(50) NOT NULL,
    photo VARCHAR(20),
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME
);

CREATE TABLE logins(
    log_id INT(10) PRIMARY KEY NOT NULL,
    u_id VARCHAR(20),
    CONSTRAINT FK_u_id FOREIGN KEY (u_id) REFERENCES users(phone_number) ON UPDATE CASCADE,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE customers(
    cust_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    u_id VARCHAR(20) NOT NULL,
    name VARCHAR(150) NOT NULL,
    number VARCHAR (20) NOT NULL,
    gender CHAR(1) NOT NULL,
    address VARCHAR(200),
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME,
    CONSTRAINT FK_u_id1 FOREIGN KEY (u_id) REFERENCES users(phone_number) ON UPDATE CASCADE
);

CREATE TABLE items(
    item_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    u_id VARCHAR(20),
    CONSTRAINT FK_u_id2 FOREIGN KEY (u_id) REFERENCES users(phone_number) ON UPDATE CASCADE,
    item_name VARCHAR(150) NOT NULL,
    description VARCHAR(300),
    unit_price DECIMAL(6,2) NOT NULL,
    quantity INT(10) NOT NULL,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME
);

CREATE TABLE sales(
    sales_id INT(10) PRIMARY KEY NOT NULL,
    item_id INT(10) NOT NULL,
    CONSTRAINT FK_item_id1 FOREIGN KEY (item_id) REFERENCES items (item_id) ON UPDATE CASCADE,
    cust_id INT(10) NOT NULL,
    CONSTRAINT FK_cust_id1 FOREIGN KEY (cust_id) REFERENCES customers (cust_id) ON UPDATE CASCADE,
    quantity INT(20) NOT NULL,
    unit_price DECIMAL(6,2) NOT NULL,
    total decimal(6,2) GENERATED ALWAYS AS (quantity * unit_price) stored,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE payments(
    pay_id INT(10) PRIMARY KEY NOT NULL,
    cust_id INT(10) NOT NULL,
    CONSTRAINT FK_cust_id FOREIGN KEY (cust_id) REFERENCES customers (cust_id) ON UPDATE CASCADE,
    amount DECIMAL(6,2) NOT NULL,
    mode VARCHAR(20) NOT NULL,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE ordered_items(
    order_id INT(10) PRIMARY KEY NOT NULL,
    cust_id INT(10) NOT NULL,
    CONSTRAINT FK_cust_id2 FOREIGN KEY (cust_id) REFERENCES customers (cust_id) ON UPDATE CASCADE,
    user_id VARCHAR(20),
    CONSTRAINT FK_u_id3 FOREIGN KEY (user_id) REFERENCES users(phone_number) ON UPDATE CASCADE,
    item_name VARCHAR(150) NOT NULL,
    description VARCHAR(250),
    quantity INT(10) NOT NULL,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP()
);


-- CRUD for adding a user

-- Creating a new user
INSERT INTO users VALUES('','','','','','');
UPDATE users SET phone_number = '', `name` = '', gender = '', email = '', photo = '' WHERE phone_number = '';
SELECT * FROM user WHERE phone_number = '';
DELETE FROM user WHERE phone_number = '';

-- CRUD for logins
INSERT INTO logins VALUES('','','','');
UPDATE logins SET log_id = '', u_id = '', username = '', `password` = '' WHERE (log_id = '' and u_id = '');
SELECT * FROM logins WHERE (log_id = '' and u_id = '');
DELETE FROM logins WHERE (log_id = '' and u_id = '');

-- CRUD for customers
INSERT INTO customers VALUES ('','','','','','','');
UPDATE customers SET cust_id = '', u_id = '', `name` = '', `number` = '', gender = '', address = ''
WHERE (cust_id = '' and u_id = '');
SELECT * FROM customers WHERE (cust_id = '' and u_id = '');
DELETE FROM customers WHERE (cust_id = '' and u_id = '');

-- CRUD for items
INSERT INTO items VALUES ('','','','','','','');
UPDATE items SET item_id = '', u_id = '', item_name = '', `description` = '', unit_price = '', quantity = ''
WHERE (item_id = '' and u_id = '');
SELECT * FROM items WHERE (item_id = '' and u_id = '');
DELETE FROM items WHERE (item_id = '' and u_id = '');

-- CRUD for sales
INSERT INTO sales VALUES ('','','','','','','');
UPDATE sales SET sales_id = '', item_id = '', cust_id = '', quantity = '', `date` = '', unit_price = '', 
total = '' WHERE (sales_id = '' and item_id = '' and cust_id = '');
SELECT * FROM sales WHERE (sales_id = '' and item_id = '' and cust_id = '');
DELETE from sales WHERE (sales_id = '' and item_id = '' and cust_id = '');

-- CRUD for payments
INSERT INTO payments VALUES ('','','','','');
UPDATE payments SET pay_id = '', cust_id = '', amount = '', mode = '', `date` = ''
WHERE (pay_id = '' and cust_id = '');
DELETE FROM payments WHERE (pay_id = '' and cust_id = '');

--CRUD for ordered items
INSERT INTO ordered_items VALUES ('','','','','','','');
UPDATE ordered_items SET order_id = '', cust_id = '', user_id = '', item_name = '', `description` = '', 
quantity = '', `date` = '' WHERE (order_id = '' and cust_id = '' and user_id = '');
SELECT * FROM ordered_items WHERE (order_id = '' and cust_id = '' and user_id = '');
DELETE FROM ordered_items WHERE (order_id = '' and cust_id = '' and user_id = '');


-- All payments made by a particular customer
SELECT p.* FROM customers AS c, payments AS p WHERE c.